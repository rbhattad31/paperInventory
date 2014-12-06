<?php
/* @var $this EbrProductsController */
/* @var $data EbrProducts */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->product_id), array('view', 'id'=>$data->product_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_name')); ?>:</b>
	<?php echo CHtml::encode($data->product_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_description')); ?>:</b>
	<?php echo CHtml::encode($data->product_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_lookup_id')); ?>:</b>
	<?php echo CHtml::encode($data->unit_lookup_id); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_price')); ?>:</b>
	<?php echo CHtml::encode($data->unit_price); ?>
	<br />
	
</div>