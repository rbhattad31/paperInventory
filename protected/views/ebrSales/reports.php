<?php
/* @var $this EbrSalesController */
/* @var $model EbrSales */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Sales', 'url'=>array('index')),
	array('label'=>'Create Sales', 'url'=>array('multipleCreate')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ebr-sales-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ebr Sales</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ebr-sales-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'sale_id',
		'group_id',
		'group.group_name',
		'shop.shop_name',
		'shop_id',
		'product_name',
		'sale_amount',
		'invoice_date',

		/*
		'created_date',
		'created_by',
		'updated_date',
		'updated_by',
		'vendor_id',*/
		'sales_deleted',
		
	),
)); ?>
