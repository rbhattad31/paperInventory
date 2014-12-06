<?php
/* @var $this EbrVendorController */
/* @var $model EbrVendor */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'vendor_id'); ?>
		<?php echo $form->textField($model,'vendor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vendor_name'); ?>
		<?php echo $form->textField($model,'vendor_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

		<div class="row">
		<?php echo $form->label($model,'vendor_deleted'); ?>
		<?php echo $form->textField($model,'vendor_deleted',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vendor_address'); ?>
		<?php echo $form->textField($model,'vendor_address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->