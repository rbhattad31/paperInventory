<?php
/* @var $this EbrShopController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ebr Shops',
);

$this->menu=array(
	array('label'=>'Create Shop', 'url'=>array('create')),
	array('label'=>'Manage Shop', 'url'=>array('admin')),
);
?>

<h1>Ebr Shops</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
