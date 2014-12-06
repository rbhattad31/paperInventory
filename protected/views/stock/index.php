<?php


$this->breadcrumbs=array(
	'Ebr Purchases',
);

$this->menu=array(
	array('label'=>'Search Stocks', 'url'=>array('search'))
	
);
?>

<h1>Stocks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
