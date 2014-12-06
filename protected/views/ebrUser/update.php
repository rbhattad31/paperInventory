<?php
/* @var $this EbrUserController */
/* @var $model EbrUser */

$this->breadcrumbs=array(
	'Ebr Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EbrUser', 'url'=>array('index')),
	array('label'=>'Create EbrUser', 'url'=>array('create')),
	array('label'=>'View EbrUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EbrUser', 'url'=>array('admin')),
);
?>

<h1>Update EbrUser <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>