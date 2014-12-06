<?php
/* @var $this EbrShopController */
/* @var $model EbrShop */

$this->breadcrumbs=array(
	'Ebr Shops'=>array('index'),
	$model->shop_id=>array('view','id'=>$model->shop_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Shop', 'url'=>array('index')),
	array('label'=>'Create Shop', 'url'=>array('create')),
	array('label'=>'View Shop', 'url'=>array('view', 'id'=>$model->shop_id)),
	array('label'=>'Manage Shop', 'url'=>array('admin')),
);
?>

<h1>Update Shop <?php echo $model->shop_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>