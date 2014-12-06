<?php
/* @var $this EbrStockController */
/* @var $model EbrStock */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ebr-stock-_form-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'available_quantity'); ?>
		<?php echo $form->textField($model,'available_quantity'); ?>
		<?php echo $form->error($model,'available_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_sale'); ?>
		<?php echo $form->textField($model,'total_sale'); ?>
		<?php echo $form->error($model,'total_sale'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shop_id'); ?>
		<?php echo $form->textField($model,'shop_id'); ?>
		<?php echo $form->error($model,'shop_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vendor_id'); ?>
		<?php echo $form->textField($model,'vendor_id'); ?>
		<?php echo $form->error($model,'vendor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->