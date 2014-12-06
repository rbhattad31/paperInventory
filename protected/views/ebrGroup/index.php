<?php
/* @var $this EbrGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ebr Groups',
);

$this->menu=array(
	array('label'=>'Create Group', 'url'=>array('create')),
	array('label'=>'Manage Group', 'url'=>array('admin')),
	array('label'=>'Create Shops', 'url'=>array('ebrShop/create')),
);
?>

<h1>Ebr Groups</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
