<?php
/* @var $this EbrVendorController */
/* @var $data EbrVendor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->vendor_id), array('view', 'id'=>$data->vendor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_name')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_name); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_deleted); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_address')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_address); ?>
	<br />

	 

</div>