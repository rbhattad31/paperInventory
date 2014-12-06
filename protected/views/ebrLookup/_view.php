<?php
/* @var $this EbrLookupController */
/* @var $data EbrLookup */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('lookup_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->lookup_id), array('view', 'id'=>$data->lookup_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lookup_number')); ?>:</b>
	<?php echo CHtml::encode($data->lookup_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lookup_name')); ?>:</b>
	<?php echo CHtml::encode($data->lookup_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lookup_value')); ?>:</b>
	<?php echo CHtml::encode($data->lookup_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lookup_description')); ?>:</b>
	<?php echo CHtml::encode($data->lookup_description); ?>
	<br />

	

</div>