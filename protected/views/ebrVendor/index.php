<?php
/* @var $this EbrVendorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ebr Vendors',
);

$this->menu=array(
	array('label'=>'Create EbrVendor', 'url'=>array('create')),
	array('label'=>'Manage EbrVendor', 'url'=>array('admin')),
		array('label'=>'Create Products', 'url'=>array('ebrProducts/create')),
		array('label'=>'Create Shops', 'url'=>array('ebrShop/create')),
);
?>

<h1>Ebr Vendors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
