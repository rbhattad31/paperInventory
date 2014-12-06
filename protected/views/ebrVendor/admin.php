<?php
/* @var $this EbrVendorController */
/* @var $model EbrVendor */

$this->breadcrumbs=array(
	'Ebr Vendors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EbrVendor', 'url'=>array('index')),
	array('label'=>'Create EbrVendor', 'url'=>array('create')),
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

<h1>Manage Ebr Vendors</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); */ ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ebr-vendor-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'vendor_id',
		'vendor_name',
		/*'created_date',
		'created_by',
		'updated_date',
		'updated_by',
		*/
		'vendor_deleted',
		'vendor_address',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
