<?php

class LeaderboardsController extends AppController
{
    public $components = array('RequestHandler');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function crm_index()
    {
          $this->authenticate();
        //////////////////// CUSTOM QUERY START ///////////////////////
        $scoreboard = $this->Leaderboard->query("SELECT `points`,`student_id`,`exam_given`,`name`,`rank`,`photo` FROM (SELECT ROUND(SUM(`percent`)/((SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id` AND `finalized_time` IS NOT NULL)),2) AS `points` ,`student_id`,(SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id` AND `finalized_time` IS NOT NULL) AS `exam_given`, `Student`.`name`,`Student`.`photo`,FIND_IN_SET((SELECT ROUND(SUM(`percent`)/((SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id` AND `finalized_time` IS NOT NULL)),2)),(SELECT GROUP_CONCAT(cast(`total` as char)) FROM (SELECT DISTINCT(ROUND(SUM(`percent`)/(SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id` AND `finalized_time` IS NOT NULL),2)) `total` FROM `exam_results` AS `ExamResult` GROUP BY `student_id` ORDER BY 1 DESC) as avg_percent)) AS `rank` FROM `exam_results` AS `ExamResult` INNER JOIN `students` AS `Student` ON `ExamResult`.`student_id` = `Student`.`id` WHERE `finalized_time` IS NOT NULL GROUP BY `student_id`) `Selection` ORDER BY `points` DESC LIMIT 10");
        $this->set('scoreboard', $scoreboard);


    }

    public function rest_index()
    {

        $scoreboard = $this->Leaderboard->query("SELECT `points`,`student_id`,`exam_given`,`name`,`rank`,`photo` FROM (SELECT ROUND(SUM(`percent`)/((SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id` AND `finalized_time` IS NOT NULL)),2) AS `points` ,`student_id`,(SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id` AND `finalized_time` IS NOT NULL) AS `exam_given`, `Student`.`name`,`Student`.`photo`,FIND_IN_SET((SELECT ROUND(SUM(`percent`)/((SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id` AND `finalized_time` IS NOT NULL)),2)),(SELECT GROUP_CONCAT(cast(`total` as char)) FROM (SELECT DISTINCT(ROUND(SUM(`percent`)/(SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id` AND `finalized_time` IS NOT NULL),2)) `total` FROM `exam_results` AS `ExamResult` GROUP BY `student_id` ORDER BY 1 DESC) as avg_percent)) AS `rank` FROM `exam_results` AS `ExamResult` INNER JOIN `students` AS `Student` ON `ExamResult`.`student_id` = `Student`.`id` WHERE `finalized_time` IS NOT NULL GROUP BY `student_id`) `Selection` ORDER BY `points` DESC LIMIT 10");
        foreach ($scoreboard as $value) {
            $student_id = $value['Selection']['student_id'];
            $student_name = $value['Selection']['name'];
            if ($value['Selection']['photo'] == "") {
                $student_photo = $this->siteDomain . '/img/User.png';
            } else {
                $student_photo .= $this->siteDomain . '/img/student_thumb/' . $value['Selection']['photo'];
            }
            $result_percent = $value['Selection']['points'];
            $leaderboard[] = array('student_id' => $student_id, 'student_name' => $student_name, 'student_photo' => $student_photo, 'exam_id' => '', 'exam_name' => '', 'result_percent' => $result_percent, 'package_id' => '', 'package_amount' => '');
            unset($student_photo);
        }
        $status = true;
        $message = __('Leader Board data fetch successfully.');
        $this->set(compact('status', 'message', 'leaderboard'));
        $this->set('_serialize', array('status', 'message', 'leaderboard'));
        unset($leaderboard);

    }

}