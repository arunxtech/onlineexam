<?php echo $this->Html->script('bootstrap-filestyle.min'); ?>
<script type="text/javascript">
    $(":file").filestyle();
</script>
<style type="text/css">
    .hr-text {
        line-height: 1em;
        position: relative;
        outline: 0;
        border: 0;
        color: black;
        text-align: center;
        height: 1.5em;
        opacity: .5;
    }

    .hr-text:before {
        content: '';
        background: linear-gradient(to right, transparent, #818078, transparent);
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
    }

    .hr-text:after {
        content: attr(data-content);
        position: relative;
        display: inline-block;
        color: black;
        padding: 0 .5em;
        line-height: 1.5em;
        color: gray;
        background-color: #e8e8e8;
    }

    .text_center {
        text-align: center;
    }

    .mbs:hover {
        color: white;
    }

    hr {
        margin: 15px 0;
    }

    .btn-group {
        width: 100%;
    }

    button.multiselect.dropdown-toggle.btn.btn-default {
        width: 100%;
    }

    @media (max-width: 767px) {
        .pageMarginTab {
            margin-top: 50px;
        }
    }
</style>
<section class="section">
    <div class="container mycontainer ">
        <div class="col-md-12 RegisterPage">
            <?php echo $this->Session->flash();
            $rej = null;
            $log = 'active';
            if ($urlId == 1) {
                $rej = 'active';
                $log = '';
            } else {
                $log = 'active';
            }

            ?>
            <div class="col-md-6 col-md-offset-3 pageMarginTab">


                <ul class="nav nav-pills">
                    <li class="<?php echo $log; ?>" style="">
                        <a style="" href="#2a" data-toggle="tab"><?php echo __('Login'); ?></a>
                    </li>
                    <li class="<?php echo $rej; ?>" style="">
                        <a style=";" href="#1a" data-toggle="tab"><?php echo __('Register'); ?></a>
                    </li>
                </ul>
                <div class="tab-content clearfix">
                    <div class="tab-pane <?php echo $rej; ?>" id="1a" style="margin-top: 15px;">

                        <?php echo $this->Form->create('Register', array('url' => array('action' => 'index', '1'), 'name' => 'post_req_register', 'id' => 'post_req_register', 'class' => 'form-horizontal', 'role' => 'form', 'type' => 'file','method'=>'post')); ?>
                        <div class="form-group">
                            <?php echo $this->Form->input('email', array('id'=>'register_email','label' => false, 'class' => 'form-control', 'placeholder' => '* ' . __('Email'), 'div' => false)); ?>
                        </div>
                        <div class="form-group">

                            <?php echo $this->Form->select('StudentGroup.group_name', $group_id, array('multiple' => true, 'label' => false, 'class' => 'form-control multiselectgrp', 'placeholder' => __('Group'), 'div' => false)); ?>

                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('name', array('label' => false, 'class' => 'form-control', 'placeholder' => '* ' . __('Name'), 'div' => false)); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('password', array('id'=>'register_password','label' => false, 'class' => 'form-control', 'placeholder' => '* ' . __('Password'), 'minlength' => '4', 'maxlength' => '15', 'div' => false)); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('address', array('label' => false, 'class' => 'form-control', 'placeholder' => '* ' . __('Address'), 'div' => false)); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('phone', array('label' => false, 'class' => 'form-control', 'placeholder' => '* ' . __('Mobile Number'), 'div' => false)); ?>
                        </div>
                        <div class="form-group">

                            <?php echo $this->Form->input('guardian_phone', array('label' => false, 'class' => 'form-control', 'placeholder' => __('Alternate Number'), 'div' => false)); ?>
                        </div>
                        <div class="form-group">

                            <?php echo $this->Form->input('photo', array('type' => 'file', 'label' => false, 'class' => 'form-control filestyle', 'div' => false, 'data-text' => __("Choose Photo"), 'data-btnClass' => "btn-primary")); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Captcha->render($captchaSettings); ?>

                        </div>
                        <div class="form-group text-center">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-success"><span
                                            class="fa fa-user"></span> <?php echo __('Submit'); ?></button>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                    <div class="tab-pane <?php echo $log; ?>" id="2a" style="margin-top: 15px;">
                        <?php echo $this->Form->create('Register', array('url' => array('action' => 'login'), 'name' => 'post_req', 'id' => 'post_req', 'class' => 'form-horizontal', 'role' => 'form')); ?>


                        <div class="form-group">

                            <?php echo $this->Form->input('email', array('required' => true, 'type' => 'email', 'label' => false, 'class' => 'form-control', 'placeholder' => __('Email'), 'div' => false)); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('password', array('required' => true, 'label' => false, 'class' => 'form-control', 'placeholder' => __('Password'), 'value' => '', 'type' => 'password', 'div' => false)); ?>
                        </div>
                        <div class="form-group"><?php echo $this->Html->link(__('Re-Send Email Verification'), array('crm' => true, 'controller' => 'Emailverifications', 'action' => 'resend'), array('class' => 'btn-link', 'escape' => false)); ?></div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-sm-5 p0">
                                <button type="submit"
                                        class="btn btn-success btn-circle btn-block btn-shadow mbs"><?php echo __('Log in'); ?></button>
                            </div>
                            <?php if ($frontRegistration == 1) { ?>
                                <div class="col-sm-7">
                                    <?php echo $this->Html->link(__('Forgot Password'), array('crm' => true, 'controller' => 'forgots', 'action' => 'password'), array('class' => 'btn-link', 'escape' => false)); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <hr>
                        <?php if ($frontRegistration == 1) { ?>
                            <div class="form-group">
                                <p><?php echo __("Don't have an account?"); ?>
                                    <a href="#1a" class="btn-link"
                                       data-toggle="tab"><?php echo __('New User? Create Account'); ?></a>
                                </p>
                            </div>
                        <?php } ?>

                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>