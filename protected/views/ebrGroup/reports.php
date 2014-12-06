<?php
/* @var $this EbrGroupController */
/* @var $model EbrGroup */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Group', 'url'=>array('index')),
	array('label'=>'Create Group', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ebr-group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ebr-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'group_id',
		'group_name',
		/*'created_date',
		'created_by',
		'updated_date',
		'updated_by',*/
		'group_deleted',
	),
)); ?>
