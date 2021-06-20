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
    if (!empty($Exams)) {
        foreach ($Exams as $key => $Exam) {
            ?>
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
        <?php }
    } else {
        ?>

        <tr id="1">
            <td colspan="3" class="clr1td">
                <p><?php echo __('No exams found'); ?></p>
            </td>
        </tr>

    <?php } ?>
    </tbody>
</table>