<?php
/* @var $this EbrShopController */
/* @var $model EbrShop */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ebr-shop-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'shop_name'); ?>
		<?php echo $form->textField($model,'shop_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'shop_name'); ?>
	</div>

	
	
	<div class="row">
		<?php echo $form->labelEx($model,'group_id'); ?>
		<?php echo $form->dropDownList($model,'group_id',Utilities::getGroupsList(),array('empty' => 'Select a group')); ?>
		<?php echo $form->error($model,'group_id'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->