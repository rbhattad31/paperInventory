<?php
/* @var $this EbrClientController */
/* @var $model EbrClient */

$this->breadcrumbs=array(
	'Ebr Clients'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EbrClient', 'url'=>array('index')),
	array('label'=>'Manage EbrClient', 'url'=>array('admin')),
);
?>

<h1>Create EbrClient</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>