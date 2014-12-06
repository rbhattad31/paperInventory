<?php
/* @var $this EbrLookupController */
/* @var $model EbrLookup */

$this->breadcrumbs=array(
	'Ebr Lookups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EbrLookup', 'url'=>array('index')),
	array('label'=>'Manage EbrLookup', 'url'=>array('admin')),
);
?>

<h1>Create EbrLookup</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>