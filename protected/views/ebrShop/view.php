<?php
/* @var $this EbrShopController */
/* @var $model EbrShop */

$this->breadcrumbs=array(
	'Ebr Shops'=>array('index'),
	$model->shop_id,
);

$this->menu=array(
	array('label'=>'List Shop', 'url'=>array('index')),
	array('label'=>'Create Shop', 'url'=>array('create')),
	array('label'=>'Update Shop', 'url'=>array('update', 'id'=>$model->shop_id)),
	array('label'=>'Delete Shop', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->shop_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Shop', 'url'=>array('admin')),
);
?>

<h1>View Shop #<?php echo $model->shop_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'shop_id',
		'shop_name',
		'created_date',
		'created_by',
		'updated_date',
		'updated_by',
		'group.group_name',
		'shop_deleted',
	),
)); ?>
