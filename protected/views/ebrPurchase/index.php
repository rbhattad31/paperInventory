<?php
/* @var $this EbrPurchaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ebr Purchases',
);

$this->menu=array(
	array('label'=>'Create EbrPurchase', 'url'=>array('create')),
	array('label'=>'Manage EbrPurchase', 'url'=>array('admin')),
);
?>

<h1>Ebr Purchases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
