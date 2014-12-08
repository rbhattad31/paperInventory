<?php
/* @var $this EbrUserController */
/* @var $model EbrUser */

$this->breadcrumbs=array(
	'Ebr Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List EbrUser', 'url'=>array('index')),
	array('label'=>'Create EbrUser', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ebr-user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ebr Users</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ebr-user-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'email',
		'role',
		'defaultGroup.group_name',
		'defaultShop.shop_name',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
