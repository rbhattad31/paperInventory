<?php
/* @var $this EbrSalesController */
/* @var $data EbrSales */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sale_id), array('view', 'id'=>$data->sale_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('group_id')); ?>:</b>
	<?php echo CHtml::encode($data->group_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_id')); ?>:</b>
	<?php echo CHtml::encode($data->shop_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('product_id')); ?>:</b>
	<?php echo CHtml::encode($data->product_id); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('sale_amount')); ?>:</b>
	<?php echo CHtml::encode($data->sale_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sales_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->sales_deleted); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sales_date')); ?>:</b>
	<?php echo CHtml::encode($data->sales_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_id')); ?>:</b>
	<?php echo CHtml::encode($data->client_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_number')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_number); ?>
	<br />

	

</div>