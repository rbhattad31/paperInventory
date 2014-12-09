<?php
/* @var $this EbrProductsController */
/* @var $model EbrProducts */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ebr-products-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'product_name'); ?>
		<?php echo $form->textField($model,'product_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'product_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vendor_id'); ?>
		<?php echo $form->dropDownList($model,'vendor_id',Utilities::getVendorsList(),array('empty' => 'Select a vendor')); ?>
		<?php echo $form->error($model,'vendor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_description'); ?>
		<?php echo $form->textField($model,'product_description',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'product_description'); ?>
	</div>

	<?php if(!isset($edit)){?>
	<div class="row">
		<?php echo $form->labelEx($model,'unit_lookup_id'); ?>
		<?php echo $form->dropDownList($model,'unit_lookup_id',Utilities::getLookupListById(LookupConstants::$UNITS_LOOKUP_NUMBER),array('empty' => 'Select a Unit'));  ?>
		<?php echo $form->error($model,'unit_lookup_id'); ?>
	</div>
	<?php }else {?>
	<div class="row">
		<?php echo $form->labelEx($model,'unit_lookup_id'); ?>
		<?php echo $form->dropDownList($model,'unit_lookup_id',Utilities::getLookupListById(LookupConstants::$UNITS_LOOKUP_NUMBER),array('empty' => 'Select a Unit',
																																			'disabled'=>'true'));  ?>
		<?php echo $form->error($model,'unit_lookup_id'); ?>
	</div>
	
	<?php }?>
	<div class="row">
		<?php echo $form->labelEx($model,'unit_price'); ?>
		<?php echo $form->textField($model,'unit_price',array('size'=>10,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'unit_price'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'sale_price'); ?>
		<?php echo $form->textField($model,'sale_price',array('size'=>10,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'sale_price'); ?>
	</div>
	
	
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->