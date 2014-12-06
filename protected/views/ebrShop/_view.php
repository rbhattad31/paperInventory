<?php
/* @var $this EbrShopController */
/* @var $data EbrShop */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->shop_id), array('view', 'id'=>$data->shop_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_name')); ?>:</b>
	<?php echo CHtml::encode($data->shop_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_date')); ?>:</b>
	<?php echo CHtml::encode($data->updated_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('group_name')); ?>:</b>
	<?php echo CHtml::encode($data->group->group_name); ?>
	<br />
	
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('shop_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->shop_deleted); ?>
	<br />

	*/ ?>

</div>