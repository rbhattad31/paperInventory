<?php
/* @var $this EbrUserController */
/* @var $model EbrUser */

$this->breadcrumbs=array(
	'Ebr Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EbrUser', 'url'=>array('index')),
	array('label'=>'Create EbrUser', 'url'=>array('create')),
	array('label'=>'Update EbrUser', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EbrUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EbrUser', 'url'=>array('admin')),
);
?>

<h1>View EbrUser #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
		'role',
	),
)); ?>
