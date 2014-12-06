<?php
/* @var $this EbrPurchaseController */
/* @var $model EbrPurchase */

$this->breadcrumbs=array(
	'Ebr Purchases'=>array('index'),
	$model->purchase_id=>array('view','id'=>$model->purchase_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EbrPurchase', 'url'=>array('index')),
	array('label'=>'Create EbrPurchase', 'url'=>array('create')),
	array('label'=>'View EbrPurchase', 'url'=>array('view', 'id'=>$model->purchase_id)),
	array('label'=>'Manage EbrPurchase', 'url'=>array('admin')),
);
?>

<h1>Update EbrPurchase <?php echo $model->purchase_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'allShops'=>$allShops)); ?>