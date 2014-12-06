<?php
/* @var $this EbrLookupController */
/* @var $model EbrLookup */

$this->breadcrumbs=array(
	'Ebr Lookups'=>array('index'),
	$model->lookup_id,
);

$this->menu=array(
	array('label'=>'List EbrLookup', 'url'=>array('index')),
	array('label'=>'Create EbrLookup', 'url'=>array('create')),
	array('label'=>'Update EbrLookup', 'url'=>array('update', 'id'=>$model->lookup_id)),
	array('label'=>'Delete EbrLookup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->lookup_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EbrLookup', 'url'=>array('admin')),
);
?>

<h1>View EbrLookup #<?php echo $model->lookup_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'lookup_id',
		'lookup_number',
		'lookup_name',
		'lookup_value',
		'lookup_description',
		/*'created_date',
		'created_by',
		'updated_date',
		'updated_by',*/
	),
)); ?>
