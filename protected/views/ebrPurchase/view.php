<?php
/* @var $this EbrPurchaseController */
/* @var $model EbrPurchase */

$this->breadcrumbs=array(
	'Ebr Purchases'=>array('index'),
	$model->purchase_id,
);

$this->menu=array(
	array('label'=>'List EbrPurchase', 'url'=>array('index')),
	array('label'=>'Create EbrPurchase', 'url'=>array('create')),
	array('label'=>'Update EbrPurchase', 'url'=>array('update', 'id'=>$model->purchase_id)),
	array('label'=>'Delete EbrPurchase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->purchase_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EbrPurchase', 'url'=>array('admin')),
);
?>

<h1>View EbrPurchase #<?php echo $model->purchase_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'purchase_id',
		'group.group_name',
		'shop.shop_name',
		'product.product_name',
		'quantity',
		'product.unitLookup.lookup_name',
		'unit_price',
		'purchase_amount',
		'invoice_number',
		'vendor.vendor_name',
		'purchase_deleted',
		'invoice_date',
		'quantity',
	),
)); ?>
