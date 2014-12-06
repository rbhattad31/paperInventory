<?php
/* @var $this EbrSalesController */
/* @var $model EbrSales */

$this->breadcrumbs=array(
	'Ebr Sales'=>array('index'),
	$model->sale_id=>array('view','id'=>$model->sale_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EbrSales', 'url'=>array('index')),
	array('label'=>'Create EbrSales', 'url'=>array('create')),
	array('label'=>'View EbrSales', 'url'=>array('view', 'id'=>$model->sale_id)),
	array('label'=>'Manage EbrSales', 'url'=>array('admin')),
);
?>

<h1>Update EbrSales <?php echo $model->sale_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>