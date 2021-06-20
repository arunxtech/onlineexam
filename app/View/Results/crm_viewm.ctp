<style type="text/css">
    tr.mytr {
        float: left;
        width: 25%;
        border-top: 1px solid;
    }

    @media only screen and (max-width: 900px) {
        tr.mytr {
            float: none;
            width: 50%;
            border-top: 1px solid;
        }
    }

    @media only screen and (max-width: 600px) {
        tr.mytr {
            float: none;
            width: 100%;
            border-top: 1px solid;
        }
    }

    td {
        border: none !important;
    }

    @media screen and (max-width: 600px) {
        .row.my-result > div > ul > li {
            width: 140px;
        }

        .right {
            float: right;
        }

        .center {
            text-align: left;
        }

        table#cart tbody td .form-control {
            width: 20%;
            display: inline !important;
        }

        .actions .btn {
            width: 36%;
            margin: 1.5em 0;
        }

        .actions .btn-info {
            float: left;
        }

        .actions .btn-danger {
            float: right;
        }

        table#cart thead {
            display: none;
        }

        table#cart tbody td {
            display: block;
            padding: .6rem;
            min-width: 320px;
        }

        /* table#cart tbody tr td:first-child { background: #333; color: #fff; }*/
        table#cart tbody td:before {
            content: attr(data-th);
            font-weight: bold;
            /*display: inline-block; */
            /* width: 8rem;*/
        }

        table#cart tfoot td {
            display: block;
        }

        table#cart tfoot td .btn {
            display: block;
        }
    }

    .page-header-topbar {
        display: none;
    }

    .page-content {
        margin: 0;
    }

    .sidebar-main.sidebar {
        display: none;
    }

    div#footer {
        display: none;
    }

    .row.my-result {
        padding-top: 0px !important;
        margin: 0;
    }

    .content {
        padding: 0px !important;
    }

    .exam-panel {
        overflow-y: hidden !important;
    }

    button.btn {
        margin-bottom: 10px;
    }

    table#cart tbody td {
        min-width: 0px !important;
    }

    .optionSerial {
        float: left;
        margin-top: 2px;
        max-width: 88%
    }

    i.material-icons.clear {
        color: red;
        font-size: 17px;
    }

    i.material-icons.check {
        color: #26ce26;
        font-size: 17px;
    }

    .tab-content {
        color: #191919;
    }

    p {
        overflow: hidden;
        margin-bottom: 5px;
    }

    .subjectNamecls {
        color: #fff;
    }

    .subjecthed {
        text-decoration: none;
    }

    button.btn.btn-default.btn-sm.btn-block {
        font-size: 18px;
    }
</style>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php //echo$this->html->link('<span class="fa fa-arrow-left"></span>&nbsp;'.__('Back'),array('action'=>'index'),array('class'=>'btn btn-info','escape'=>false));
$bookmarkUrl = $this->Html->Url(array('controller' => 'Results', 'action' => 'bookmark', $id)); ?>
<script type="text/javascript">
    function navigation(quesNo) {
        $('.exam-panel').hide();
        $('#quespanel' + quesNo).show();
    }

    function callPrev(quesNo) {
        if (quesNo != 1) quesNo--;
        $('.exam-panel').hide();
        $('#quespanel' + quesNo).show();
        $("html, body").animate({scrollTop: 0}, 600);
    }

    function callNext(quesNo) {
        if ($('#totalQuestion').text() != quesNo) quesNo++;
        $('.exam-panel').hide();
        $('#quespanel' + quesNo).show();
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    }

    function callComparePrev(rank) {
        rank--;
        $('.compare').hide();
        $('#comppanel' + rank).show(20, 'linear');
    }

    function callCompareNext(rank) {
        rank++;
        $('.compare').hide();
        $('#comppanel' + rank).show(20, 'linear');
    }

    function callBoomark(quesNo) {
        $.ajax({
            method: "POST", url: '<?php echo $bookmarkUrl;?>', data: '&id=' + quesNo, beforeSend: function () {
                $('#exam-loading').show();
            }
        }).done(function (data) {
            if (data == 'Y') {
                $('#navbtn' + quesNo).addClass('btn-success');
                $('#bookmark' + quesNo).addClass('btn-danger');
                $('#bookmark' + quesNo).html('<span class="fa fa-star-o"></span> Unbookmark');
            }
            else {
                $('#navbtn' + quesNo).removeClass('btn-success');
                $('#bookmark' + quesNo).removeClass('btn-danger');
                $('#bookmark' + quesNo).html('<span class="fa fa-star"></span> Bookmark');
            }
            $('#exam-loading').hide();
        });
    }

    $(document).ready(function () {
        $('.exam-panel').hide();
        $('#quespanel1').show();
        $('.compare').hide();
        $('#comppanel0').show();
    });

</script>
<style type="text/css">
    .col-md-12 {
        padding: 5px;
    }

    /* bootstrap hack: fix content width inside hidden tabs */
    .tab-content > .tab-pane, .pill-content > .pill-pane {
        display: block; /* undo display:none          */
        height: 0; /* height:0 is also invisible */
        overflow-y: hidden; /* no-overflow                */
    }

    .tab-content > .active, .pill-content > .active {
        height: auto; /* let the content decide it  */
    }

    /* bootstrap hack end */
</style>
<div style="display: none;"><label id="totalQuestion"><?php echo $examDetails['Result']['total_question']; ?></label>
</div>

<div class="row my-result">
    <div class="col-md-12" style="padding: 0;">

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane " id="score-card">
                <div class="rtest_heading">
                    <strong><?php echo __('Score Card For'); ?>  </strong><?php echo h($examDetails['Exam']['name']); ?>
                </div>
                <div class="">
                    <table class="table">
                        <tr class="mytr">
                            <td><?php echo __('Total No. of Student'); ?></td>
                            <td><strong class="text-primary"><?php echo $totalStudentCount; ?></strong></td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('My Marks'); ?></td>
                            <td>
                                <strong class="text-primary"><?php echo $examDetails['Result']['obtained_marks']; ?></strong>
                            </td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Correct Question'); ?></td>
                            <td><strong class="text-primary"><?php echo $correctQuestion; ?></strong></td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Incorrect Question'); ?></td>
                            <td><strong class="text-danger"><?php echo $incorrectQuestion; ?></strong></td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Total Marks of Test'); ?></td>
                            <td>
                                <strong class="text-primary"><?php echo $examDetails['Result']['total_marks']; ?></strong>
                            </td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('My Percentile'); ?></td>
                            <td>
                                <strong class="text-primary"><?php echo CakeNumber::toPercentage($percentile, 2); ?></strong>
                            </td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Right Marks'); ?></td>
                            <td><strong class="text-primary"><?php echo $rightMarks; ?></strong></td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Negative Marks'); ?></td>
                            <td><strong class="text-danger"><?php echo str_replace("-", "", $negativeMarks); ?></strong>
                            </td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Total Question in Test'); ?></td>
                            <td>
                                <strong class="text-primary"><?php echo $examDetails['Result']['total_question']; ?></strong>
                            </td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Total Answered Question in Test'); ?></td>
                            <td>
                                <strong class="text-primary"><?php echo $examDetails['Result']['total_answered']; ?></strong>
                            </td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Left Question'); ?></td>
                            <td><strong class="text-danger"><?php echo $leftQuestion; ?></strong></td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Left Question Marks'); ?></td>
                            <td><strong class="text-danger"><?php echo $leftQuestionMarks; ?></strong></td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Total Time of Test'); ?></td>
                            <td>
                                <strong class="text-primary"><?php echo $this->Function->secondsToWords($examDetails['Exam']['duration'] * 60); ?></strong>
                            </td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('My Time'); ?></td>
                            <td>
                                <strong class="text-primary"><?php echo $this->Function->secondsToWords($this->Time->fromString($examDetails['Result']['end_time']) - $this->Time->fromString($examDetails['Result']['start_time'])); ?></strong>
                            </td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('My Rank'); ?></td>
                            <td><strong class="text-primary"><?php echo $myRank; ?></strong></td>
                        </tr>
                        <tr class="mytr">
                            <td><?php echo __('Result'); ?></td>
                            <td>
                                <span class="label label-<?php if ($examDetails['Result']['result'] == "Pass") echo "success"; else echo "danger"; ?>"><?php if ($examDetails['Result']['result'] == "Pass") {
                                        echo __('PASSED');
                                    } else {
                                        echo __('FAILED');
                                    } ?></span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-6">
                    <div class="rtest_heading">
                        <strong><?php echo __('Performance Report For'); ?>  </strong><?php echo h($examDetails['Exam']['name']); ?>
                    </div>
                    <div class="chart">
                        <div id="mywrapperd2"></div>
                        <?php echo $this->HighCharts->render("My Chartd2"); ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="rtest_heading">
                        <strong><?php echo __('Question & Marks Wise Report For'); ?>  </strong><?php echo h($examDetails['Exam']['name']); ?>
                    </div>
                    <div class="chart">
                        <div id="mywrapperd3"></div>
                        <?php echo $this->HighCharts->render("My Chartd3"); ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="subject-report">
                <div class="rtest_heading">
                    <strong><?php echo __('Subject Report For'); ?>  </strong><?php echo h($examDetails['Exam']['name']); ?>
                </div>
                <div class="">
                    <table id="cart" class="table table-striped table-condensed">
                        <thead>
                        <tr>
                            <th><?php echo __('Name'); ?></th>
                            <th><?php echo __('Total Questions'); ?></th>
                            <th><?php echo __('Correct'); ?>/<br><?php echo __('Incorrect Question'); ?></th>
                            <th><?php echo __('Marks Scored') ?>/<br><?php echo __('Negative Marks'); ?></th>
                            <th><?php echo __('Unattempted Questions'); ?>/<br><?php echo __('Marks'); ?></th>
                        </tr>
                        </thead>
                        <?php foreach ($userMarksheet as $userValue): ?>
                            <tr>
                                <td data-th="Name: " class="text-primary">
                                    <strong><?php echo h($userValue['Subject']['name']); ?></strong></td>
                                <td data-th="Total Questions: "><?php echo $userValue['Subject']['total_question']; ?></td>
                                <td data-th="Correct/Incorrect Question: "><span
                                            class="text-success"><?php echo $userValue['Subject']['correct_question']; ?></span>/<span
                                            class="text-danger"><?php echo $userValue['Subject']['incorrect_question']; ?></span>
                                </td>
                                <td data-th="Marks Scored/Negative Marks: "><span
                                            class="text-success"><?php echo $userValue['Subject']['marks_scored']; ?></span>/<span
                                            class="text-danger"><?php echo $userValue['Subject']['negative_marks']; ?></span>
                                </td>
                                <td data-th="Unattempted Questions/Marks: "><span
                                            class="text-warning"><?php echo $userValue['Subject']['unattempted_question']; ?></span>/<span
                                            class="text-danger"><?php echo $userValue['Subject']['unattempted_question_marks']; ?></span>
                                </td>
                            </tr>
                        <?php endforeach;
                        unset($userValue); ?>
                    </table>
                </div>
                <div class="rtest_heading">
                    <strong><?php echo __('Graphical Report For'); ?>  </strong><?php echo h($examDetails['Exam']['name']); ?>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="chart">
                        <div id="mywrapperdl"></div>
                        <?php echo $this->HighCharts->render("My Chartdl"); ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="time-management">
                <div class="rtest_heading">
                    <strong><?php echo __('Time Management For'); ?>  </strong><?php echo h($examDetails['Exam']['name']); ?>
                </div>
                <div class="">
                    <table class="table table-striped ">
                        <tr>
                            <th><?php echo __('Name'); ?></th>
                            <th><?php echo __('Total Questions'); ?></th>
                            <th><?php echo __('Correct'); ?>/<br><?php echo __('Incorrect Question'); ?></th>
                            <th><?php echo __('Marks Scored'); ?>/<br><?php echo __('Negative Marks'); ?></th>
                            <th><?php echo __('Percentage'); ?></th>
                            <th><?php echo __('Unattempted Questions'); ?>/<br><?php echo __('Marks'); ?></th>
                            <th><?php echo __('Total Time'); ?></th>
                        </tr>
                        <?php foreach ($userMarksheet as $userValue): ?>
                            <tr>
                                <td class="text-primary">
                                    <strong><?php echo h($userValue['Subject']['name']); ?></strong></td>
                                <td><?php echo $userValue['Subject']['total_question']; ?></td>
                                <td>
                                    <span class="text-success"><?php echo $userValue['Subject']['correct_question']; ?></span>/<span
                                            class="text-danger"><?php echo $userValue['Subject']['incorrect_question']; ?></span>
                                </td>
                                <td>
                                    <span class="text-success"><?php echo $userValue['Subject']['marks_scored']; ?></span>/<span
                                            class="text-danger"><?php echo $userValue['Subject']['negative_marks']; ?></span>
                                </td>
                                <td><?php echo CakeNumber::toPercentage($userValue['Subject']['percent'], 2); ?></td>
                                <td>
                                    <span class="text-warning"><?php echo $userValue['Subject']['unattempted_question']; ?></span>/<span
                                            class="text-danger"><?php echo $userValue['Subject']['unattempted_question_marks']; ?></span>
                                </td>
                                <td><?php echo $this->Function->secondsToWords($userValue['Subject']['time_taken'], '-'); ?></td>
                            </tr>
                        <?php endforeach;
                        unset($userValue); ?>
                    </table>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="chart">
                        <div id="piewrapperqc"></div>
                        <?php echo $this->HighCharts->render("Pie Chartqc"); ?>
                    </div>
                </div>
            </div>
            <?php if ($examDetails['Exam']['declare_result'] == "Yes"){ ?>
            <div class="tab-pane" id="question">
                <!-- <div class="rtest_heading"><strong><?php echo __('Question Report For'); ?>  </strong><?php echo h($examDetails['Exam']['name']); ?></div> -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><?php echo __('Q.No.'); ?></th>
                            <th><?php echo __('Question'); ?></th>
                            <th><?php echo __('Your Answer'); ?></th>
                            <th><?php echo __('Correct Answer'); ?></th>
                            <th><?php echo __('Max. Marks'); ?></th>
                            <th><?php echo __('Your Score'); ?></th>
                            <th><?php echo __('Your Time'); ?></th>
                            <th><?php echo __('Level'); ?></th>
                        </tr>
                        <?php foreach ($post as $k => $ques):$quesNo = $ques['ExamStat']['ques_no'];
                            if ($ques['Qtype']['type'] == "M") {
                                $correctAnswer = "";
                                $userAnswer = "";
                                if (strlen($ques['Question']['answer']) > 1) {
                                    $correctAnswerExp = explode(",", $ques['Question']['answer']);
                                    foreach ($correctAnswerExp as $option):
                                        $correctAnswer1 = "option" . $option;
                                        $correctAnswer .= $ques['Question'][$correctAnswer1] . "<br>";
                                    endforeach;
                                    unset($option);
                                    if (strlen($ques['ExamStat']['option_selected']) > 1) {
                                        $userAnswerExp = explode(",", $ques['ExamStat']['option_selected']);
                                        foreach ($userAnswerExp as $option):
                                            $userAnswer1 = "option" . $option;
                                            $userAnswer .= $ques['Question'][$userAnswer1] . "<br>";
                                        endforeach;
                                        unset($option);
                                    } else {
                                        if ($ques['ExamStat']['option_selected']) {
                                            $userAnswer = "option" . $ques['ExamStat']['option_selected'];
                                            $userAnswer = $ques['Question'][$userAnswer];
                                        }
                                    }
                                } else {
                                    if ($ques['ExamStat']['option_selected']) {
                                        $userAnswer = "option" . $ques['ExamStat']['option_selected'];
                                        $userAnswer = $ques['Question'][$userAnswer];
                                    }
                                    $correctAnswer = "option" . $ques['Question']['answer'];
                                    $correctAnswer = $ques['Question'][$correctAnswer];
                                }
                            }
                            if ($ques['Qtype']['type'] == "T") {
                                $userAnswer = $ques['ExamStat']['true_false'];
                                $correctAnswer = $ques['Question']['true_false'];
                            }
                            if ($ques['Qtype']['type'] == "F") {
                                $userAnswer = $ques['ExamStat']['fill_blank'];
                                $correctAnswer = $ques['Question']['fill_blank'];
                            }
                            if ($ques['Qtype']['type'] == "S") {
                                $userAnswer = $ques['ExamStat']['answer'];
                                $correctAnswer = "";
                            }
                            if ($ques['ExamStat']['ques_status'] == "R")
                                $quesStatus = "text-success";
                            elseif ($ques['ExamStat']['ques_status'] == "W")
                                $quesStatus = "text-danger";
                            else
                                $quesStatus = "text-info";
                            ?>
                            <tr class="<?php echo $quesStatus; ?>">
                                <td><strong><?php echo $ques['ExamStat']['ques_no']; ?></strong></td>
                                <td><?php echo str_replace("<script", "", $ques['Question']['question']); ?></td>
                                <td><?php echo __($userAnswer); ?></td>
                                <td><?php echo __($correctAnswer); ?></td>
                                <td><?php echo $ques['ExamStat']['marks']; ?></td>
                                <td><?php echo $ques['ExamStat']['marks_obtained']; ?></td>
                                <td><?php echo $this->Function->secondsToWords($ques['ExamStat']['time_taken'], '-'); ?></td>
                                <td><?php echo __($ques['Diff']['diff_level']); ?></td>
                            </tr>
                        <?php endforeach;
                        unset($ques); ?>
                    </table>
                </div>
            </div>
            <div class="tab-pane active" id="solution">

                <div class="col-sm-9">
                    <?php foreach ($post

                    as $k => $ques):
                    $quesNo = $ques['ExamStat']['ques_no']; ?>
                    <div class="exam-panel" style="margin-top: 10px;box-shadow: 0px 2px 5px #888888;"
                         id="quespanel<?php echo $quesNo; ?>">
                        <div class="panel-group" style=";" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background: #08BBE2;color: #fff;">
                                    <h4 class="panel-title"><a data-toggle="collapse"
                                                               data-parent="#accordion"><strong><?php echo __('Question Report For'); ?>  </strong><?php echo h($examDetails['Exam']['name']); ?>
                                        </a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <table id="cart" class="table table-condensed">
                                <?php
                                if ($ques['Qtype']['type'] == "M") {
                                    $options = array();
                                    $optionKeyArr = explode(",", $ques['ExamStat']['options']);
                                    $index = 0;
                                    foreach ($optionKeyArr as $value) {
                                        $optKey = "option" . $value;
                                        if (strlen($ques['Question'][$optKey]) > 0) {
                                            $index++;
                                            $options[$value] = str_replace("<script", "", $ques['Question'][$optKey]);
                                        }
                                    }
                                    unset($value, $key);
                                    $correctAnswer = "";
                                    $userAnswer = "";
                                    if (strlen($ques['Question']['answer']) > 1) {
                                        $correctAnswerExp = explode(",", $ques['Question']['answer']);
                                        foreach ($correctAnswerExp as $option):
                                            $correctAnswer[] = "Option" . (array_search($option, array_keys($options)) + 1);
                                        endforeach;
                                        unset($option);
                                        $correctAnswer = implode(",", $correctAnswer);

                                        $userAnswerExp = explode(",", $ques['ExamStat']['option_selected']);
                                        foreach ($userAnswerExp as $option):
                                            $userAnswer[] = "Option" . (array_search($option, array_keys($options)) + 1);
                                        endforeach;
                                        unset($option);
                                        $userAnswer = implode(",", $userAnswer);
                                    } else {
                                        if ($ques['ExamStat']['option_selected']) {
                                            $userAnswer = "Option" . (array_search($ques['ExamStat']['option_selected'], array_keys($options)) + 1);
                                        }
                                        $correctAnswer = "Option" . (array_search($ques['Question']['answer'], array_keys($options)) + 1);
                                    }
                                }
                                if ($ques['Qtype']['type'] == "T") {
                                    $userAnswer = $ques['ExamStat']['true_false'];
                                    $correctAnswer = $ques['Question']['true_false'];
                                }
                                if ($ques['Qtype']['type'] == "F") {
                                    $userAnswer = $ques['ExamStat']['fill_blank'];
                                    $correctAnswer = $ques['Question']['fill_blank'];
                                }
                                if ($ques['Qtype']['type'] == "S") {
                                    $userAnswer = $ques['ExamStat']['answer'];
                                    $correctAnswer = "";
                                }
                                if ($ques['ExamStat']['ques_status'] == "R")
                                    $quesStatus = "text-success";
                                elseif ($ques['ExamStat']['ques_status'] == "W")
                                    $quesStatus = "text-danger";
                                else
                                    $quesStatus = "text-info";

                                ?>
                                <tr class="<?php echo $quesStatus; ?>">
                                <tr>
                                    <td colspan="3"><?php echo '<strong>' . __('Question') . ': ' . $quesNo . '</strong><br>&nbsp;&nbsp;' . str_replace("<script", "", $ques['Question']['question']); ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <?php
                                        if ($ques['Qtype']['type'] == "M") {
                                            $correctImg = "";
                                            $incorrectImg = "";
                                            $optionSerial = 0;
                                            foreach ($options as $opt => $option):$optionSerial++;
                                                if (strlen($ques['Question']['answer']) > 1) {
                                                    $correctImg = "";
                                                    $incorrectImg = "";
                                                    foreach (explode(",", $ques['ExamStat']['option_selected']) as $value) {
                                                        if ($opt == $value && $ques['ExamStat']['ques_status'] == 'W') {
                                                            $incorrectImg = '<i class="material-icons clear">clear</i>';
                                                            break;
                                                        }
                                                    }
                                                    unset($value);
                                                    foreach (explode(",", $ques['ExamStat']['correct_answer']) as $value) {
                                                        if ($opt == $value) {
                                                            $incorrectImg = '<i class="material-icons clear">clear</i>';
                                                            break;
                                                        }
                                                    }
                                                    unset($value);
                                                } else {
                                                    if ($opt == $ques['ExamStat']['correct_answer']) {
                                                        $correctImg = '<i class="material-icons check">check</i>';
                                                    } else {
                                                        $correctImg = "";
                                                    }
                                                    if ($opt == $ques['ExamStat']['option_selected'] && $ques['ExamStat']['ques_status'] == 'W') {
                                                        $incorrectImg = '<i class="material-icons clear">clear</i>';
                                                    } else {
                                                        $incorrectImg = "";
                                                    }
                                                }
                                                echo '<p><span class="optionSerial">' . $optionSerial . '.' . $incorrectImg . $correctImg . $option . '</span></p>';
                                            endforeach;
                                            unset($option);
                                        }
                                        if ($ques['Qtype']['type'] == "T") {
                                            $correctImgTrue = "";
                                            $correctImgFalse = "";
                                            $incorrectImgTrue = "";
                                            $incorrectImgFalse = "";
                                            if ($ques['Question']['true_false'] == "True") {
                                                $correctImgTrue = '<i class="material-icons check">check</i>';
                                            } else {
                                                $correctImgFalse = '<i class="material-icons check">check</i>';
                                            }
                                            if ($ques['ExamStat']['ques_status'] == 'W' && $ques['ExamStat']['true_false'] == "True") {
                                                $incorrectImgTrue = '<i class="material-icons clear">clear</i>';
                                            }
                                            if ($ques['ExamStat']['ques_status'] == 'W' && $ques['ExamStat']['true_false'] == "False") {
                                                $incorrectImgTrue = '<i class="material-icons clear">clear</i>';
                                                $incorrectImgFalse = '<i class="material-icons ">clear</i>';
                                            }
                                            echo $correctImgTrue . $incorrectImgTrue . __('True') . ' / ' . $correctImgFalse . $incorrectImgFalse . __('False');
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="margin: 0;padding-top: 0;    padding-bottom: 0;line-height: 0;">
                                        <hr style="margin: 0 0 8px;border-top: 1px solid #e0e0e0;">
                                        <?php if ($ques['ExamStat']['ques_status'] == NULL && !$ques['ExamStat']['answer']) echo '<div style="border: 1px solid;padding: 15px 15px;width: 100%;"><strong class="">' . __('Not Attempted') . '</strong></div>'; else echo '<div style="border: 1px solid;padding: 15px 15px;width: 100%;"><span class="">' . __('Attempt') . '</span></div>'; ?></strong>
                                    </td>
                                    <?php if ($ques['ExamStat']['ques_status'] == 'R') { ?>
                                        <td style="margin: 0;padding-top: 0;    padding-bottom: 0;line-height: 0;">
                                        <div style="border: 1px solid;padding: 15px 15px;width: 100%;"><strong
                                                    class=""><?php echo __('Correct'); ?></strong></div></td><?php } ?>
                                    <?php if ($ques['ExamStat']['ques_status'] == 'W'){ ?>
                                    <td style="margin: 0;padding-top: 0;    padding-bottom: 0;line-height: 0;">
                                        <div style="border: 1px solid;padding: 15px 15px;width: 100%;"><strong
                                                    class=""><?php echo __('Incorrect'); ?></strong></div>
                                    </td>
                                    <td>
                                        <div style="float: left;border-right: 1px solid;padding: 5px 15px;width: 50%;border: 1px solid;">

                                            <?php echo __('Your Answers'); ?><br><strong
                                                    class=""><?php echo __($userAnswer); ?></strong>
                                        </div>
                                        <div style="float: right;border-right: 1px solid;padding: 5px 15px;width: 50%;border-top: 1px solid;border-bottom: 1px solid;">
                                            <?php if ($ques['Qtype']['type'] != "S"){ ?><?php echo __('Correct Answer'); ?>
                                            <br><?php echo __($correctAnswer); ?></strong></div><?php } ?></td>
                        </div>
                        <?php } else { ?>
                            <?php if ($ques['Qtype']['type'] != "S") { ?>
                                <td>
                                    <div style="float: left;border-right: 1px solid;padding: 5px 15px;width: 100%;border: 1px solid;"><?php echo __('Correct Answer'); ?>
                                        <br>&nbsp;<strong class=""><?php echo __($correctAnswer); ?></script
                                            ","",$ques['Question']['question']);?></strong></div>
                                </td>
                            <?php }
                        } ?>

                        </tr>
                        <tr>
                            <td>
                                <div style="float: left;border-right: 1px solid;padding: 5px 15px;width: 50%;border: 1px solid;">
                                    <?php echo __('Max Marks'); ?>
                                    <br><strong><?php echo $ques['ExamStat']['marks']; ?></strong>
                                </div>
                                <div style="float: right;border-right: 1px solid;padding: 5px 15px;width: 50%;border-top: 1px solid;border-bottom: 1px solid;">
                                    <?php echo __('Marks Scored'); ?><br><strong>
                                        <?php if (!empty($ques['ExamStat']['marks_obtained'])) {
                                            echo $ques['ExamStat']['marks_obtained'];
                                        } else {
                                            echo 0;
                                        }; ?></strong>
                                </div>
                                <div style="clear: both;"></div>
                                <div style="border-right: 1px solid;border-left: 1px solid;padding: 5px 15px;width: 100%;border-bottom: 1px solid;"><?php echo __('Time Taken'); ?>
                                    <br><strong><?php echo $this->Function->secondsToWords($ques['ExamStat']['time_taken'], '-'); ?></strong>
                                </div>
                            </td>

                        </tr>
                        <?php if ($ques['Question']['explanation']) { ?>
                            <tr>
                            <td colspan="3"><strong><?php echo __('Solution'); ?>
                                    :</strong>&nbsp;&nbsp;<?php echo $ques['Question']['explanation']; ?></td>
                            </tr><?php } ?>
                        </table>
                    </div>
                    <div style="padding-bottom: 60px;margin: 0 auto;width: 225px;">
                        <?php
                        if ($quesNo != 1) {
                            echo $this->Form->button('&larr;' . __('Prev'), array('type' => 'button', 'onclick' => "callPrev($quesNo);", 'class' => 'btn btn-default btn-sm btn-block', 'style' => 'background: #FF4081;height: 34px;width: 110px;box-shadow: 1px 2px 3px #888888;color: #fff;border: none;float: left;margin-right: 5px;', 'escape' => false));
                        } ?>

                        <?php if (count($post) != $quesNo) {
                            echo $this->Form->button(__('Next') . '&rarr;', array('type' => 'button', 'onclick' => "callNext($quesNo);", 'class' => 'btn btn-default btn-sm btn-block', 'style' => 'background: #FF4081;height: 34px;width: 110px;box-shadow: 1px 2px 3px #888888;color: #fff;border: none;', 'escape' => false));
                        } ?>


                    </div>

                </div>
                <?php endforeach;
                unset($ques); ?>
            </div>
            <br>
            <div class="col-sm-3">
                <div class="panel-group" style="overflow: hidden;padding: 10px;box-shadow: 0px 2px 5px #888888;"
                     id="accordion">
                    <?php $i = 0;
                    foreach ($userSectionQuestion as $subjectName => $quesArr):$i++;
                        $subjectNameId = str_replace(array(" ", ","), "", h($subjectName));
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background: #08BBE2;color: #fff;">
                                <a data-toggle="collapse" class="subjecthed" data-parent="#accordion"
                                   href="#<?php echo $subjectNameId; ?>"><h4
                                            class="panel-title subjectNamecls"><?php echo h($subjectName); ?></h4></a>
                            </div>
                            <div id="<?php echo $subjectNameId; ?>"
                                 class="panel-collapse collapse<?php if ($i == 1) { ?> in<?php } ?>">
                                <div class="panel-body" style="border: 1px solid #08BBE2;">
                                    <div class="row">
                                        <?php foreach ($quesArr as $value):$quesNo = $value['ExamStat']['ques_no'];
                                            if ($value['ExamStat']['bookmark'] == "Y") $btnColor = "btn-success"; else$btnColor = "btn-default"; ?>
                                            <div class="col-md-3 cols-sm-3 col-xs-3 mrg-1"><?php echo $this->Form->button($quesNo, array('type' => 'button', 'onclick' => "navigation($quesNo)", 'id' => "navbtn$quesNo", 'class' => "btn btn-circle $btnColor btn-sm navigation")); ?></div>
                                        <?php endforeach;
                                        unset($quesArr); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                    unset($i);
                    unset($value); ?>
                </div>
                <div style="padding: 25px;"></div>
            </div>
        </div>
        <?php } ?>
        <div class="tab-pane" id="compare-report">
            <div class="rtest_heading">
                <strong><?php echo __('Compare Report For'); ?>  </strong><?php echo h($examDetails['Exam']['name']); ?>
            </div>
            <div class="com-md-12 col-sm-12 col-xs-12">
                <div class="col-md-3">
                    <div class="">
                        <table class="table">
                            <tr>
                                <td><?php echo __('Total Ques.'); ?></td>
                                <td><strong><?php echo $examDetails['Result']['total_question']; ?></strong></td>
                            </tr>
                            <tr>
                                <td><?php echo __('Maximum Marks'); ?></td>
                                <td><strong><?php echo $examDetails['Result']['total_marks']; ?></strong></td>
                            </tr>
                            <tr>
                                <td><?php echo __('Attempted Ques.'); ?></td>
                                <td><strong class="text-success"><?php echo $attemptedQuestion; ?></strong></td>
                            </tr>
                            <tr>
                                <td><?php echo __('Unattempted Ques.'); ?></td>
                                <td><strong class="text-danger"><?php echo $leftQuestion; ?></strong></td>
                            </tr>
                            <tr>
                                <td><?php echo __('Correct Ques.'); ?></td>
                                <td><strong class="text-success"><?php echo $correctQuestion; ?></strong></td>
                            </tr>
                            <tr>
                                <td><?php echo __('Incorrect Ques.'); ?></td>
                                <td><strong class="text-danger"><?php echo $incorrectQuestion; ?></strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="">
                        <table class="table">
                            <tr>
                                <td><?php echo __('Total Score'); ?></td>
                                <td><strong class="text-primary"><?php echo $examDetails['Result']['obtained_marks']; ?>
                                        /<?php echo $examDetails['Result']['total_marks']; ?></strong></td>
                            </tr>
                            <tr>
                                <td><?php echo __('Percentage'); ?></td>
                                <td>
                                    <strong><?php echo $this->Number->toPercentage($examDetails['Result']['percent']); ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo __('Percentile'); ?></td>
                                <td><strong><?php echo CakeNumber::toPercentage($percentile); ?></strong></td>
                            </tr>
                            <tr>
                                <td><?php echo __('Total Time'); ?></td>
                                <td>
                                    <strong><?php echo $this->Function->secondsToWords($this->Time->fromString($examDetails['Result']['end_time']) - $this->Time->fromString($examDetails['Result']['start_time'])); ?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo __('Rank'); ?></td>
                                <td valign="top"
                                    rowspan="2"><?php echo $this->Html->image($studentImage, array('width' => 60, 'height' => 70, 'class' => 'img-thumbnail')); ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="rank"><?php echo $myRank; ?></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php foreach ($compareArr as $k => $compPost): ?>
                    <div id="comppanel<?php echo $k; ?>" class="compare">
                        <div class="col-md-3">
                            <div class="">
                                <table class="table">
                                    <tr>
                                        <td><?php echo __('Total Ques.'); ?></td>
                                        <td><strong><?php echo $compPost[0]['Result']['total_question']; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __('Maximum Marks'); ?></td>
                                        <td><strong><?php echo $compPost[0]['Result']['total_marks']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __('Attempted Ques.'); ?></td>
                                        <td>
                                            <strong class="text-success"><?php echo $compPost['attempted_question']; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __('Unattempted Ques.'); ?></td>
                                        <td>
                                            <strong class="text-danger"><?php echo $compPost['left_question']; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __('Correct Ques.'); ?></td>
                                        <td>
                                            <strong class="text-success"><?php echo $compPost['correct_question']; ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __('Incorrect Ques.'); ?></td>
                                        <td>
                                            <strong class="text-danger"><?php echo $compPost['incorrect_question']; ?></strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3"><?php if ($k < $compareCount) {
                                    echo $this->Form->button(__('Next'), array('onClick' => "callCompareNext($k);", 'class' => 'btn btn-sm btn-primary'));
                                } ?></div>
                            <div class="col-md-3 col-sm-6 col-xs-6"><?php if ($k != 0) {
                                    echo $this->Form->button(__('Previous'), array('onClick' => "callComparePrev($k);", 'class' => 'btn btn-sm btn-primary'));
                                } ?></div>
                        </div>
                        <div class="col-md-3">
                            <div class="">
                                <table class="table">
                                    <tr>
                                        <td><?php echo __('Total Score'); ?></td>
                                        <td>
                                            <strong class="text-primary"><?php echo $compPost[0]['Result']['obtained_marks']; ?>
                                                /<?php echo $compPost[0]['Result']['total_marks']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __('Percentage'); ?></td>
                                        <td>
                                            <strong><?php echo $this->Number->toPercentage($compPost[0]['Result']['percent']); ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __('Percentile'); ?></td>
                                        <td>
                                            <strong><?php echo CakeNumber::toPercentage($compPost['percentile']); ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __('Total Time'); ?></td>
                                        <td>
                                            <strong><?php echo $this->Function->secondsToWords($this->Time->fromString($compPost[0]['Result']['end_time']) - $this->Time->fromString($compPost[0]['Result']['start_time'])); ?></strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo __('Rank'); ?></td>
                                        <td valign="top"
                                            rowspan="2"><?php echo $this->Html->image($compPost['student_image'], array('width' => 60, 'height' => 70, 'class' => 'img-thumbnail')); ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="rank"><?php echo $compPost['rank']; ?></div>
                                            <div class="rank_name"><?php echo $compPost[0]['Student']['name']; ?></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                unset($compPost); ?>
                <div style="display: none;"><label id="totalRank"><?php echo $compareCount; ?></label></div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="chart">
                    <div id="mywrapperd5"></div>
                    <?php echo $this->HighCharts->render("My Chartd5"); ?>
                </div>
            </div>
        </div>
    </div>
</div>