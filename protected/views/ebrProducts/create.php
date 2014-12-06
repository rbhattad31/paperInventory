<?php
/* @var $this EbrProductsController */
/* @var $model EbrProducts */

$this->breadcrumbs=array(
	'Ebr Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EbrProducts', 'url'=>array('index')),
	array('label'=>'Manage EbrProducts', 'url'=>array('admin')),
);
?>

<h1>Create EbrProducts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>