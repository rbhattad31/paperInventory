<?php
/* @var $this EbrLookupController */
/* @var $model EbrLookup */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'lookup_id'); ?>
		<?php echo $form->textField($model,'lookup_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lookup_number'); ?>
		<?php echo $form->dropDownList($model,'lookup_number',Utilities::getLookupTypeList(),array('empty' => 'Select a Lookup Type')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lookup_name'); ?>
		<?php echo $form->textField($model,'lookup_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lookup_value'); ?>
		<?php echo $form->textField($model,'lookup_value',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lookup_description'); ?>
		<?php echo $form->textField($model,'lookup_description',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->