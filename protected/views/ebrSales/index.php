<?php
/* @var $this EbrSalesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ebr Sales',
);

$this->menu=array(
	array('label'=>'Create EbrSales', 'url'=>array('create')),
	array('label'=>'Manage EbrSales', 'url'=>array('admin')),
);
?>

<h1>Ebr Sales</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
