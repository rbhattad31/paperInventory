<?php
/* @var $this EbrPurchaseController */
/* @var $model EbrPurchase */

$this->breadcrumbs=array(
	'Purchases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Purchase', 'url'=>array('index')),
	array('label'=>'Manage Purchase', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('create', "
$('#EbrPurchase_group_id').change(function(){
		var group= this.value;
		var url = $('#appURL').val();
		$.ajax({
               type: 'POST',
               url: url,
				dataType: 'json',
               data: { groupId:group},

                           success: function(data1)
                               {
		 $('#EbrPurchase_shop_id').empty();
		 var select = document.getElementById('EbrPurchase_shop_id');
		              var opt = document.createElement('option');
					    opt.value = '';
					    opt.text = 'Select a Shop';
					    select.add(opt);
 				$.each(data1, function(key,value) {
						var opt = document.createElement('option');
					    opt.value = value.shop_id;
					    opt.text = value.shop_name;
					    select.add(opt);
				});
                       }

             });

});
				
$('.search-form form').submit(function(){
	$('#ebr-purchase-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
		
");

?>

<h1>Create Purchase</h1>
<input type="hidden" id="appURL"  value="<?php echo $this->createUrl('site/shops')?>"/>
<?php echo $this->renderPartial('_form', array('model'=>$model,'allShops'=>$allShops
													)); ?>