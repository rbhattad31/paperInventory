<?php
/* @var $this EbrVendorController */
/* @var $model EbrVendor */

$this->breadcrumbs=array(
	'Ebr Vendors'=>array('index'),
	$model->vendor_id,
);

$this->menu=array(
	array('label'=>'List EbrVendor', 'url'=>array('index')),
	array('label'=>'Create EbrVendor', 'url'=>array('create')),
	array('label'=>'Update EbrVendor', 'url'=>array('update', 'id'=>$model->vendor_id)),
	array('label'=>'Delete EbrVendor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->vendor_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EbrVendor', 'url'=>array('admin')),
);
?>

<h1>View EbrVendor #<?php echo $model->vendor_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'vendor_id',
		'vendor_name',
		'vendor_deleted',
		'vendor_address',
	),
)); ?>
