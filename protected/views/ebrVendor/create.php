<?php
/* @var $this EbrVendorController */
/* @var $model EbrVendor */

$this->breadcrumbs=array(
	'Ebr Vendors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EbrVendor', 'url'=>array('index')),
	array('label'=>'Manage EbrVendor', 'url'=>array('admin')),
	array('label'=>'Create Products', 'url'=>array('ebrProducts/create')),
	array('label'=>'Create Shops', 'url'=>array('ebrShop/create')),
);
?>

<h1>Create EbrVendor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>