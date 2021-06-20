<?php echo $this->Session->flash(); ?>
<div class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title"><?php echo __('Leader Board'); ?></div>
    </div>
</div>
<div class="panel">
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th><?php echo __('Photo'); ?></th>
                    <th><?php echo __('Rank'); ?></th>
                    <th><?php echo __('Name'); ?></th>
                    <th><?php echo __('Average Percentage(%)'); ?></th>
                    <th><?php echo __('Exam Given'); ?></th>
                </tr>
                <?php foreach ($scoreboard as $post):
                if($post['Selection']['photo']==""){
                    $photo='User.png';
                }
                else{
                    $photo='student_thumb/'.$post['Selection']['photo'];
                }
                ?>
                    <tr>
                        <td><?php echo $this->Html->image($photo,array('title'=>$post['Selection']['name'],'alt'=>$post['Selection']['name'],'class'=>'img-responsive img-circle img-thumbnail','style'=>'height:50px;'));?></td>
                        <td><?php echo $post['Selection']['rank']; ?></td>
                        <td><?php echo h($post['Selection']['name']); ?></td>
                        <td><?php echo $post['Selection']['points']; ?>%</td>
                        <td><?php echo $post['Selection']['exam_given']; ?></td>
                    </tr>
                <?php endforeach;
                unset($post); ?>
            </table>
        </div>
    </div>
</div>

