<?php
/* @var $this EbrLookupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ebr Lookups',
);

$this->menu=array(
	array('label'=>'Create EbrLookup', 'url'=>array('create')),
	array('label'=>'Manage EbrLookup', 'url'=>array('admin')),
);
?>

<h1>Ebr Lookups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
