<div <?php if (!$isError){ ?>class="container"<?php } ?>>
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit Question Languages'); ?><?php if (!$isError) { ?>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php } ?>
        </div>
        <div class="panel">
            <div class="panel-body"><?php echo $this->Session->flash(); ?>
                <?php echo $this->Form->create('Language', array('name' => 'post_req', 'id' => 'post_req', 'class' => 'form-horizontal')); ?>
                <?php foreach ($Language as $k => $post): $id = $post['Language']['id'];
                    $form_no = $k + 1; ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>
                                <small class="text-danger"><?php echo __('Form'); ?><?php echo $form_no ?></small>
                            </strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="group_name" class="col-sm-3 control-label"><?php echo __('Name'); ?></label>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input("$k.Language.name", array('label' => false, 'class' => 'form-control', 'placeholder' => __('Name'), 'div' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="group_name" class="col-sm-3 control-label"><?php echo __('True'); ?></label>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input("$k.Language.value1", array('label' => false, 'class' => 'form-control', 'placeholder' => __('Language True'), 'div' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="group_name"
                                       class="col-sm-3 control-label"><?php echo __('False'); ?></label>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input("$k.Language.value2", array('label' => false, 'class' => 'form-control', 'placeholder' => __('Languege False'), 'div' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group text-left">
                                <div class="col-sm-offset-3 col-sm-7">
                                    <?php echo $this->Form->input("$k.Language.id", array('type' => 'hidden')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php unset($post); ?>
                <div class="form-group text-left">
                    <div class="col-sm-offset-3 col-sm-7">
                        <?php echo $this->Form->button('<span class="fa fa-refresh"></span>&nbsp;' . __('Update'), array('class' => 'btn btn-success', 'escpae' => false)); ?>
                        <?php if (!$isError) { ?>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span
                                    class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel'); ?></button><?php } else {
                            echo $this->Html->link('<span class="fa fa-close"></span>&nbsp;' . __('Close'), array('action' => 'index'), array('class' => 'btn btn-danger', 'escape' => false));
                        } ?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>