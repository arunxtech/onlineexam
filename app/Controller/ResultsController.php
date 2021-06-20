<?php

class ResultsController extends AppController
{
    public $helpers = array('Paginator', 'Html', 'Paginator', 'Js' => array('Jquery'));
    public $components = array('search-master.Prg', 'Paginator', 'HighCharts.HighCharts', 'RequestHandler' => array('viewClassMap' => array('pdf' => 'CakePdf.Pdf')));
    public $currentDateTime, $studentId;
    var $paginate = array('page' => 1, 'order' => array('Result.starts_time' => 'desc'));

    public function beforeFilter()
    {
        parent::beforeFilter();
        if (!$this->adminValue) {
            $this->studentId = $this->userValue['Student']['id'];
        }
    }

    public function crm_index()
    {
        if (!$this->adminValue) {
            $this->authenticate();
            $this->studentId = $this->userValue['Student']['id'];
        }
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = array('Result.student_id' => $this->studentId, 'Result.user_id >' => 0);
        $this->Paginator->settings['limit'] = $this->pageLimit;
        $this->Paginator->settings['maxLimit'] = $this->maxLimit;
        $this->set('Result', $this->Paginator->paginate());
        if ($this->request->is('ajax')) {
            $this->render('crm_index', 'ajax'); // View, Layout
        }
    }

    public function rest_index()
    {
        if ($this->authenticateRest($this->request->query)) {
            $this->studentId = $this->restStudentId($this->request->query);
            $this->Prg->commonProcess();
            $this->Paginator->settings = $this->paginate;
            $this->Paginator->settings['conditions'] = array('Result.student_id' => $this->studentId, 'Result.user_id >' => 0);
            $this->Paginator->settings['limit'] = 99999999999999999;
            $this->Paginator->settings['maxLimit'] = $this->maxLimit;
            $response = $this->Paginator->paginate();
            $status = true;
            $message = __('Result fetch successfully');
        } else {
            $status = false;
            $message = ('Invalid Token');
            $response = (object)array();
        }
        $this->set(compact('status', 'message', 'response'));
        $this->set('_serialize', array('status', 'message', 'response'));
    }

    public function crm_view($id = null, $type = "crm", $publicKey = null, $privateKey = null)
    {
        if ($this->adminValue) {
            $studArr = $this->Result->findById($id);
            $this->studentId = $studArr['Result']['student_id'];
        } else {
            if ($type == "crm") {
                $this->authenticate();
            } else {
                if ($this->authenticateRest($this->request->query)) {
                    $this->studentId = $this->restStudentId($this->request->query);
                } else {
                    echo __('Invalid Post');
                    die();
                }
            }
        }
        $this->set('type', $type);
        $declareResult = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Exam.declare_result' => 'Yes')));
        if ($declareResult == 0) {
            $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('ExamStat');
        $this->loadModel('ExamQuestion');
        $studentCount = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId)));
        if ($id == null || $studentCount == 0) {
            $this->redirect(array('action' => 'index'));
        }
        $examDetails = $this->Result->find('first', array('fields' => array('Exam.id', 'Exam.multi_language', 'Exam.name', 'Exam.type', 'User.name', 'Result.id', 'Result.percent', 'Result.obtained_marks', 'Result.total_marks', 'Result.total_question', 'Result.total_attempt', 'Exam.passing_percent', 'Exam.duration', 'Result.result', 'Result.start_time', 'Result.end_time', 'Exam.declare_result', 'Result.total_answered'),
            'joins' => array(array('table' => 'users', 'alias' => 'User', 'type' => 'inner',
                'conditions' => array('Result.user_id=User.id'))),
            'conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Result.user_id >' => 0)));
        $userSubject = $this->Result->userSubject($id);
        $userMarksheet = $this->Result->userMarksheet($id);
        $totalStudentCount = $this->Result->find('count', array('conditions' => array('Result.exam_id' => $examDetails['Exam']['id'], 'Result.user_id >' => 0)));
        $correctQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'R')));
        $incorrectQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'W')));
        $this->ExamStat->virtualFields = array('total_marks' => 'SUM(marks_obtained)');
        $rightMarksArr = $this->ExamStat->find('first', array('fields' => array('total_marks'), 'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'R')));
        $negativeMarksArr = $this->ExamStat->find('first', array('fields' => array('total_marks'), 'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'W')));
        $this->ExamStat->virtualFields = array();
        $leftQuestion = $examDetails['Result']['total_question'] - $examDetails['Result']['total_answered'];
        $this->ExamStat->virtualFields = array('left_marks' => 'SUM(ExamStat.marks)');
        $leftQuestionArr = $this->ExamStat->find('first', array('joins' => array(array('table' => 'questions', 'alias' => 'Question', 'type' => 'Inner', 'conditions' => array('ExamStat.question_id=Question.id'))),
            'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 0)));
        $this->ExamStat->virtualFields = array();
        $this->Result->query('SET @i=0;');
        $rankArr = $this->Result->query('SELECT `id`,`student_id`,`percent`, @i:=@i+1 AS rank FROM `exam_results` WHERE `exam_id`=' . $examDetails['Exam']['id'] . ' ORDER BY `percent` DESC');
        foreach ($rankArr as $rnk) {
            if ($rnk['exam_results']['id'] == $id) {
                $rank = $rnk[0]['rank'];
                break;
            }
        }
        $this->Result->query('SET @i=0;');
        $topRankArr = $this->Result->query('SELECT `id`,`student_id`,`percent`, @i:=@i+1 AS rank FROM `exam_results` WHERE `exam_id`=' . $examDetails['Exam']['id'] . ' AND `user_id` IS NOT NULL ORDER BY `percent` DESC');
        $userSectionQuestion = $this->Result->userSectionQuestion($examDetails['Result']['id'], $examDetails['Exam']['id'], $examDetails['Exam']['type'], $this->studentId);
        $rightMarks = $rightMarksArr['ExamStat']['total_marks'];
        if ($rightMarks == "")
            $rightMarks = 0;
        $negativeMarks = $negativeMarksArr['ExamStat']['total_marks'];
        if ($negativeMarks == "")
            $negativeMarks = 0;
        $leftQuestionMarks = $leftQuestionArr['ExamStat']['left_marks'];
        if ($leftQuestionMarks == "")
            $leftQuestionMarks = 0;
        $attemptedQuestion = $examDetails['Result']['total_answered'];
        if (strlen($this->userValue['Student']['photo']) > 0)
            $studentImage = 'student_thumb/' . $this->userValue['Student']['photo'];
        else
            $studentImage = 'User.png';
        $rank = $rank;
        $mainRank = $rank;
        $myRank = $this->showRank($rank);
        $percent = $examDetails['Result']['percent'];
        $percentile = round((($totalStudentCount - $rank) / $totalStudentCount) * 100, 2);

        $this->set('examDetails', $examDetails);
        $this->set('userMarksheet', $userMarksheet);
        $this->set('id', $id);
        $this->set('totalStudentCount', $totalStudentCount);
        $this->set('correctQuestion', $correctQuestion);
        $this->set('incorrectQuestion', $incorrectQuestion);
        $this->set('rightMarks', $rightMarks);
        $this->set('negativeMarks', $negativeMarks);
        $this->set('leftQuestion', $leftQuestion);
        $this->set('leftQuestionMarks', $leftQuestionMarks);
        $this->set('myRank', $myRank);
        $this->set('percentile', $percentile);
        $this->set('userSectionQuestion', $userSectionQuestion);
        $this->set('attemptedQuestion', $attemptedQuestion);
        $this->set('studentImage', $studentImage);

        $post = $this->Result->userExamQuestion($id, $this->studentId);

        $this->set('post', $post);
        $this->loadModel('Language');
        if ($examDetails['Exam']['multi_language'] == 1) {
            $langArr = $this->Language->find('list');
            $this->set('langArr', $langArr);
            $this->set('languageCount', count($langArr));
            $this->set('languageArr', $this->Language->find('all'));
        } else {
            $langArr = $this->Language->find('list', array('conditions' => array('Language.id' => 1)));
            $this->set('langArr', $langArr);
            $this->set('languageCount', 1);
            $this->set('languageArr', $this->Language->find('list', array('conditions' => array('Language.id' => 1))));
            $langArr1 = $this->Language->find('list');
            $this->set('fullLanguageCount', count($langArr1));
        }
        foreach ($userSubject as $subjectValue) {
            $xAxisCategories[] = $subjectValue['Subject']['subject_name'];
        }
        foreach ($userMarksheet as $k => $userMarkValue) {
            if (strlen($k) != 5) {
                $chartData[] = (float)$userMarkValue['Subject']['total_marks'];
                $chartData1[] = (float)$userMarkValue['Subject']['obtained_marks'];
                $timeTaken = $this->CustomFunction->secondsToWords($userMarkValue['Subject']['time_taken'], '-');
                $chartRerData[] = array('name' => $userMarkValue['Subject']['name'], 'y' => ($userMarkValue['Subject']['time_taken'] / 60), 'mylabel' => $timeTaken);
            }
        }

        $chartName = "My Chartdl";
        $mychart = $this->HighCharts->create($chartName, 'column');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperdl",  // div to display chart inside
                'xAxisCategories' => $xAxisCategories,
                'yAxisTitleText' => __('Score'),
                'plotOptionsColumnDataLabelsEnabled' => TRUE,
                'legendEnabled' => FALSE,
                'enableAutoStep' => FALSE,
                'creditsEnabled' => FALSE,
            )
        );
        $series = $this->HighCharts->addChartSeries();
        $series1 = $this->HighCharts->addChartSeries();
        $series->addName(__('Max Marks'))->addData($chartData);
        $series1->addName(__('Marks Scored'))->addData($chartData1);
        $mychart->addSeries($series);
        $mychart->addSeries($series1);

        $chartName = "Pie Chartqc";
        $pieChart = $this->HighCharts->create($chartName, 'pie');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "piewrapperqc",  // div to display chart inside
                'title' => __('Subject Wise Time Taken'),
                'titleAlign' => 'center',
                'creditsEnabled' => FALSE,
                'plotOptionsShowInLegend' => TRUE,
                'plotOptionsPieShowInLegend' => TRUE,
                'plotOptionsPieDataLabelsEnabled' => TRUE,
                'plotOptionsPieDataLabelsFormat' => '{point.name}:<b>{point.mylabel}</b>',
                'tooltipEnabled' => TRUE,
                'tooltipPointFormat' => '{point.mylabel}</b>'
            )
        );

        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Subject Wise Time Taken'))->addData($chartRerData);
        $pieChart->addSeries($series);

        $chartDataTotal[] = (float)$examDetails['Result']['total_marks'];
        $chartDataTotal1[] = (float)$examDetails['Result']['obtained_marks'];
        $chartName = "My Chartd2";
        $mychart = $this->HighCharts->create($chartName, 'column');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperd2",  // div to display chart inside
                'xAxisCategories' => array(__('Student Performance')),
                'yAxisTitleText' => __('Score'),
                'plotOptionsColumnDataLabelsEnabled' => TRUE,
                'legendEnabled' => FALSE,
                'enableAutoStep' => FALSE,
                'creditsEnabled' => FALSE,
            )
        );
        $series = $this->HighCharts->addChartSeries();
        $series1 = $this->HighCharts->addChartSeries();
        $series->addName(__('Max Marks'))->addData($chartDataTotal);
        $series1->addName(__('Marks Scored'))->addData($chartDataTotal1);
        $mychart->addSeries($series);
        $mychart->addSeries($series1);

        $chartQuestionRerData = array(array(__('Correct Question'), $correctQuestion),
            array(__('Incorrect Question'), $incorrectQuestion),
            array(__('Right Marks'), (int)$rightMarks),
            array(__('Negative Marks'), (int)str_replace("-", "", $negativeMarks)));
        $chartName = "My Chartd3";
        $pieChart = $this->HighCharts->create($chartName, 'pie');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperd3",  // div to display chart inside
                'titleAlign' => 'center',
                'creditsEnabled' => FALSE,
                'plotOptionsShowInLegend' => TRUE,
                'plotOptionsPieShowInLegend' => TRUE,
                'plotOptionsPieDataLabelsEnabled' => TRUE,
                'plotOptionsPieDataLabelsFormat' => '{point.name}:<b>{point.y}</b>',
                'tooltipEnabled' => TRUE,
                'tooltipPointFormat' => '<b>{point.y}</b>'
            )
        );

        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Subject Wise Time Taken'))->addData($chartQuestionRerData);
        $pieChart->addSeries($series);
        ############## Compare Report #############
        $xAxisCategories = array();
        $compareArr = array();
        $isYou = false;
        foreach ($topRankArr as $k => $postArr) {
            $studentId = $postArr['exam_results']['student_id'];
            $myRank = $postArr[0]['rank'];
            $resultId = $postArr['exam_results']['id'];
            $examDetails = $this->Result->find('first', array('fields' => array('Student.name', 'Student.photo', 'Result.exam_id', 'Result.percent', 'Result.obtained_marks', 'Result.total_marks', 'Result.total_question', 'Result.total_attempt', 'Result.result', 'Result.start_time', 'Result.end_time', 'Result.total_answered'),
                'joins' => array(array('table' => 'students', 'alias' => 'Student', 'type' => 'inner', 'conditions' => array('Result.student_id=Student.id'))),
                'conditions' => array('Result.id' => $resultId, 'Result.student_id' => $studentId, 'Result.user_id >' => 0)));
            $correctQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $resultId, 'answered' => 1, 'ques_status' => 'R')));
            $incorrectQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $resultId, 'answered' => 1, 'ques_status' => 'W')));
            $leftQuestion = $examDetails['Result']['total_question'] - $examDetails['Result']['total_answered'];
            $attemptedQuestion = $examDetails['Result']['total_answered'];
            if (strlen($examDetails['Student']['photo']) > 0)
                $studentImage = 'student_thumb/' . $examDetails['Student']['photo'];
            else
                $studentImage = 'User.png';
            $rank = $this->showRank($myRank);
            $totalStudentCount = $this->Result->find('count', array('conditions' => array('Result.exam_id' => $examDetails['Result']['exam_id'], 'Result.user_id >' => 0)));
            $percentile = round((($totalStudentCount - $rank) / $totalStudentCount) * 100, 2);
            if ($id != $resultId)
                $compareArr[] = array($examDetails, 'correct_question' => $correctQuestion, 'incorrect_question' => $incorrectQuestion, 'left_question' => $leftQuestion, 'attempted_question' => $attemptedQuestion, 'student_image' => $studentImage, 'rank' => $rank, 'percentile' => $percentile);
            $topperData[] = (float)$examDetails['Result']['percent'];
            if ($id == $resultId) {
                $isYou = true;
                $xAxisCategories[] = array(__d('default', "You %s", $myRank));
            } else
                $xAxisCategories[] = array(__d('default', "Topper %s", $myRank));
            if ($k == 9)
                break;
        }
        if ($isYou == false) {
            $xAxisCategories[] = array(__d('default', "You %s", $mainRank));
            $topperData[] = (float)$percent;
        }
        $this->set('compareArr', $compareArr);
        $this->set('compareCount', count($compareArr) - 1);
        $chartName = "My Chartd5";
        $mychart = $this->HighCharts->create($chartName, 'column');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperd5",  // div to display chart inside
                'xAxisCategories' => $xAxisCategories,
                'yAxisTitleText' => __('Percentage(%) in Exam'),
                'plotOptionsColumnDataLabelsEnabled' => TRUE,
                'legendEnabled' => FALSE,
                'enableAutoStep' => FALSE,
                'creditsEnabled' => FALSE,
                'yAxisMax' => 100,
            )
        );
        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Percentage(%)'))->addData($topperData);
        $mychart->addSeries($series);
        ############## End Report     #############
    }

    public function crm_attemptedpapers($id = null)
    {
        $declareResult = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Exam.declare_result' => 'Yes')));
        if ($declareResult == 0) {
            $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('ExamStat');
        $post = $this->ExamStat->find('all', array('joins' => array(array('table' => 'questions', 'alias' => 'Question', 'type' => 'Inner',
            'conditions' => array('Question.id=ExamStat.question_id')),
            array('table' => 'qtypes', 'alias' => 'Qtype', 'type' => 'Inner',
                'conditions' => array('Qtype.id=Question.qtype_id')),
            array('table' => 'subjects', 'alias' => 'Subject', 'type' => 'Inner',
                'conditions' => array('Subject.id=Question.subject_id'))),
            'fields' => array('ExamStat.*', '(TIMESTAMPDIFF(SECOND,ExamStat.attempt_time,ExamStat.modified)) AS time_taken', 'Question.*', 'Subject.*', 'Qtype.*'),
            'conditions' => array('ExamStat.exam_result_id' => $id, 'ExamStat.student_id' => $this->studentId),
            'order' => array('ExamStat.ques_no' => 'asc')));
        $this->set('post', $post);
        $this->set('id', $id);
        $this->loadModel('User');
        $this->set('UserArr', $this->User->find('all'));
    }

    public function crm_certificate($id = null)
    {
        $this->layout = 'pdf';
        if (isset($this->request->query['public_key']) && isset($this->request->query['private_key'])) {
            if (!$this->authenticateRest($this->request->query)) {
                echo('Invalid Token');
                die();
            } else {
                $this->studentId = $this->restStudentId($this->request->query);
                if (isset($this->request->query['id'])) {
                    $id = $this->request->query['id'];
                    $this->set('userValue', $this->userValue);
                } else {
                    echo __('Invalid Post');
                    die();
                }
            }
        } else {
            $this->authenticate();
        }
        $result = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId)));
        if ($result == 0 || !$this->siteCertificate) {
            $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Result->find('first', array('fields' => array('Exam.name', 'Result.total_marks', 'Result.obtained_marks', 'Result.percent', 'Result.start_time'),
            'conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId)));
        $this->pdfConfig = array('filename' => 'Certificate-' . rand() . '.pdf');
        $this->set('post', $post);
    }

    public function showRank($rank)
    {
        if ($rank == 1)
            $rank = "1<sup>" . __('st') . "</sup>";
        elseif ($rank == 2)
            $rank = "2<sup>" . __('nd') . "</sup>";
        elseif ($rank == 3)
            $rank = "3<sup>" . __('rd') . "</sup>";
        else
            $rank = "$rank<sup>" . __('th') . "</sup>";
        return $rank;
    }

    public function crm_bookmark($examResultId)
    {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');
        $this->loadModel('ExamStat');
        $quesNo = $_REQUEST['id'];
        $examStatArr = $this->ExamStat->find('first', array('fields' => array('ExamStat.id', 'ExamStat.bookmark'), 'conditions' => array('ExamStat.exam_result_id' => $examResultId, 'ques_no' => $quesNo, 'student_id' => $this->studentId)));
        if ($examStatArr) {
            $examStatId = $examStatArr['ExamStat']['id'];
            $boomark = $examStatArr['ExamStat']['bookmark'];
            if ($boomark == 'Y')
                $boomarkSave = NULL;
            else
                $boomarkSave = 'Y';
            $this->ExamStat->save(array('id' => $examStatId, 'bookmark' => $boomarkSave));
            print$boomarkSave;
        }
    }

    public function crm_printresult($id = null)
    {
        try {
            $this->layout = 'pdf';
            if (isset($this->request->query['public_key']) && isset($this->request->query['private_key'])) {
                if (!$this->authenticateRest($this->request->query)) {
                    echo('Invalid Token');
                    die();
                } else {
                    $this->studentId = $this->restStudentId($this->request->query);
                    if (isset($this->request->query['id'])) {
                        $id = $this->request->query['id'];
                        $this->set('userValue', $this->userValue);
                    } else {
                        echo __('Invalid Post');
                        die();
                    }
                }
                $this->crm_view($id, 'rest', $this->request->query['public_key'], $this->request->query['private_key']);
            } elseif ($this->adminValue) {
                $this->crm_view($id);
            } else {
                $this->authenticate();
                $this->crm_view($id);
            }
        } catch (Exception $e) {
            $this->Session->setFlash($e->getMessage(), 'flash', array('alert' => 'danger'));
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function crm_viewm($id = null, $studentId)
    {
        if ($this->adminValue) {
            $studArr = $this->Result->findById($id);
            $this->studentId = $studArr['Result']['student_id'];
        }
        $this->studentId = $studentId;
        $declareResult = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Exam.declare_result' => 'Yes')));
        if ($declareResult == 0) {
            $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('ExamStat');
        $this->loadModel('ExamQuestion');
        $studentCount = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId)));
        if ($id == null || $studentCount == 0) {
            $this->redirect(array('action' => 'index'));
        }
        $examDetails = $this->Result->find('first', array('fields' => array('Exam.id', 'Exam.name', 'Exam.type', 'User.name', 'Result.id', 'Result.percent', 'Result.obtained_marks', 'Result.total_marks', 'Result.total_question', 'Result.total_attempt', 'Exam.passing_percent', 'Exam.duration', 'Result.result', 'Result.start_time', 'Result.end_time', 'Exam.declare_result', 'Result.total_answered'),
            'joins' => array(array('table' => 'users', 'alias' => 'User', 'type' => 'inner',
                'conditions' => array('Result.user_id=User.id'))),
            'conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Result.user_id >' => 0)));
        $userSubject = $this->Result->userSubject($id);
        $userMarksheet = $this->Result->userMarksheet($id);
        $totalStudentCount = $this->Result->find('count', array('conditions' => array('Result.exam_id' => $examDetails['Exam']['id'], 'Result.user_id >' => 0)));
        $correctQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'R')));
        $incorrectQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'W')));
        $this->ExamStat->virtualFields = array('total_marks' => 'SUM(marks_obtained)');
        $rightMarksArr = $this->ExamStat->find('first', array('fields' => array('total_marks'), 'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'R')));
        $negativeMarksArr = $this->ExamStat->find('first', array('fields' => array('total_marks'), 'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'W')));
        $this->ExamStat->virtualFields = array();
        $leftQuestion = $examDetails['Result']['total_question'] - $examDetails['Result']['total_answered'];
        $this->ExamStat->virtualFields = array('left_marks' => 'SUM(ExamStat.marks)');
        $leftQuestionArr = $this->ExamStat->find('first', array('joins' => array(array('table' => 'questions', 'alias' => 'Question', 'type' => 'Inner', 'conditions' => array('ExamStat.question_id=Question.id'))),
            'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 0)));
        $this->ExamStat->virtualFields = array();
        $this->Result->query('SET @i=0;');
        $rankArr = $this->Result->query('SELECT `id`,`student_id`,`percent`, @i:=@i+1 AS rank FROM `exam_results` WHERE `exam_id`=' . $examDetails['Exam']['id'] . ' ORDER BY `percent` DESC');
        foreach ($rankArr as $rnk) {
            if ($rnk['exam_results']['id'] == $id) {
                $rank = $rnk[0]['rank'];
                break;
            }
        }
        $this->Result->query('SET @i=0;');
        $topRankArr = $this->Result->query('SELECT `id`,`student_id`,`percent`, @i:=@i+1 AS rank FROM `exam_results` WHERE `exam_id`=' . $examDetails['Exam']['id'] . ' AND `user_id` IS NOT NULL ORDER BY `percent` DESC');
        $userSectionQuestion = $this->Result->userSectionQuestion($examDetails['Result']['id'], $examDetails['Exam']['id'], $examDetails['Exam']['type'], $this->studentId);
        $rightMarks = $rightMarksArr['ExamStat']['total_marks'];
        if ($rightMarks == "")
            $rightMarks = 0;
        $negativeMarks = $negativeMarksArr['ExamStat']['total_marks'];
        if ($negativeMarks == "")
            $negativeMarks = 0;
        $leftQuestionMarks = $leftQuestionArr['ExamStat']['left_marks'];
        if ($leftQuestionMarks == "")
            $leftQuestionMarks = 0;
        $attemptedQuestion = $examDetails['Result']['total_answered'];
        if (strlen($this->userValue['Student']['photo']) > 0)
            $studentImage = 'student_thumb/' . $this->userValue['Student']['photo'];
        else
            $studentImage = 'User.png';
        $rank = $rank;
        $mainRank = $rank;
        $myRank = $this->showRank($rank);
        $percent = $examDetails['Result']['percent'];
        $percentile = round((($totalStudentCount - $rank) / $totalStudentCount) * 100, 2);

        $this->set('examDetails', $examDetails);
        $this->set('userMarksheet', $userMarksheet);
        $this->set('id', $id);
        $this->set('totalStudentCount', $totalStudentCount);
        $this->set('correctQuestion', $correctQuestion);
        $this->set('incorrectQuestion', $incorrectQuestion);
        $this->set('rightMarks', $rightMarks);
        $this->set('negativeMarks', $negativeMarks);
        $this->set('leftQuestion', $leftQuestion);
        $this->set('leftQuestionMarks', $leftQuestionMarks);
        $this->set('myRank', $myRank);
        $this->set('percentile', $percentile);
        $this->set('userSectionQuestion', $userSectionQuestion);
        $this->set('attemptedQuestion', $attemptedQuestion);
        $this->set('studentImage', $studentImage);

        $post = $this->ExamStat->find('all', array('joins' => array(array('table' => 'questions', 'alias' => 'Question', 'type' => 'Inner', 'conditions' => array('Question.id=ExamStat.question_id')),
            array('table' => 'qtypes', 'alias' => 'Qtype', 'type' => 'Inner', 'conditions' => array('Qtype.id=Question.qtype_id')),
            array('table' => 'diffs', 'alias' => 'Diff', 'type' => 'Inner', 'conditions' => array('Diff.id=Question.diff_id'))),
            'fields' => array('ExamStat.*', 'Question.*', 'Diff.*', 'Qtype.*'),
            'conditions' => array('ExamStat.exam_result_id' => $id, 'ExamStat.student_id' => $this->studentId),
            'order' => array('ExamStat.ques_no' => 'asc')));
        $this->set('post', $post);

        foreach ($userSubject as $subjectValue) {
            $xAxisCategories[] = $subjectValue['Subject']['subject_name'];
        }
        foreach ($userMarksheet as $k => $userMarkValue) {
            if (strlen($k) != 5) {
                $chartData[] = (float)$userMarkValue['Subject']['total_marks'];
                $chartData1[] = (float)$userMarkValue['Subject']['obtained_marks'];
                $timeTaken = $this->CustomFunction->secondsToWords($userMarkValue['Subject']['time_taken'], '-');
                $chartRerData[] = array('name' => $userMarkValue['Subject']['name'], 'y' => ($userMarkValue['Subject']['time_taken'] / 60), 'mylabel' => $timeTaken);
            }
        }

        $chartName = "My Chartdl";
        $mychart = $this->HighCharts->create($chartName, 'column');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperdl",  // div to display chart inside
                'xAxisCategories' => $xAxisCategories,
                'yAxisTitleText' => __('Score'),
                'plotOptionsColumnDataLabelsEnabled' => TRUE,
                'legendEnabled' => FALSE,
                'enableAutoStep' => FALSE,
                'creditsEnabled' => FALSE,
            )
        );
        $series = $this->HighCharts->addChartSeries();
        $series1 = $this->HighCharts->addChartSeries();
        $series->addName(__('Max Marks'))->addData($chartData);
        $series1->addName(__('Marks Scored'))->addData($chartData1);
        $mychart->addSeries($series);
        $mychart->addSeries($series1);

        $chartName = "Pie Chartqc";
        $pieChart = $this->HighCharts->create($chartName, 'pie');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "piewrapperqc",  // div to display chart inside
                'title' => __('Subject Wise Time Taken'),
                'titleAlign' => 'center',
                'creditsEnabled' => FALSE,
                'plotOptionsShowInLegend' => TRUE,
                'plotOptionsPieShowInLegend' => TRUE,
                'plotOptionsPieDataLabelsEnabled' => TRUE,
                'plotOptionsPieDataLabelsFormat' => '{point.name}:<b>{point.mylabel}</b>',
                'tooltipEnabled' => TRUE,
                'tooltipPointFormat' => '{point.mylabel}</b>'
            )
        );

        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Subject Wise Time Taken'))->addData($chartRerData);
        $pieChart->addSeries($series);

        $chartDataTotal[] = (float)$examDetails['Result']['total_marks'];
        $chartDataTotal1[] = (float)$examDetails['Result']['obtained_marks'];
        $chartName = "My Chartd2";
        $mychart = $this->HighCharts->create($chartName, 'column');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperd2",  // div to display chart inside
                'xAxisCategories' => array(__('Student Performance')),
                'yAxisTitleText' => __('Score'),
                'plotOptionsColumnDataLabelsEnabled' => TRUE,
                'legendEnabled' => FALSE,
                'enableAutoStep' => FALSE,
                'creditsEnabled' => FALSE,
            )
        );
        $series = $this->HighCharts->addChartSeries();
        $series1 = $this->HighCharts->addChartSeries();
        $series->addName(__('Max Marks'))->addData($chartDataTotal);
        $series1->addName(__('Marks Scored'))->addData($chartDataTotal1);
        $mychart->addSeries($series);
        $mychart->addSeries($series1);

        $chartQuestionRerData = array(array(__('Correct Question'), $correctQuestion),
            array(__('Incorrect Question'), $incorrectQuestion),
            array(__('Right Marks'), (int)$rightMarks),
            array(__('Negative Marks'), (int)str_replace("-", "", $negativeMarks)));
        $chartName = "My Chartd3";
        $pieChart = $this->HighCharts->create($chartName, 'pie');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperd3",  // div to display chart inside
                'titleAlign' => 'center',
                'creditsEnabled' => FALSE,
                'plotOptionsShowInLegend' => TRUE,
                'plotOptionsPieShowInLegend' => TRUE,
                'plotOptionsPieDataLabelsEnabled' => TRUE,
                'plotOptionsPieDataLabelsFormat' => '{point.name}:<b>{point.y}</b>',
                'tooltipEnabled' => TRUE,
                'tooltipPointFormat' => '<b>{point.y}</b>'
            )
        );

        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Subject Wise Time Taken'))->addData($chartQuestionRerData);
        $pieChart->addSeries($series);
        ############## Compare Report #############
        $xAxisCategories = array();
        $compareArr = array();
        $isYou = false;
        foreach ($topRankArr as $k => $postArr) {
            $studentId = $postArr['exam_results']['student_id'];
            $myRank = $postArr[0]['rank'];
            $resultId = $postArr['exam_results']['id'];
            $examDetails = $this->Result->find('first', array('fields' => array('Student.name', 'Student.photo', 'Result.exam_id', 'Result.percent', 'Result.obtained_marks', 'Result.total_marks', 'Result.total_question', 'Result.total_attempt', 'Result.result', 'Result.start_time', 'Result.end_time', 'Result.total_answered'),
                'joins' => array(array('table' => 'students', 'alias' => 'Student', 'type' => 'inner', 'conditions' => array('Result.student_id=Student.id'))),
                'conditions' => array('Result.id' => $resultId, 'Result.student_id' => $studentId, 'Result.user_id >' => 0)));
            $correctQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $resultId, 'answered' => 1, 'ques_status' => 'R')));
            $incorrectQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $resultId, 'answered' => 1, 'ques_status' => 'W')));
            $leftQuestion = $examDetails['Result']['total_question'] - $examDetails['Result']['total_answered'];
            $attemptedQuestion = $examDetails['Result']['total_answered'];
            if (strlen($examDetails['Student']['photo']) > 0)
                $studentImage = 'student_thumb/' . $examDetails['Student']['photo'];
            else
                $studentImage = 'User.png';
            $rank = $this->showRank($myRank);
            $totalStudentCount = $this->Result->find('count', array('conditions' => array('Result.exam_id' => $examDetails['Result']['exam_id'], 'Result.user_id >' => 0)));
            $percentile = round((($totalStudentCount - $rank) / $totalStudentCount) * 100, 2);
            if ($id != $resultId)
                $compareArr[] = array($examDetails, 'correct_question' => $correctQuestion, 'incorrect_question' => $incorrectQuestion, 'left_question' => $leftQuestion, 'attempted_question' => $attemptedQuestion, 'student_image' => $studentImage, 'rank' => $rank, 'percentile' => $percentile);
            $topperData[] = (float)$examDetails['Result']['percent'];
            if ($id == $resultId) {
                $isYou = true;
                $xAxisCategories[] = array(__d('default', "You %s", $myRank));
            } else
                $xAxisCategories[] = array(__d('default', "Topper %s", $myRank));
            if ($k == 9)
                break;
        }
        if ($isYou == false) {
            $xAxisCategories[] = array(__d('default', "You %s", $mainRank));
            $topperData[] = (float)$percent;
        }
        $this->set('compareArr', $compareArr);
        $this->set('compareCount', count($compareArr) - 1);
        $chartName = "My Chartd5";
        $mychart = $this->HighCharts->create($chartName, 'column');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperd5",  // div to display chart inside
                'xAxisCategories' => $xAxisCategories,
                'yAxisTitleText' => __('Percentage(%) in Exam'),
                'plotOptionsColumnDataLabelsEnabled' => TRUE,
                'legendEnabled' => FALSE,
                'enableAutoStep' => FALSE,
                'creditsEnabled' => FALSE,
                'yAxisMax' => 100,
            )
        );
        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Percentage(%)'))->addData($topperData);
        $mychart->addSeries($series);
        ############## End Report     #############
    }

    public function crm_viewcompare($id = null, $studentId)
    {
        if ($this->adminValue) {
            $studArr = $this->Result->findById($id);
            $this->studentId = $studArr['Result']['student_id'];
        }
        $this->studentId = $studentId;
        $declareResult = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Exam.declare_result' => 'Yes')));
        if ($declareResult == 0) {
            $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('ExamStat');
        $this->loadModel('ExamQuestion');
        $studentCount = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId)));
        if ($id == null || $studentCount == 0) {
            $this->redirect(array('action' => 'index'));
        }
        $examDetails = $this->Result->find('first', array('fields' => array('Exam.id', 'Exam.name', 'Exam.type', 'User.name', 'Result.id', 'Result.percent', 'Result.obtained_marks', 'Result.total_marks', 'Result.total_question', 'Result.total_attempt', 'Exam.passing_percent', 'Exam.duration', 'Result.result', 'Result.start_time', 'Result.end_time', 'Exam.declare_result', 'Result.total_answered'),
            'joins' => array(array('table' => 'users', 'alias' => 'User', 'type' => 'inner',
                'conditions' => array('Result.user_id=User.id'))),
            'conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Result.user_id >' => 0)));
        $userSubject = $this->Result->userSubject($id);
        $userMarksheet = $this->Result->userMarksheet($id);
        $totalStudentCount = $this->Result->find('count', array('conditions' => array('Result.exam_id' => $examDetails['Exam']['id'], 'Result.user_id >' => 0)));
        $correctQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'R')));
        $incorrectQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'W')));
        $this->ExamStat->virtualFields = array('total_marks' => 'SUM(marks_obtained)');
        $rightMarksArr = $this->ExamStat->find('first', array('fields' => array('total_marks'), 'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'R')));
        $negativeMarksArr = $this->ExamStat->find('first', array('fields' => array('total_marks'), 'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'W')));
        $this->ExamStat->virtualFields = array();
        $leftQuestion = $examDetails['Result']['total_question'] - $examDetails['Result']['total_answered'];
        $this->ExamStat->virtualFields = array('left_marks' => 'SUM(ExamStat.marks)');
        $leftQuestionArr = $this->ExamStat->find('first', array('joins' => array(array('table' => 'questions', 'alias' => 'Question', 'type' => 'Inner', 'conditions' => array('ExamStat.question_id=Question.id'))),
            'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 0)));
        $this->ExamStat->virtualFields = array();
        $this->Result->query('SET @i=0;');
        $rankArr = $this->Result->query('SELECT `id`,`student_id`,`percent`, @i:=@i+1 AS rank FROM `exam_results` WHERE `exam_id`=' . $examDetails['Exam']['id'] . ' ORDER BY `percent` DESC');
        foreach ($rankArr as $rnk) {
            if ($rnk['exam_results']['id'] == $id) {
                $rank = $rnk[0]['rank'];
                break;
            }
        }
        $this->Result->query('SET @i=0;');
        $topRankArr = $this->Result->query('SELECT `id`,`student_id`,`percent`, @i:=@i+1 AS rank FROM `exam_results` WHERE `exam_id`=' . $examDetails['Exam']['id'] . ' AND `user_id` IS NOT NULL ORDER BY `percent` DESC');
        $userSectionQuestion = $this->Result->userSectionQuestion($examDetails['Result']['id'], $examDetails['Exam']['id'], $examDetails['Exam']['type'], $this->studentId);
        $rightMarks = $rightMarksArr['ExamStat']['total_marks'];
        if ($rightMarks == "")
            $rightMarks = 0;
        $negativeMarks = $negativeMarksArr['ExamStat']['total_marks'];
        if ($negativeMarks == "")
            $negativeMarks = 0;
        $leftQuestionMarks = $leftQuestionArr['ExamStat']['left_marks'];
        if ($leftQuestionMarks == "")
            $leftQuestionMarks = 0;
        $attemptedQuestion = $examDetails['Result']['total_answered'];
        if (strlen($this->userValue['Student']['photo']) > 0)
            $studentImage = 'student_thumb/' . $this->userValue['Student']['photo'];
        else
            $studentImage = 'User.png';
        $rank = $rank;
        $mainRank = $rank;
        $myRank = $this->showRank($rank);
        $percent = $examDetails['Result']['percent'];
        $percentile = round((($totalStudentCount - $rank) / $totalStudentCount) * 100, 2);

        $this->set('examDetails', $examDetails);
        $this->set('userMarksheet', $userMarksheet);
        $this->set('id', $id);
        $this->set('totalStudentCount', $totalStudentCount);
        $this->set('correctQuestion', $correctQuestion);
        $this->set('incorrectQuestion', $incorrectQuestion);
        $this->set('rightMarks', $rightMarks);
        $this->set('negativeMarks', $negativeMarks);
        $this->set('leftQuestion', $leftQuestion);
        $this->set('leftQuestionMarks', $leftQuestionMarks);
        $this->set('myRank', $myRank);
        $this->set('percentile', $percentile);
        $this->set('userSectionQuestion', $userSectionQuestion);
        $this->set('attemptedQuestion', $attemptedQuestion);
        $this->set('studentImage', $studentImage);

        $post = $this->ExamStat->find('all', array('joins' => array(array('table' => 'questions', 'alias' => 'Question', 'type' => 'Inner', 'conditions' => array('Question.id=ExamStat.question_id')),
            array('table' => 'qtypes', 'alias' => 'Qtype', 'type' => 'Inner', 'conditions' => array('Qtype.id=Question.qtype_id')),
            array('table' => 'diffs', 'alias' => 'Diff', 'type' => 'Inner', 'conditions' => array('Diff.id=Question.diff_id'))),
            'fields' => array('ExamStat.*', 'Question.*', 'Diff.*', 'Qtype.*'),
            'conditions' => array('ExamStat.exam_result_id' => $id, 'ExamStat.student_id' => $this->studentId),
            'order' => array('ExamStat.ques_no' => 'asc')));
        $this->set('post', $post);

        foreach ($userSubject as $subjectValue) {
            $xAxisCategories[] = $subjectValue['Subject']['subject_name'];
        }
        foreach ($userMarksheet as $k => $userMarkValue) {
            if (strlen($k) != 5) {
                $chartData[] = (float)$userMarkValue['Subject']['total_marks'];
                $chartData1[] = (float)$userMarkValue['Subject']['obtained_marks'];
                $timeTaken = $this->CustomFunction->secondsToWords($userMarkValue['Subject']['time_taken'], '-');
                $chartRerData[] = array('name' => $userMarkValue['Subject']['name'], 'y' => ($userMarkValue['Subject']['time_taken'] / 60), 'mylabel' => $timeTaken);
            }
        }

        $chartName = "My Chartdl";
        $mychart = $this->HighCharts->create($chartName, 'column');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperdl",  // div to display chart inside
                'xAxisCategories' => $xAxisCategories,
                'yAxisTitleText' => __('Score'),
                'plotOptionsColumnDataLabelsEnabled' => TRUE,
                'legendEnabled' => FALSE,
                'enableAutoStep' => FALSE,
                'creditsEnabled' => FALSE,
            )
        );
        $series = $this->HighCharts->addChartSeries();
        $series1 = $this->HighCharts->addChartSeries();
        $series->addName(__('Max Marks'))->addData($chartData);
        $series1->addName(__('Marks Scored'))->addData($chartData1);
        $mychart->addSeries($series);
        $mychart->addSeries($series1);

        $chartName = "Pie Chartqc";
        $pieChart = $this->HighCharts->create($chartName, 'pie');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "piewrapperqc",  // div to display chart inside
                'title' => __('Subject Wise Time Taken'),
                'titleAlign' => 'center',
                'creditsEnabled' => FALSE,
                'plotOptionsShowInLegend' => TRUE,
                'plotOptionsPieShowInLegend' => TRUE,
                'plotOptionsPieDataLabelsEnabled' => TRUE,
                'plotOptionsPieDataLabelsFormat' => '{point.name}:<b>{point.mylabel}</b>',
                'tooltipEnabled' => TRUE,
                'tooltipPointFormat' => '{point.mylabel}</b>'
            )
        );

        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Subject Wise Time Taken'))->addData($chartRerData);
        $pieChart->addSeries($series);

        $chartDataTotal[] = (float)$examDetails['Result']['total_marks'];
        $chartDataTotal1[] = (float)$examDetails['Result']['obtained_marks'];
        $chartName = "My Chartd2";
        $mychart = $this->HighCharts->create($chartName, 'column');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperd2",  // div to display chart inside
                'xAxisCategories' => array(__('Student Performance')),
                'yAxisTitleText' => __('Score'),
                'plotOptionsColumnDataLabelsEnabled' => TRUE,
                'legendEnabled' => FALSE,
                'enableAutoStep' => FALSE,
                'creditsEnabled' => FALSE,
            )
        );
        $series = $this->HighCharts->addChartSeries();
        $series1 = $this->HighCharts->addChartSeries();
        $series->addName(__('Max Marks'))->addData($chartDataTotal);
        $series1->addName(__('Marks Scored'))->addData($chartDataTotal1);
        $mychart->addSeries($series);
        $mychart->addSeries($series1);

        $chartQuestionRerData = array(array(__('Correct Question'), $correctQuestion),
            array(__('Incorrect Question'), $incorrectQuestion),
            array(__('Right Marks'), (int)$rightMarks),
            array(__('Negative Marks'), (int)str_replace("-", "", $negativeMarks)));
        $chartName = "My Chartd3";
        $pieChart = $this->HighCharts->create($chartName, 'pie');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperd3",  // div to display chart inside
                'titleAlign' => 'center',
                'creditsEnabled' => FALSE,
                'plotOptionsShowInLegend' => TRUE,
                'plotOptionsPieShowInLegend' => TRUE,
                'plotOptionsPieDataLabelsEnabled' => TRUE,
                'plotOptionsPieDataLabelsFormat' => '{point.name}:<b>{point.y}</b>',
                'tooltipEnabled' => TRUE,
                'tooltipPointFormat' => '<b>{point.y}</b>'
            )
        );

        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Subject Wise Time Taken'))->addData($chartQuestionRerData);
        $pieChart->addSeries($series);
        ############## Compare Report #############
        $xAxisCategories = array();
        $compareArr = array();
        $isYou = false;
        foreach ($topRankArr as $k => $postArr) {
            $studentId = $postArr['exam_results']['student_id'];
            $myRank = $postArr[0]['rank'];
            $resultId = $postArr['exam_results']['id'];
            $examDetails = $this->Result->find('first', array('fields' => array('Student.name', 'Student.photo', 'Result.exam_id', 'Result.percent', 'Result.obtained_marks', 'Result.total_marks', 'Result.total_question', 'Result.total_attempt', 'Result.result', 'Result.start_time', 'Result.end_time', 'Result.total_answered'),
                'joins' => array(array('table' => 'students', 'alias' => 'Student', 'type' => 'inner', 'conditions' => array('Result.student_id=Student.id'))),
                'conditions' => array('Result.id' => $resultId, 'Result.student_id' => $studentId, 'Result.user_id >' => 0)));
            $correctQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $resultId, 'answered' => 1, 'ques_status' => 'R')));
            $incorrectQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $resultId, 'answered' => 1, 'ques_status' => 'W')));
            $leftQuestion = $examDetails['Result']['total_question'] - $examDetails['Result']['total_answered'];
            $attemptedQuestion = $examDetails['Result']['total_answered'];
            if (strlen($examDetails['Student']['photo']) > 0)
                $studentImage = 'student_thumb/' . $examDetails['Student']['photo'];
            else
                $studentImage = 'User.png';
            $rank = $this->showRank($myRank);
            $totalStudentCount = $this->Result->find('count', array('conditions' => array('Result.exam_id' => $examDetails['Result']['exam_id'], 'Result.user_id >' => 0)));
            $percentile = round((($totalStudentCount - $rank) / $totalStudentCount) * 100, 2);
            if ($id != $resultId)
                $compareArr[] = array($examDetails, 'correct_question' => $correctQuestion, 'incorrect_question' => $incorrectQuestion, 'left_question' => $leftQuestion, 'attempted_question' => $attemptedQuestion, 'student_image' => $studentImage, 'rank' => $rank, 'percentile' => $percentile);
            $topperData[] = (float)$examDetails['Result']['percent'];
            if ($id == $resultId) {
                $isYou = true;
                $xAxisCategories[] = array(__d('default', "You %s", $myRank));
            } else
                $xAxisCategories[] = array(__d('default', "Topper %s", $myRank));
            if ($k == 9)
                break;
        }
        if ($isYou == false) {
            $xAxisCategories[] = array(__d('default', "You %s", $mainRank));
            $topperData[] = (float)$percent;
        }
        $this->set('compareArr', $compareArr);
        $this->set('compareCount', count($compareArr) - 1);
        $chartName = "My Chartd5";
        $mychart = $this->HighCharts->create($chartName, 'column');
        $this->HighCharts->setChartParams(
            $chartName,
            array(
                'renderTo' => "mywrapperd5",  // div to display chart inside
                'xAxisCategories' => $xAxisCategories,
                'yAxisTitleText' => __('Percentage(%) in Exam'),
                'plotOptionsColumnDataLabelsEnabled' => TRUE,
                'legendEnabled' => FALSE,
                'enableAutoStep' => FALSE,
                'creditsEnabled' => FALSE,
                'yAxisMax' => 100,
            )
        );
        $series = $this->HighCharts->addChartSeries();
        $series->addName(__('Percentage(%)'))->addData($topperData);
        $mychart->addSeries($series);
        ############## End Report     #############
    }

    public function rest_view()
    {
        $this->autoRender = false;
        if ($this->authenticateRest($this->request->query)) {
            $this->studentId = $this->restStudentId($this->request->query);
            if (isset($this->request->query['id'])) {
                $id = $this->request->query['id'];
            } else {
                $id = 0;
            }
            try {
                $declareResult = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Exam.declare_result' => 'Yes')));
                if ($declareResult == 0) {
                    $message = __('Invalid Post');
                } else {
                    $message = null;
                    $this->crm_view($id, 'rest', $this->request->query['public_key'], $this->request->query['private_key']);
                    $this->layout = 'rest';
                    $this->render('crm_view', null);
                }
            } catch (Exception $e) {
                $message = $e->getMessage();
            }
        } else {
            $message = ('Invalid Token');
        }
        echo $message;
    }

    public function rest_scorecard()
    {
        $id = $this->request->query['result_id'];
        $studentId = $this->request->query['student_id'];

        if ($this->adminValue) {
            $studArr = $this->Result->findById($id);
            $this->studentId = $studArr['Result']['student_id'];
        }
        $this->studentId = $studentId;
        $declareResult = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Exam.declare_result' => 'Yes')));
        if ($declareResult == 0) {
            $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('ExamStat');
        $this->loadModel('ExamQuestion');
        $studentCount = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId)));
        if ($id == null || $studentCount == 0) {
            $this->redirect(array('action' => 'index'));
        }
        $examDetails = $this->Result->find('first', array('fields' => array('Exam.id', 'Exam.name', 'Exam.type', 'User.name', 'Result.id', 'Result.percent', 'Result.obtained_marks', 'Result.total_marks', 'Result.total_question', 'Result.total_attempt', 'Exam.passing_percent', 'Exam.duration', 'Result.result', 'Result.start_time', 'Result.end_time', 'Exam.declare_result', 'Result.total_answered'),
            'joins' => array(array('table' => 'users', 'alias' => 'User', 'type' => 'inner',
                'conditions' => array('Result.user_id=User.id'))),
            'conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Result.user_id >' => 0)));
        $userSubject = $this->Result->userSubject($id);
        $userMarksheet = $this->Result->userMarksheet($id);
        $totalStudentCount = $this->Result->find('count', array('conditions' => array('Result.exam_id' => $examDetails['Exam']['id'], 'Result.user_id >' => 0)));
        $correctQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'R')));
        $incorrectQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'W')));
        $this->ExamStat->virtualFields = array('total_marks' => 'SUM(marks_obtained)');
        $rightMarksArr = $this->ExamStat->find('first', array('fields' => array('total_marks'), 'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'R')));
        $negativeMarksArr = $this->ExamStat->find('first', array('fields' => array('total_marks'), 'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'W')));
        $this->ExamStat->virtualFields = array();
        $leftQuestion = $examDetails['Result']['total_question'] - $examDetails['Result']['total_answered'];
        $this->ExamStat->virtualFields = array('left_marks' => 'SUM(ExamStat.marks)');
        $leftQuestionArr = $this->ExamStat->find('first', array('joins' => array(array('table' => 'questions', 'alias' => 'Question', 'type' => 'Inner', 'conditions' => array('ExamStat.question_id=Question.id'))),
            'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 0)));
        $this->ExamStat->virtualFields = array();
        $this->Result->query('SET @i=0;');
        $rankArr = $this->Result->query('SELECT `id`,`student_id`,`percent`, @i:=@i+1 AS rank FROM `exam_results` WHERE `exam_id`=' . $examDetails['Exam']['id'] . ' ORDER BY `percent` DESC');
        foreach ($rankArr as $rnk) {
            if ($rnk['exam_results']['id'] == $id) {
                $rank = $rnk[0]['rank'];
                break;
            }
        }
        $this->Result->query('SET @i=0;');
        $topRankArr = $this->Result->query('SELECT `id`,`student_id`,`percent`, @i:=@i+1 AS rank FROM `exam_results` WHERE `exam_id`=' . $examDetails['Exam']['id'] . ' AND `user_id` IS NOT NULL ORDER BY `percent` DESC');
        $userSectionQuestion = $this->Result->userSectionQuestion($examDetails['Result']['id'], $examDetails['Exam']['id'], $examDetails['Exam']['type'], $this->studentId);
        $rightMarks = $rightMarksArr['ExamStat']['total_marks'];
        if ($rightMarks == "")
            $rightMarks = 0;
        $negativeMarks = $negativeMarksArr['ExamStat']['total_marks'];
        if ($negativeMarks == "")
            $negativeMarks = 0;
        $leftQuestionMarks = $leftQuestionArr['ExamStat']['left_marks'];
        if ($leftQuestionMarks == "")
            $leftQuestionMarks = 0;
        $attemptedQuestion = $examDetails['Result']['total_answered'];
        if (strlen($this->userValue['Student']['photo']) > 0)
            $studentImage = 'student_thumb/' . $this->userValue['Student']['photo'];
        else
            $studentImage = 'User.png';
        $rank = $rank;
        $mainRank = $rank;
        $myRank = $this->showRank($rank);
        $percent = $examDetails['Result']['percent'];
        $percentile = round((($totalStudentCount - $rank) / $totalStudentCount) * 100, 2);

        $this->set('examDetails', $examDetails);
        $this->set('userMarksheet', $userMarksheet);
        $this->set('id', $id);
        $this->set('totalStudentCount', $totalStudentCount);
        $this->set('correctQuestion', $correctQuestion);
        $this->set('incorrectQuestion', $incorrectQuestion);
        $this->set('rightMarks', $rightMarks);
        $this->set('negativeMarks', $negativeMarks);
        $this->set('leftQuestion', $leftQuestion);
        $this->set('leftQuestionMarks', $leftQuestionMarks);
        $this->set('myRank', $myRank);
        $this->set('percentile', $percentile);
        $this->set('userSectionQuestion', $userSectionQuestion);
        $this->set('attemptedQuestion', $attemptedQuestion);
        $this->set('studentImage', $studentImage);
        $test_time = $this->CustomFunction->secondsToWords($examDetails['Exam']['duration'] * 60);
        $time_taken = $this->CustomFunction->secondsToWords(CakeTime::fromString($examDetails['Result']['end_time']) - CakeTime::fromString($examDetails['Result']['start_time']));
        $negativeMark = str_replace("-", "", $negativeMarks);
        if ($id && $studentId != '') {
            $scorecard = array('exam_name' => $examDetails['Exam']['name'], 'student_count' => $totalStudentCount, 'test_marks' => $examDetails['Result']['total_marks'], 'total_questions' => $examDetails['Result']['total_question'], 'test_time' => $test_time, 'my_marks' => $examDetails['Result']['obtained_marks'], 'my_percentile' => $percentile, 'total_question_attempts' => $examDetails['Result']['total_answered'], 'time_taken' => $time_taken, 'correct_questions' => $correctQuestion, 'incorrect_questions' => $incorrectQuestion, 'right_marks' => $rightMarks, 'negative_marks' => $negativeMark, 'unattempt_questions' => $leftQuestion, 'incorrect_questions_marks' => $leftQuestionMarks, 'my_rank' => $myRank, 'my_result' => $examDetails['Result']['result']);
            $status = 'true';
            $message = 'Query sent successfully';
        } else {
            $scorecard = array();
            $status = 'false';
            $message = 'Query sent failed';
        }
        $this->set(compact('status', 'message', 'scorecard'));
        $this->set('_serialize', array('status', 'message', 'scorecard'));

    }

    public function rest_comparereports()
    {
        $id = $this->request->query['result_id'];
        $studentId = $this->request->query['student_id'];

        if ($this->adminValue) {
            $studArr = $this->Result->findById($id);
            $this->studentId = $studArr['Result']['student_id'];
        }
        $this->studentId = $studentId;
        $declareResult = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Exam.declare_result' => 'Yes')));
        if ($declareResult == 0) {
            $this->Session->setFlash(__('Invalid Post'), 'flash', array('alert' => 'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $this->loadModel('ExamStat');
        $this->loadModel('ExamQuestion');
        $studentCount = $this->Result->find('count', array('conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId)));
        if ($id == null || $studentCount == 0) {
            $this->redirect(array('action' => 'index'));
        }
        $examDetails = $this->Result->find('first', array('fields' => array('Exam.id', 'Exam.name', 'Exam.type', 'User.name', 'Result.id', 'Result.percent', 'Result.obtained_marks', 'Result.total_marks', 'Result.total_question', 'Result.total_attempt', 'Exam.passing_percent', 'Exam.duration', 'Result.result', 'Result.start_time', 'Result.end_time', 'Exam.declare_result', 'Result.total_answered'),
            'joins' => array(array('table' => 'users', 'alias' => 'User', 'type' => 'inner',
                'conditions' => array('Result.user_id=User.id'))),
            'conditions' => array('Result.id' => $id, 'Result.student_id' => $this->studentId, 'Result.user_id >' => 0)));
        $userSubject = $this->Result->userSubject($id);
        $userMarksheet = $this->Result->userMarksheet($id);
        $totalStudentCount = $this->Result->find('count', array('conditions' => array('Result.exam_id' => $examDetails['Exam']['id'], 'Result.user_id >' => 0)));
        $correctQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'R')));
        $incorrectQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'W')));
        $this->ExamStat->virtualFields = array('total_marks' => 'SUM(marks_obtained)');
        $rightMarksArr = $this->ExamStat->find('first', array('fields' => array('total_marks'), 'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'R')));
        $negativeMarksArr = $this->ExamStat->find('first', array('fields' => array('total_marks'), 'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 1, 'ques_status' => 'W')));
        $this->ExamStat->virtualFields = array();
        $leftQuestion = $examDetails['Result']['total_question'] - $examDetails['Result']['total_answered'];
        $this->ExamStat->virtualFields = array('left_marks' => 'SUM(ExamStat.marks)');
        $leftQuestionArr = $this->ExamStat->find('first', array('joins' => array(array('table' => 'questions', 'alias' => 'Question', 'type' => 'Inner', 'conditions' => array('ExamStat.question_id=Question.id'))),
            'conditions' => array('ExamStat.exam_result_id' => $id, 'answered' => 0)));
        $this->ExamStat->virtualFields = array();
        $this->Result->query('SET @i=0;');
        $rankArr = $this->Result->query('SELECT `id`,`student_id`,`percent`, @i:=@i+1 AS rank FROM `exam_results` WHERE `exam_id`=' . $examDetails['Exam']['id'] . ' ORDER BY `percent` DESC');
        foreach ($rankArr as $rnk) {
            if ($rnk['exam_results']['id'] == $id) {
                $rank = $rnk[0]['rank'];
                break;
            }
        }
        $this->Result->query('SET @i=0;');
        $topRankArr = $this->Result->query('SELECT `id`,`student_id`,`percent`, @i:=@i+1 AS rank FROM `exam_results` WHERE `exam_id`=' . $examDetails['Exam']['id'] . ' AND `user_id` IS NOT NULL ORDER BY `percent` DESC');
        $userSectionQuestion = $this->Result->userSectionQuestion($examDetails['Result']['id'], $examDetails['Exam']['id'], $examDetails['Exam']['type'], $this->studentId);
        $rightMarks = $rightMarksArr['ExamStat']['total_marks'];
        if ($rightMarks == "")
            $rightMarks = 0;
        $negativeMarks = $negativeMarksArr['ExamStat']['total_marks'];
        if ($negativeMarks == "")
            $negativeMarks = 0;
        $leftQuestionMarks = $leftQuestionArr['ExamStat']['left_marks'];
        if ($leftQuestionMarks == "")
            $leftQuestionMarks = 0;
        $attemptedQuestion = $examDetails['Result']['total_answered'];
        if (strlen($this->userValue['Student']['photo']) > 0)
            $studentImage = 'student_thumb/' . $this->userValue['Student']['photo'];
        else
            $studentImage = 'User.png';
        $rank = $rank;
        $mainRank = $rank;
        $myRank = $this->showRank($rank);
        $percent = $examDetails['Result']['percent'];
        $percentile = round((($totalStudentCount - $rank) / $totalStudentCount) * 100, 2);

        $this->set('examDetails', $examDetails);
        $this->set('userMarksheet', $userMarksheet);
        $this->set('id', $id);
        $this->set('totalStudentCount', $totalStudentCount);
        $this->set('correctQuestion', $correctQuestion);
        $this->set('incorrectQuestion', $incorrectQuestion);
        $this->set('rightMarks', $rightMarks);
        $this->set('negativeMarks', $negativeMarks);
        $this->set('leftQuestion', $leftQuestion);
        $this->set('leftQuestionMarks', $leftQuestionMarks);
        $this->set('myRank', $myRank);
        $this->set('percentile', $percentile);
        $this->set('userSectionQuestion', $userSectionQuestion);
        $this->set('attemptedQuestion', $attemptedQuestion);
        $this->set('studentImage', $studentImage);

        $total_question = $examDetails['Result']['total_question'];
        // echo __('Maximum Marks');
        $total_marks = $examDetails['Result']['total_marks'];
        // echo __('Attempted Ques.');
        $attempted_question = $attemptedQuestion;
        // echo __('Unattempted Ques.');
        $left_question = $leftQuestion;
        //echo __('Correct Ques.');
        $correct_question = $correctQuestion;
        // echo __('Incorrect Ques.');
        $incorrect_question = $incorrectQuestion;
        // echo __('Total Score');
        $total_score = $examDetails['Result']['obtained_marks'] / $examDetails['Result']['total_marks'];
        //   echo __('Percentage');
        $percentage1 = CakeNumber::toPercentage($examDetails['Result']['percent']);
        //  echo __('Percentile');
        $percentile = CakeNumber::toPercentage($percentile);
        //  echo __('Total Time');


        $total_time = $this->CustomFunction->secondsToWords(CakeTime::fromString($examDetails['Result']['end_time']) - CakeTime::fromString($examDetails['Result']['start_time']));
        // echo __('Rank');
        $photo = $this->siteDomain . '/img/' . $studentImage;
        $rank = $myRank;

        if ($id && $studentId != '') {
            $scorecard[] = array('total_ques' => $total_question, 'maximum_marks' => $total_marks, 'attempted_ques' => $attempted_question, 'unattempted_ques' => $left_question, 'correct_ques' => $correct_question, 'incorrect_ques' => $incorrect_question, 'total_score' => $total_score, 'percentage' => $percentage1, 'percentile' => $percentile, 'total_time' => $total_time, 'rank' => $rank, 'photo' => $photo, 'name' => $name);
        } else {
            $scorecard = array();
        }

        $xAxisCategories = array();
        $compareArr = array();
        $isYou = false;
        foreach ($topRankArr as $k => $postArr) {
            $studentId = $postArr['exam_results']['student_id'];
            $myRank = $postArr[0]['rank'];
            $resultId = $postArr['exam_results']['id'];
            $examDetails = $this->Result->find('first', array('fields' => array('Student.name', 'Student.photo', 'Result.exam_id', 'Result.percent', 'Result.obtained_marks', 'Result.total_marks', 'Result.total_question', 'Result.total_attempt', 'Result.result', 'Result.start_time', 'Result.end_time', 'Result.total_answered'),
                'joins' => array(array('table' => 'students', 'alias' => 'Student', 'type' => 'inner', 'conditions' => array('Result.student_id=Student.id'))),
                'conditions' => array('Result.id' => $resultId, 'Result.student_id' => $studentId, 'Result.user_id >' => 0)));
            $correctQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $resultId, 'answered' => 1, 'ques_status' => 'R')));
            $incorrectQuestion = $this->ExamStat->find('count', array('conditions' => array('ExamStat.exam_result_id' => $resultId, 'answered' => 1, 'ques_status' => 'W')));
            $leftQuestion = $examDetails['Result']['total_question'] - $examDetails['Result']['total_answered'];
            $attemptedQuestion = $examDetails['Result']['total_answered'];
            if (strlen($examDetails['Student']['photo']) > 0)
                $studentImage = 'student_thumb/' . $examDetails['Student']['photo'];
            else
                $studentImage = 'User.png';
            $rank = $this->showRank($myRank);
            $totalStudentCount = $this->Result->find('count', array('conditions' => array('Result.exam_id' => $examDetails['Result']['exam_id'], 'Result.user_id >' => 0)));
            $percentile = round((($totalStudentCount - $rank) / $totalStudentCount) * 100, 2);
            if ($id != $resultId)
                $compareArr[] = array($examDetails, 'correct_question' => $correctQuestion, 'incorrect_question' => $incorrectQuestion, 'left_question' => $leftQuestion, 'attempted_question' => $attemptedQuestion, 'student_image' => $studentImage, 'rank' => $rank, 'percentile' => $percentile);
            $topperData[] = (float)$examDetails['Result']['percent'];
            if ($id == $resultId) {
                $isYou = true;
                $xAxisCategories[] = array(__d('default', "You %s", $myRank));
            } else
                $xAxisCategories[] = array(__d('default', "Topper %s", $myRank));
            if ($k == 9)
                break;
        }
        if ($isYou == false) {
            $xAxisCategories[] = array(__d('default', "You %s", $mainRank));
            $topperData[] = (float)$percent;
        }

        foreach ($compareArr as $key => $compPost) {
            // Total Ques
            $total_questionn = $compPost[0]['Result']['total_question'];
            // echo __('Maximum Marks');
            $total_marksn = $compPost[0]['Result']['total_marks'];
            // echo __('Attempted Ques.');
            $attempted_questionn = $compPost['attempted_question'];
            // echo __('Unattempted Ques.');
            $left_questionn = $compPost['left_question'];
            //echo __('Correct Ques.');
            $correct_questionn = $compPost['correct_question'];
            // echo __('Incorrect Ques.');
            $incorrect_questionn = $compPost['incorrect_question'];


            // echo __('Total Score');
            $total_scoren = $compPost[0]['Result']['obtained_marks'] / $compPost[0]['Result']['total_marks'];
            //echo __('Percentage');
            $Percentilenn = CakeNumber::toPercentage($compPost[0]['Result']['percent']);
            //  echo __('Percentile');
            $percentilen = CakeNumber::toPercentage($compPost['percentile']);
            //   echo __('Total Time');


            $total_timen = $this->CustomFunction->secondsToWords(CakeTime::fromString($compPost[0]['Result']['end_time']) - CakeTime::fromString($compPost[0]['Result']['start_time']));
            // echo __('Rank');


            $photon = $this->siteDomain . '/img/' . $compPost['student_image'];
            $rankn = $compPost['rank'];
            $namen = $compPost[0]['Student']['name'];


            $scorecardnew[] = array('total_ques' => $total_questionn, 'maximum_marks' => $total_marksn, 'attempted_ques' => $attempted_questionn, 'unattempted_ques' => $attempted_questionn, 'correct_ques' => $correct_questionn, 'incorrect_ques' => $incorrect_questionn, 'total_score' => $total_scoren, 'percentage' => $Percentilenn, 'percentile' => $percentilen, 'total_time' => $total_timen, 'rank' => $rankn, 'photo' => $photon, 'name' => $namen);
        }

        $comparereports = $scorecard + $scorecardnew;


        $this->set('compareArr', $compareArr);
        $this->set('compareCount', count($compareArr) - 1);
        $this->set(compact('status', 'message', 'comparereports'));
        $this->set('_serialize', array('status', 'message', 'comparereports'));

    }

    public function rest_subjectreport()
    {
        $id = $this->request->query['result_id'];
        $studentId = $this->request->query['student_id'];
        $userMarksheet = $this->Result->userMarksheet($id);

        $examDetails = $this->Result->find('first', array('fields' => array('Exam.id', 'Exam.name', 'Exam.type', 'User.name', 'Result.id', 'Result.percent', 'Result.obtained_marks', 'Result.total_marks', 'Result.total_question', 'Result.total_attempt', 'Exam.passing_percent', 'Exam.duration', 'Result.result', 'Result.start_time', 'Result.end_time', 'Exam.declare_result', 'Result.total_answered'),
            'joins' => array(array('table' => 'users', 'alias' => 'User', 'type' => 'inner',
                'conditions' => array('Result.user_id=User.id'))),
            'conditions' => array('Result.id' => $id, 'Result.student_id' => $studentId, 'Result.user_id >' => 0)));


        $studArr = $this->Result->findById($id);
        if (!empty($studArr) && !empty($id)) {
            foreach ($userMarksheet as $key => $subjects_rep) {
                $name = $subjects_rep['Subject']['name'];
                $obtained_marks = $subjects_rep['Subject']['obtained_marks'];
                $marks_scored = $subjects_rep['Subject']['marks_scored'];
                $negative_marks = $subjects_rep['Subject']['negative_marks'];
                $percent = $subjects_rep['Subject']['percent'];
                $total_question = $subjects_rep['Subject']['total_question'];
                $marks_weightage = $subjects_rep['Subject']['marks_weightage'];
                $time_taken = $subjects_rep['Subject']['time_taken'];
                $correct_question = $subjects_rep['Subject']['correct_question'];
                $incorrect_question = $subjects_rep['Subject']['incorrect_question'];
                $unattempted_question = $subjects_rep['Subject']['unattempted_question'];
                $unattempted_question_marks = $subjects_rep['Subject']['unattempted_question_marks'];

                if ($subjects_rep['Subject']['name'] == 'Grand Total') {
                    $subject_report['Grand_total'] = array('exam_name' => $examDetails['Exam']['name'], 'total_questions' => $total_question, 'correct_incorrect_count' => $correct_question . '/' . $incorrect_question, 'positive_negative_marks' => $marks_scored . '/' . $negative_marks, 'unattempt_question_count_marks' => $unattempted_question . '/' . $unattempted_question_marks);
                } else {
                    $subject_report['Subject_stats'][] = array('subject_name' => $name, 'total_questions' => $total_question, 'correct_incorrect_count' => $correct_question . '/' . $incorrect_question, 'positive_negative_marks' => $marks_scored . '/' . $negative_marks, 'unattempt_question_count_marks' => $unattempted_question . '/' . $unattempted_question_marks);
                }
            }
            $status = 'true';
            $message = 'Query sent successfully';
        } else {
            $status = 'false';
            $message = 'Invalid result id';
            $subject_report = array();
        }

        $this->set(compact('status', 'message', 'subject_report'));
        $this->set('_serialize', array('status', 'message', 'subject_report'));
        unset($subject_report);
    }
}
