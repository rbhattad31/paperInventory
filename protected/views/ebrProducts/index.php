<?php
/* @var $this EbrProductsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ebr Products',
);

$this->menu=array(
	array('label'=>'Create EbrProducts', 'url'=>array('create')),
	array('label'=>'Manage EbrProducts', 'url'=>array('admin')),
);
?>

<h1>Ebr Products</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
