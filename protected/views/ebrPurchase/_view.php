<?php
/* @var $this EbrPurchaseController */
/* @var $data EbrPurchase */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->purchase_id), array('view', 'id'=>$data->purchase_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo CHtml::encode($data->group->group_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_id')); ?>:</b>
	<?php echo CHtml::encode($data->shop->shop_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product->product_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />
	
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_amount')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_number')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor->vendor_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_date')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_date); ?>
	<br />

	
	

</div>