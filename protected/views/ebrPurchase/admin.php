<?php
/* @var $this EbrPurchaseController */
/* @var $model EbrPurchase */

$this->breadcrumbs=array(
	'Purchases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Purchase', 'url'=>array('index')),
	array('label'=>'Create Purchase', 'url'=>array('batchCreate')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ebr-purchase-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php if(Yii::app()->user->hasFlash('purchaseSuccess')): ?>
 
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('purchaseSuccess'); ?><a href='<?php echo $this->createUrl('ebrPurchase/multipleCreate')?>'><span>Create Another Purchase</span></a>
</div>
 
<?php endif; ?>

<h1>Manage Purchases</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));*/ ?>
<div class="search-form">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ebr-purchase-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'purchase_id',
		'group.group_name',
		'shop.shop_name',
		'product.product_name',
		'quantity',
		'unit_price',
		'purchase_amount',
		'invoice_number',
		'vendor.vendor_name',
		'purchase_deleted',
		'invoice_date',
		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
