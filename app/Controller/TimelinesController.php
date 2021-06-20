<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class TimelinesController extends AppController
{
    var $helpers = array('Form');
    public $components = array('RequestHandler');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function crm_index()
    {
        if ($this->Session->check('Student')) {
            $this->redirect(array('controller' => 'Dashboards', 'action' => 'index'));
            exit();
        }
        $this->redirect(array('action' => 'login'));
    }
 
	
	/************************************** api **************************************/
	
	public function api_get_timelines()
    {
		 
        if ($this->authenticateRest($this->request->query)) {
            $this->studentId = $this->restStudentId($this->request->query);
            
            $this->loadModel('Student');
            $this->loadModel('Timeline');
            $id = $this->userValue['Student']['id'];
            $post = $this->Student->findById($id);
           
           // echo '<pre>' ;print_r($post) ;die;
           $posts = $this->Timeline->find('list');
            echo '<pre>' ;print_r($posts) ;die;
            $this->loadModel('StudentGroup');
            $groupSelect = $this->StudentGroup->find('all', array('fields' => array('Groups.group_name'),
                'joins' => array(array('table' => 'groups', 'type' => 'Inner', 'alias' => 'Groups',
                    'conditions' => array('StudentGroup.group_id=Groups.id', "student_id=$id")))));
            if (strlen($post['Student']['photo']) > 0)
                $std_img = $this->siteDomain . '/img/student_thumb/' . $post['Student']['photo'];
            else
                $std_img = $this->siteDomain . '/img/User.png';
            $this->set('response', $post);
            $this->set('studentImage', $std_img);
            $this->set('groupSelect', $groupSelect);
            $status = true;
            $message = __('Profile fetch successfully');
        } else {
            
            $response['success'] = 'true';
		print_R(json_encode($response)); 
		die();
        }
        
            
            
		
		
    }
	
    
    
    
	/************************************** api **************************************/
	
}