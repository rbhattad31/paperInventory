<?php
/* @var $this EbrVendorController */
/* @var $model EbrVendor */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ebr-vendor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'vendor_name'); ?>
		<?php echo $form->textField($model,'vendor_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'vendor_name'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'vendor_address'); ?>
		<?php echo $form->textArea($model,'vendor_address',array('rows'=>6, 'cols'=>50,'size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'vendor_address'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->