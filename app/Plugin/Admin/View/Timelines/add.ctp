<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Add Timelines'); ?></div>
    <div class="panel-body"><?php echo $this->Session->flash(); ?>
        <?php echo $this->Form->create('Subject', array('class' => 'form-horizontal')); ?>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">
                <small><?php echo __('Class Name'); ?></small>
            </label>
            <div class="col-sm-9">
                <?php echo $this->Form->select('SubjectGroup.group_name', $group_id, array('multiple' => true, 'label' => false, 'class' => 'form-control multiselectgrp', 'div' => false)); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-3 control-label">
                <small><?php echo __('Timeline'); ?></small>
            </label>
            <div class="col-sm-9">
                <?php echo $this->Form->input('title', array('label' => false, 'class' => 'form-control', 'placeholder' => __('Title'), 'div' => false)); ?>
            </div>
        </div>
        <div class="form-group text-left">
            <div class="col-sm-offset-3 col-sm-7">
                <?php echo $this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;' . __('Save'), array('class' => 'btn btn-success', 'escpae' => false)); ?>
                <?php echo $this->Html->link('<span class="fa fa-close"></span>&nbsp;' . __('Close'), array('action' => 'index'), array('class' => 'btn btn-danger', 'escape' => false)); ?>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>