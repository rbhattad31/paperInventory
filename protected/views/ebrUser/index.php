<?php
/* @var $this EbrUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ebr Users',
);

$this->menu=array(
	array('label'=>'Create EbrUser', 'url'=>array('create')),
	array('label'=>'Manage EbrUser', 'url'=>array('admin')),
);
?>

<h1>Ebr Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
