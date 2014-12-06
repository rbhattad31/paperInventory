<?php
/* @var $this EbrClientController */
/* @var $model EbrClient */

$this->breadcrumbs=array(
	'Ebr Clients'=>array('index'),
	$model->client_id=>array('view','id'=>$model->client_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EbrClient', 'url'=>array('index')),
	array('label'=>'Create EbrClient', 'url'=>array('create')),
	array('label'=>'View EbrClient', 'url'=>array('view', 'id'=>$model->client_id)),
	array('label'=>'Manage EbrClient', 'url'=>array('admin')),
);
?>

<h1>Update EbrClient <?php echo $model->client_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>