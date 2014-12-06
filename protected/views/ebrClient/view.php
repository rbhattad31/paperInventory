<?php
/* @var $this EbrClientController */
/* @var $model EbrClient */

$this->breadcrumbs=array(
	'Ebr Clients'=>array('index'),
	$model->client_id,
);

$this->menu=array(
	array('label'=>'List EbrClient', 'url'=>array('index')),
	array('label'=>'Create EbrClient', 'url'=>array('create')),
	array('label'=>'Update EbrClient', 'url'=>array('update', 'id'=>$model->client_id)),
	array('label'=>'Delete EbrClient', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->client_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EbrClient', 'url'=>array('admin')),
);
?>

<h1>View EbrClient #<?php echo $model->client_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'client_id',
		'client_name',
		'client_address',
		'client_number',
		'client_tin'
	),
)); ?>
