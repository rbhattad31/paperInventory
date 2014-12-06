<?php
/* @var $this EbrVendorController */
/* @var $model EbrVendor */

$this->breadcrumbs=array(
	'Ebr Vendors'=>array('index'),
	$model->vendor_id=>array('view','id'=>$model->vendor_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EbrVendor', 'url'=>array('index')),
	array('label'=>'Create EbrVendor', 'url'=>array('create')),
	array('label'=>'View EbrVendor', 'url'=>array('view', 'id'=>$model->vendor_id)),
	array('label'=>'Manage EbrVendor', 'url'=>array('admin')),
	
);
?>

<h1>Update EbrVendor <?php echo $model->vendor_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>