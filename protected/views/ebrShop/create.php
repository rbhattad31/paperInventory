<?php
/* @var $this EbrShopController */
/* @var $model EbrShop */

$this->breadcrumbs=array(
	'Ebr Shops'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Shop', 'url'=>array('index')),
	array('label'=>'Manage Shop', 'url'=>array('admin')),
);
?>

<h1>Create Shop</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>