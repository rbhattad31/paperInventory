<?php
/* @var $this EbrClientController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ebr Clients',
);

$this->menu=array(
	array('label'=>'Create EbrClient', 'url'=>array('create')),
	array('label'=>'Manage EbrClient', 'url'=>array('admin')),
);
?>

<h1>Ebr Clients</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
