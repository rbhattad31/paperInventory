<?php
/* @var $this EbrUserController */
/* @var $model EbrUser */

$this->breadcrumbs=array(
	'Ebr Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EbrUser', 'url'=>array('index')),
	array('label'=>'Manage EbrUser', 'url'=>array('admin')),
);
?>

<h1>Create EbrUser</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>