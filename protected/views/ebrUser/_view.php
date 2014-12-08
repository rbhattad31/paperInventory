<?php
/* @var $this EbrUserController */
/* @var $data EbrUser */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('role')); ?>:</b>
	<?php echo CHtml::encode($data->role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('default_group')); ?>:</b>
	<?php echo CHtml::encode($data->default_group); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('default_shop')); ?>:</b>
	<?php echo CHtml::encode($data->default_shop); ?>
	<br />

	</div>