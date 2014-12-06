<?php
/* @var $this EbrLookupController */
/* @var $model EbrLookup */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ebr-lookup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'lookup_number'); ?>
		<?php echo $form->dropDownList($model,'lookup_number',Utilities::getLookupTypeList(),array('empty' => 'Select a Lookup Type')); ?>
		<?php echo $form->error($model,'lookup_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lookup_name'); ?>
		<?php echo $form->textField($model,'lookup_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'lookup_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lookup_value'); ?>
		<?php echo $form->textField($model,'lookup_value',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'lookup_value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lookup_description'); ?>
		<?php echo $form->textField($model,'lookup_description',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'lookup_description'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->