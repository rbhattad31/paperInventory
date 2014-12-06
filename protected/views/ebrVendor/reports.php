<?php
/* @var $this EbrVendorController */
/* @var $model EbrVendor */

$this->breadcrumbs=array(
	'Vendors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Vendor', 'url'=>array('index')),
	array('label'=>'Create Vendor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ebr-vendor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Vendors</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ebr-vendor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'vendor_id',
		'vendor_name',
		/*'created_date',
		'created_by',
		'updated_date',
		'updated_by',*/
		'vendor_deleted',
		
	),
)); ?>
