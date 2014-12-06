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
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php 
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
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
		<?php echo $form->labelEx($model,'shop_id'); ?>
		<?php echo $form->textField($model,'shop_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vendor_id'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model' => $model,
				'attribute' => 'vendor_id',
				'source'=>$this->createUrl('site/suggestVendors'),
				'options'=>array(
						'showAnim'=>'fold',
				),
		));
		
		 ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->