<?php
/* @var $this EbrSalesController */
/* @var $model EbrSales */

$this->breadcrumbs=array(
	'Ebr Sales'=>array('index'),
	$model->sale_id,
);

$this->menu=array(
	array('label'=>'List EbrSales', 'url'=>array('index')),
	array('label'=>'Create EbrSales', 'url'=>array('create')),
	array('label'=>'Update EbrSales', 'url'=>array('update', 'id'=>$model->sale_id)),
	array('label'=>'Delete EbrSales', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sale_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EbrSales', 'url'=>array('admin')),
);
?>

<h1>View EbrSales #<?php echo $model->sale_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sale_id',
		'group.group_name',
		'shop.shop_name',
		'product.product_name',
		'vendor.vanedor_name',
		'sale_amount',
		'sales_date',
		'quantity',
		'client.client_name',
		'invoice_number',
	),
)); ?>
