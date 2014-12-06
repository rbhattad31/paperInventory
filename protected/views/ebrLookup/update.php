<?php
/* @var $this EbrLookupController */
/* @var $model EbrLookup */

$this->breadcrumbs=array(
	'Ebr Lookups'=>array('index'),
	$model->lookup_id=>array('view','id'=>$model->lookup_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EbrLookup', 'url'=>array('index')),
	array('label'=>'Create EbrLookup', 'url'=>array('create')),
	array('label'=>'View EbrLookup', 'url'=>array('view', 'id'=>$model->lookup_id)),
	array('label'=>'Manage EbrLookup', 'url'=>array('admin')),
);
?>

<h1>Update EbrLookup <?php echo $model->lookup_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>