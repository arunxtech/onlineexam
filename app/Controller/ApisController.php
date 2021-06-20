<?php
App::uses('CakeEmail', 'Network/Email');

class ApisController extends AppController
{
    public $components = array('CustomFunction', 'RequestHandler');

    public function index()
    { 
    } 


    public function rest_home()
    {
        $this->loadModel('Slide');
        $this->loadModel('Testimonial');
        //$this->autoRender = false;
        $response = $this->Slide->query("SELECT * FROM `slides` ");
        $Testimonials = $this->Testimonial->find('all', array('conditions' => array('Testimonial.status' => 'Active')));

        foreach ($response as $value) {
            $slides_id = $value['slides']['id'];
            $slide_name = $value['slides']['slide_name'];
            $slides_ordering = $value['slides']['ordering'];
            $slides_photo = $this->siteDomain . '/img/slides_thumb/' . $value['slides']['photo'];
            $slides_status = $value['slides']['status'];
            //if ($slides_id!=5 && $slides_id!=2) {
            $slides[] = array('slides_photo' => $slides_photo);
            //}
        }

        $Tml_sn = "";
        foreach ($Testimonials as $Tml) {
            $Tml_sn++;
            //print_r($Tml);
            $name = $Tml['Testimonial']['name'];
            $Rating = $Tml['Testimonial']['rating'];
            $Comments = $Tml['Testimonial']['description'];
            if (empty($Tml['Testimonial']['photo'])) {
                $Image = $this->siteDomain . '/img/student_thumb/user.png';

            } else {
                $Image = $this->siteDomain . '/img/testimonial_thumb/' . $Tml['Testimonial']['photo'];
            }

            $Testimonial[] = array('name' => $name, 'image' => $Image, 'rating' => $Rating, 'comments' => $Comments);
            unset($Image);
        }
        $home['home_data'] = $slides;
        $home['testimonials'] = $Testimonial;
        $status = true;
        $message = __('Slide data fetch successfully.');
        $this->set(compact('status', 'message', 'home'));
        $this->set('_serialize', array('status', 'message', 'home'));

    }

    public function rest_studentGroups()
    {
        if ($this->authenticateRest($this->request->query)) {
            $this->loadModel('StudentGroup');
            $this->studentId = $this->restStudentId($this->request->query);
            $studentid = $this->studentId;
            $groupSelect = $this->StudentGroup->find('all', array('fields' => array('Groups.group_name'),
                'joins' => array(array('table' => 'groups', 'type' => 'Inner', 'alias' => 'Groups',
                    'conditions' => array('StudentGroup.group_id=Groups.id', "student_id=$studentid")))));
            foreach ($groupSelect as $groupValue) {
                $gname = $groupValue['Groups']['group_name'];
                $usergroupSelect[] = array('group_name' => $gname);
            }
            unset($groupValue);
            $response = $usergroupSelect;
            $status = true;
            $message = __('Group fetch successfully');
        } else {
            $status = false;
            $message = ('Invalid Token');
            $response = (object)array();
        }
        $this->set(compact('status', 'message', 'response'));
        $this->set('_serialize', array('status', 'message', 'response'));
    }

    public function rest_updateusertoken()
    {
        $this->loadModel('Student');
        $post = $this->Student->findByid($this->request->query['id']);
        $usertoken = $this->request->query['usertoken'];
        if (empty($post)) {
            $status = false;
            $message = __('Invalid student');
        } else {
            $student_id = $post['Student']['id'];
            $post['Student']['email'];
            $post['Student']['name'];
            $Studentarr = array('user_token' => $usertoken, 'id' => $student_id);
            if ($this->Student->save($Studentarr)) {
                $status = true;
                $message = __('Student token update successfully.');
            } else {
                $status = false;
                $message = __('Student token update failed.');
            }
        }
        $this->set(compact('status', 'message'));
        $this->set('_serialize', array('status', 'message'));

    }

    public function rest_emailcapturing()
    {
        $this->loadModel('Student');
        //$post=$this->Student->findByid($this->request->query['id']);   
        $post = $this->Student->find('first', array('conditions' => array('OR' => array('Student.email' => $this->request->query['capture_by'], 'Student.phone' => $this->request->query['capture_by']))));
        if (empty($post)) {
            $status = false;
            $message = __('Invalid student');
            $verification_code = "";
        } else {
            $status = true;
            $message = __('Verification successful .');
            if ($this->request->query['type'] == 1) {
                $verification_code = $post['Student']['reg_code'];
            }
            if ($this->request->query['type'] == 2) {
                $verification_code = $post['Student']['presetcode'];
            }
        }
        $this->set(compact('status', 'message', 'verification_code'));
        $this->set('_serialize', array('status', 'message', 'verification_code'));

    }

    public function rest_cartreminder()
    {
        $this->loadModel('Student');
        $this->loadModel('Package');

        $id = $this->request->data['student_id'];;
        $packagesIds = $this->request->data['packages_id'];;
        $post = $this->Student->findByid($id);
        $packageIds = explode(',', $packagesIds);
        foreach ($packageIds as $packageId) {
            $Packagepost = $this->Package->findByid($packageId);
            $Packagepost['Package']['id'];
            $Package_name = $Packagepost['Package']['name'];
            $Package_amount = $Packagepost['Package']['amount'];
            $Package_photo = $Packagepost['Package']['photo'];
            $Package_expiryDays = $Packagepost['Package']['expiry_days'];
            $PackageDetails .= '<div style="width: 200px;float: left;padding: 10px;">
                <img style="max-width: 200px;" src="' . $this->siteDomain . '/img/package_thumb/' . $Package_photo . '"><br><h4 style="padding: 0;width: 200px;text-align: center;">' . $Package_name . '</h4><h3 style="padding: 0;width: 200px;text-align: center;"><strong>' . $Package_amount . '</strong></h3></div>
            </div>';
        }

        if (empty($post)) {
            $status = false;
            $message = __('Invalid student');
            $cartreminder = "";
        } else {
            $email = $post['Student']['email'];
            $name = $post['Student']['name'];
            if ($this->emailNotification) {
                /* Send Email */

                $message = '<div style="margin: 0 auto;border: 1px solid;width: 800px;padding: 20px;    overflow: hidden;">
                    <p><img src="img.jpg"><p>
                    <p>Hi: ' . $name . '</p>
                    <p>Couldnt complete your purchase? Do it right away!</p>
                    <p>We re really sorry if there was something wrong with the payment gateway! For your convenience, we re placing the products here, so that you can add them to the cart directly and checkout.</p>' . $PackageDetails . '</div>';
                $this->loadModel('Emailtemplate');
                $emailTemplateArr = $this->Emailtemplate->findByType('SRN');
                if ($emailTemplateArr['Emailtemplate']['status'] == "Published") {
                    // $message=eval('return "' . addslashes($emailTemplateArr['Emailtemplate']['description']) . '";');
                    $Email = new CakeEmail();
                    $Email->transport($this->emailSettype);
                    if ($this->emailSettype == "Smtp") {
                        $Email->config($this->emailSettingsArr);
                    }
                    $Email->from(array($this->siteEmail => $this->siteName));
                    $Email->to($email);
                    $Email->template('default');
                    $Email->emailFormat('html');
                    $Email->subject($emailTemplateArr['Emailtemplate']['name']);
                    $Email->send($message);
                }
                /* End Email */
            }
            $status = true;
            $message = __('Email send successful .');
        }
        $this->set(compact('status', 'message', ''));
        $this->set('_serialize', array('status', 'message',));

    }

    public function rest_sendmail()
    {
        $this->loadModel('Student');
        $this->loadModel('Package');

        $id = $this->request->data['student_id'];;
        $post = $this->Student->findByid($id);
        if (empty($post)) {
            $status = false;
            $message = __('Invalid student');
        } else {
            $email = $post['Student']['email'];
            $name = $post['Student']['name'];
            $phone = $post['Student']['phone'];
            $Requestmessage = $this->request->data['message'];
            $device = $post['Student']['device'];
            $manufacturer = $post['Student']['manufacturer'];
            $imei_no = $post['Student']['imei_no'];
            $model = $post['Student']['model'];
            $subject = "Multiple login detected";
            if ($this->emailNotification) {
                /* Send Email */
                $message = '<h2>Multiple login detected<h2><br><h3>Student Info<h3><br>
                        Name: ' . $name . '<br>email: ' . $email . '<br>Mobile: ' . $phone . '<br>
                        <h3>Present Device Info<h3><br>
                        Device: ' . $device . '<br>Device name: ' . $manufacturer . ' ' . $model . '<br>IMEI No: ' . $imei_no . '<br>
                        <h3>Requested device info</h3><br>Device: ' . $this->request->data['device'] . '<br>Device name: ' . $this->request->data['manufacturer'] . ' ' . $this->request->data['model'] . '<br>IMEI No: ' . $this->request->data['imei_no'] . '<br>
                        <h3>Request message<h3>' . $Requestmessage . '<br>';
                $Email = new CakeEmail();
                $Email->transport($this->emailSettype);
                if ($this->emailSettype == "Smtp") {
                        $Email->config($this->emailSettingsArr);
                    }
                $Email->from(array($email => $name));
                $Email->to($this->siteEmail);
                $Email->template('default');
                $Email->emailFormat('html');
                $Email->subject($subject);
                $Email->send($message);

                $message = 'From - ' . $this->siteEmail . '<br><br>
                        Name - ' . $this->siteName . '<br><br>
                        Subject - ' . $subject . '<br><br>
                        Hello ' . $name . ',<br><br>
                        Thank you for contacting us. We acknowledge the receipt of your Query. One of our Admins will reply to your Query shortly.<br><br><br><br>
                        Regards,<br>
                        The Testkart Team';

                $Email = new CakeEmail();
                $Email->transport($this->emailSettype);
                if ($this->emailSettype == "Smtp") {
                        $Email->config($this->emailSettingsArr);
                    }
                $Email->from(array($this->siteEmail => $this->siteName));
                $Email->to($email);
                $Email->template('default');
                $Email->emailFormat('html');
                $Email->subject($subject);
                $Email->send($message);
            }
            $status = true;
            $message = __('Email send successful .');
        }
        $this->set(compact('status', 'message', ''));
        $this->set('_serialize', array('status', 'message',));

    }

    public function rest_sociallogin()
    {
        $this->loadModel('Student');
        $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
        if ($this->request->is('post')) {
            $femail = $this->request->data['email'];
            $fbfullname = $this->request->data['name'];
            $social_id = $this->request->data['social_id'];
            $provider = $this->request->data['social_provider'];
            $token = $this->request->data['token'];
            if ($social_id) {
                try {
                    $userData = $this->Student->findBySocialId($social_id);
                } catch (Exception $e) {
                    $message = $e->getMessage();
                    $userData = false;
                    $status = false;
                }
            } else {
                $userData = false;
                $status = false;
                $message = 'Request data is blank';
            }
            if ($userData != false) {
                $status = true;
                $user = $userData;
                $message = 'Thanks for coming back ' . $fbfullname;
                $publicKey = $this->CustomFunction->generate_rand(15);
                $privateKey = $passwordHasher->hash($publicKey . time());
                $recordArr = array('Student' => array('id' => $user['Student']['id'], 'public_key' => $publicKey, 'private_key' => $privateKey, 'last_login' => $this->currentDateTime, 'user_token' => $token));
                $this->Student->save($recordArr);
                if ($user['Student']['photo'] != null) {
                    $studentPhoto = $this->siteDomain . '/img' . '/student_thumb/' . $user['Student']['photo'];
                }
                $sysSetting = $this->sysSetting;
                $currency = $this->siteDomain . '/img' . '/currencies/' . $this->currencyArr['Currency']['photo'];
                $currencyCode = $this->currencyType;
            } else {
                if ($social_id) {
                    if ($femail) {
                        $Data = $this->Student->findByEmail($femail);
                    }
                    if ($Data) {
                        $status = true;
                        $user = $Data;
                        $message = 'Thanks for coming back ' . $fbfullname;

                        $publicKey = $this->CustomFunction->generate_rand(15);
                        $privateKey = $passwordHasher->hash($publicKey . time());
                        $recordArr = array('Student' => array('id' => $user['Student']['id'], 'public_key' => $publicKey, 'private_key' => $privateKey, 'last_login' => $this->currentDateTime, 'user_token' => $token));
                        $this->Student->save($recordArr);
                        if ($user['Student']['photo'] != null) {
                            $studentPhoto = $this->siteDomain . '/img' . '/student_thumb/' . $user['Student']['photo'];
                        }
                        $sysSetting = $this->sysSetting;
                        $currency = $this->siteDomain . '/img' . '/currencies/' . $this->currencyArr['Currency']['photo'];
                        $currencyCode = $this->currencyType;
                    } else {
                        $publicKey = $this->CustomFunction->generate_rand(15);
                        $privateKey = $passwordHasher->hash($publicKey . time());
                        $Arrdata['Student'] = array('email' => $femail, 'name' => $fbfullname, 'status' => 'Active', 'reg_status' => 'Done', 'expiry_days' => 0, 'social_id' => $social_id, 'rej_type' => 1, 'social_provider' => $provider, 'public_key' => $publicKey, 'private_key' => $privateKey, 'user_token' => $token);
                        $this->Student->save($Arrdata['Student']);
                        $studentGroupArr = array();
                        $studentGroupArr['student_id'] = $this->Student->id;
                        $this->loadModel('Group');
                        $this->loadModel('StudentGroup');
                        $groupArr = $this->Group->find('all');
                        foreach ($groupArr as $value) {
                            $this->StudentGroup->create();
                            $studentGroupArr['group_id'] = $value['Group']['id'];
                            $this->StudentGroup->save($studentGroupArr);
                        }
                        $newuserData = $this->Student->findBySocialId($social_id);
                        $user = $newuserData;
                        $message = 'You have been logged in successfully';
                        $status = true;
                        if ($user['Student']['photo'] != null) {
                            $studentPhoto = $this->siteDomain . '/img' . '/student_thumb/' . $user['Student']['photo'];
                        }
                        $sysSetting = $this->sysSetting;
                        $currency = $this->siteDomain . '/img' . '/currencies/' . $this->currencyArr['Currency']['photo'];
                        $currencyCode = $this->currencyType;
                    }
                } else {
                    $status = false;
                    $message = 'Request data is blank';
                }
            }
        } else {
            $message = __('GET request not allowed!');
            $status = false;
        }

        $this->set('public_key', $publicKey);
        $this->set('private_key', $privateKey);
        $this->set(compact('status', 'message', 'studentPhoto', 'user', 'accountStatus', 'sysSetting', 'currency', 'currencyCode'));
        $this->set('_serialize', array('status', 'message', 'public_key', 'private_key', 'studentPhoto', 'user', 'accountStatus', 'sysSetting', 'currency', 'currencyCode'));

    }


}