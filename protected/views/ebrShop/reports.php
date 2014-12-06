<?php
/* @var $this EbrShopController */
/* @var $model EbrShop */

$this->breadcrumbs=array(
	'Shops'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Shop', 'url'=>array('index')),
	array('label'=>'Create Shop', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ebr-shop-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Shops</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ebr-shop-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'shop_id',
		'shop_name',
		/*'created_date',
		'created_by',
		'updated_date',
		'updated_by',*/
		'group_id',
		'group.group_name',
		'shop_deleted',
		
	),
)); ?>
