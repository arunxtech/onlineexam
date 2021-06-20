<?php echo $this->Session->flash();
$dateFormat=$sysDay.$dateSep.$sysMonth.$dateSep.$sysYear;?>
<div class="progressbar-heading grids-heading">
	<h2><?php echo __('My Exams');?></h2>
</div>
<div class="panel">
    <div class="panel-heading">
        <div class="btn-group">			
			<?php echo$this->Html->link(__("Free Exam"),array('controller'=>'Exams','action'=>'free'),array('class'=>'btn btn-success'));?>
			<?php echo$this->Html->link(__("Paid Exam"),array('controller'=>'Exams','action'=>'index'),array('class'=>'btn btn-default'));?>
			<?php if($frontExamPaid){echo$this->Html->link(__("Purchased Exam"),array('controller'=>'Exams','action'=>'purchased'),array('class'=>'btn btn-default'));}?>
			<?php echo$this->Html->link(__('Upcoming Exam'),array('controller'=>'Exams','action'=>'upcoming'),array('class'=>'btn btn-default'));?>
			<?php echo$this->Html->link(__('Expired Exam'),array('controller'=>'Exams','action'=>'expired'),array('class'=>'btn btn-default'));?>
		</div>
    </div>
<div class="panel-body">
		<div class="panel panel-default">
		<div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"><?php echo __('Free Exam');?></h4>
			</div>
		</div>
		<?php
		if($freeExamCount>$limit){
		$loopLimit=ceil($freeExamCount/$limit);
		for($i=0;$i<$loopLimit;$i++){
			$mainLimit=$i*$limit;
			$displayLimit=$i+1;
		echo $this->Html->link($displayLimit,array('action'=>'free',$mainLimit),array('class'=>'btn'));
		}
		}?>	
			<div class="table-responsive">
				<table class="table table-striped">
					<?php if($freeExam){?>
					<tr>
						<th colspan="9"><?php echo __('These are the free exam(s) that can be taken right now');?></th>
					</tr>
					<tr>						
					</tr>
					<tr>
					<?php echo$this->Function->showExamList("today",$freeExam,$currency,$dateFormat,$frontExamPaid,$examExpiry);?>
					<?php }else{?>
					<tr>
						<th colspan="9"><?php echo __('No Exams found');?></th>
					</tr>
					<?php }?>
				</table>
			</div>
		</div> 
	</div>	
</div>
<div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content">        
  </div>
</div>