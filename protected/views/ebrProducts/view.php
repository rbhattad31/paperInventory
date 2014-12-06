<?php
/* @var $this EbrProductsController */
/* @var $model EbrProducts */

$this->breadcrumbs=array(
	'Ebr Products'=>array('index'),
	$model->product_id,
);

$this->menu=array(
	array('label'=>'List EbrProducts', 'url'=>array('index')),
	array('label'=>'Create EbrProducts', 'url'=>array('create')),
	array('label'=>'Update EbrProducts', 'url'=>array('update', 'id'=>$model->product_id)),
	array('label'=>'Delete EbrProducts', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->product_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EbrProducts', 'url'=>array('admin')),
);
?>

<h1>View EbrProducts #<?php echo $model->product_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'product_id',
		'product_name',
		'vendor_id',
		'product_description',
		'unitLookup.lookup_name',
		'unit_price',
		/*'created_date',
		'created_by',
		'updated_date',
		'updated_by',*/
	),
)); ?>
