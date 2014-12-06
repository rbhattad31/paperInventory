<?php
/* @var $this EbrProductsController */
/* @var $model EbrProducts */

$this->breadcrumbs=array(
	'Ebr Products'=>array('index'),
	$model->product_id=>array('view','id'=>$model->product_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EbrProducts', 'url'=>array('index')),
	array('label'=>'Create EbrProducts', 'url'=>array('create')),
	array('label'=>'View EbrProducts', 'url'=>array('view', 'id'=>$model->product_id)),
	array('label'=>'Manage EbrProducts', 'url'=>array('admin')),
);
?>

<h1>Update EbrProducts <?php echo $model->product_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>