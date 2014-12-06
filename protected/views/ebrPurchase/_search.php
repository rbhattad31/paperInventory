<?php
/* @var $this EbrPurchaseController */
/* @var $model EbrPurchase */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'purchase_id'); ?>
		<?php echo $form->textField($model,'purchase_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'group_id'); ?>
		<?php echo $form->dropDownList($model,'group_id',Utilities::getGroupsList(),array('empty' => 'Select a group')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shop_id'); ?>
		<?php echo $form->dropDownList($model,'shop_id',Utilities::getShopsList(),array('empty' => 'Select a shop')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'product_id'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model' => $model,
				'attribute' => 'product_id',
				'source'=>$this->createUrl('site/suggestProducts'),
				'options'=>array(
						'showAnim'=>'fold',
				),
		));
		 ?>
	</div>

	
	<div class="row">
		<?php echo $form->label($model,'purchase_amount'); ?>
		<?php echo $form->textField($model,'purchase_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_number'); ?>
		<?php echo $form->textField($model,'invoice_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vendor_id'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model' => $model,
				'attribute' => 'vendor_id',
				'source'=>$this->createUrl('site/suggestVendors'),
				'options'=>array(
						'showAnim'=>'fold',
				),
		)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purchase_deleted'); ?>
		<?php echo $form->textField($model,'purchase_deleted',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'model' => $model,
	'attribute' => 'invoice_date',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
'showOn' => 'both',             // also opens with a button
'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
'showOtherMonths' => true,      // show dates in other months
'selectOtherMonths' => true,    // can seelect dates in other months
'changeYear' => true,           // can change year
'changeMonth' => true,          // can change month
'yearRange' => '2000:2099',     // range of year
'minDate' => '2000-01-01',      // minimum date
'maxDate' => '2099-12-31',      // maximum date
'showButtonPanel' => true,
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->