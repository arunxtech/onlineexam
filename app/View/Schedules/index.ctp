<?php //$cartUrl = $this->Html->url(array('controller' => 'Carts', 'action' => 'View')); ?>
<?php

$this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
    'update' => '#resultDiv',
    'evalScripts' => true,
));
?>
<style type="text/css">
    .loading {
        position: absolute;
        left: 0;
        right: 0;
        margin: 0 auto;
    }
</style>
<section class="section">
    <?php echo $this->Html->image("loading-lg.gif", array('alt' => 'subscribe', 'class' => 'loading hidden', 'id' => 'loading')); ?>
    <div class="container mycontainer">
        <div id="resultDiv">
            <div class="page-heading">
                <div class="widget">
                    <h2 class="title-border"><?php echo __('Schedules'); ?></h2>
                </div>
            </div>
            <div id="Schedules" class="row list-group">
                <div class="schedule-div">
                    <div class="col-md-6">
                        <div class="select-pkg">
                            <?php echo $this->Form->select('Package_id', $Package_id, array('empty' => array('' => 'Please Select'), 'multiple' => false, 'class' => 'form-control', 'id' => 'packageid', 'div' => false, 'label' => false)); ?>
                        </div>
                        <div class="pkg-name" id="pkgdetail">
                            <p><b>Package :</b> <span id="pac_name"><?php //echo $Packages['Package']['name']; ?></span>
                            </p>
                            <p><b>Cost :</b> <span
                                        id="pac_amount"><?php //echo $Packages['Package']['amount']; ?></span></p>
                            <p><b>Total Tests :</b> <span id="pac_tests"><?php //echo $Examscount; ?></span></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="pkg-des">
                            <p id="pac_desc"><?php //echo $Packages['Package']['description']; ?></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="schedule-heading ">
                        <h3 class="themeBacColour"><?php echo __('Schedule'); ?></h3>
                    </div>

                    <div class="schedule-table table-responsive" id="sch_table">

                        <div id="list_div">

                            <table class="table">
                                <tbody>
                                <tr>
                                    <th class="darkylw">
                                        <?php echo __('Test Name'); ?>
                                    </th>
                                    <th class="lightylw">
                                        <?php echo __('Syllabus'); ?>
                                    </th>
                                    <th class="darkylw">
                                        <?php echo __('Starts from date'); ?>
                                    </th>
                                </tr>
                                <?php
                                foreach ($Exams as $key => $Exam) { //echo "<pre>"; print_r($Exam); ?>
                                    <tr id="1">
                                        <td class="clr1td">
                                            <?php echo $this->Html->image("schedule_test.png", array('alt' => 'subscribe', 'class' => 'img-responsive')); ?>
                                            <p><?php echo $Exam['Exam']['name'] ?></p>
                                        </td>
                                        <td class="whitetd">
                                            <?php echo $Exam['Exam']['syllabus'] ?>
                                        </td>
                                        <td class="clr2td">
                                            <?php echo $this->Html->image("Calender.png", array('alt' => 'subscribe', 'class' => 'img-responsive')); ?>
                                            <p><?php echo $this->Time->format('jS F, Y', $Exam['Exam']['start_date']); ?></p>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<script>
    $('#packageid').on('change', function () {
        $('#loading').removeClass('hidden');
        var value = $(this).val();
        var datat
        $.ajax({
            url: "<?php echo $this->Html->url(array('controller' => 'Schedules', 'action' => 'exam_by_package_id')); ?>",
            type: "POST",
            data: {package_id: value},
            success: function (data) {
                $("#list_div").html(data);
                $('#loading').addClass('hidden');
            }
        });
        myget_book(value)
    });

    function myget_book(param) {
        var data
        $.ajax({
            url: "<?php echo $this->Html->url(array('controller' => 'Schedules', 'action' => 'get_package_by_id')); ?>",
            type: "POST",
            data: {package_id: param},
            success: function (data) {
                var array = data.split(',|');
                $("#pac_name").html(array[0]);
                ;
                $("#pac_amount").html(array[1]);
                ;
                $("#pac_tests").html(array[2]);
                $("#pac_desc").html(array[3]);
            }
        });
    }


</script>
