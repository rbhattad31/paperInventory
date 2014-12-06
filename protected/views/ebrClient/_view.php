<?php
/* @var $this EbrClientController */
/* @var $data EbrClient */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->client_id), array('view', 'id'=>$data->client_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_name')); ?>:</b>
	<?php echo CHtml::encode($data->client_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_address')); ?>:</b>
	<?php echo CHtml::encode($data->client_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_number')); ?>:</b>
	<?php echo CHtml::encode($data->client_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('client_tin')); ?>:</b>
	<?php echo CHtml::encode($data->client_tin); ?>
	<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('client_deleted')); ?>:</b>
	<?php echo CHtml::encode($data->client_deleted); ?>
	<br />

	
</div>