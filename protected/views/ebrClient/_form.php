<?php
/* @var $this EbrClientController */
/* @var $model EbrClient */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ebr-client-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'client_name'); ?>
		<?php echo $form->textField($model,'client_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'client_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'client_address'); ?>
		<?php echo $form->textField($model,'client_address',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'client_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'client_number'); ?>
		<?php echo $form->textField($model,'client_number',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'client_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'client_tin'); ?>
		<?php echo $form->textField($model,'client_tin',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'client_tin'); ?>
	</div>

	
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->