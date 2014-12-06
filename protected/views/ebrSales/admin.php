<?php
/* @var $this EbrSalesController */
/* @var $model EbrSales */

$this->breadcrumbs=array(
	'Ebr Sales'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EbrSales', 'url'=>array('index')),
	array('label'=>'Create EbrSales', 'url'=>array('create')),
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

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); */ ?>
<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ebr-sales-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'sale_id',
		'group.group_name',
		'shop.shop_name',
		'product.product_name',
		'sale_amount',
		'sales_deleted',
		'sales_date',
		'quantity',
		'client.client_name',
		'invoice_number',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
