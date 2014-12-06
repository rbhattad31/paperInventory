<?php
/* @var $this EbrGroupController */
/* @var $model EbrGroup */

$this->breadcrumbs=array(
	'Ebr Groups'=>array('index'),
	$model->group_id,
);

$this->menu=array(
	array('label'=>'List Group', 'url'=>array('index')),
	array('label'=>'Create Group', 'url'=>array('create')),
	array('label'=>'Update Group', 'url'=>array('update', 'id'=>$model->group_id)),
	array('label'=>'Delete Group', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->group_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Group', 'url'=>array('admin')),
);
?>

<h1>View Group #<?php echo $model->group_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'group_id',
		'group_name',
		'created_date',
		'created_by',
		'updated_date',
		'updated_by',
		'group_deleted',
	),
)); ?>
