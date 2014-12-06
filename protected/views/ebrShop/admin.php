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

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));*/ ?>
<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ebr-shop-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'shop_id',
		'shop_name',
		'created_date',
		'created_by',
		'updated_date',
		'updated_by',
		'group_id',
		'group.group_name',
		'shop_deleted',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
