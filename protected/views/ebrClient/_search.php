<?php
/* @var $this EbrClientController */
/* @var $model EbrClient */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'client_id'); ?>
		<?php echo $form->textField($model,'client_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_name'); ?>
		<?php echo $form->textField($model,'client_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_address'); ?>
		<?php echo $form->textField($model,'client_address',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_number'); ?>
		<?php echo $form->textField($model,'client_number',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'client_tin'); ?>
		<?php echo $form->textField($model,'client_tin',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->