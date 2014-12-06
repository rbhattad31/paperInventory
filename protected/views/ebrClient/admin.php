<?php
/* @var $this EbrClientController */
/* @var $model EbrClient */

$this->breadcrumbs=array(
	'Ebr Clients'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EbrClient', 'url'=>array('index')),
	array('label'=>'Create EbrClient', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ebr-client-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ebr Clients</h1>

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
	'id'=>'ebr-client-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'client_id',
		'client_name',
		'client_address',
		'client_number',
		'client_tin',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
