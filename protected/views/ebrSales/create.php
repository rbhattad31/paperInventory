<?php
/* @var $this EbrSalesController */
/* @var $model EbrSales */

$this->breadcrumbs=array(
	'Ebr Sales'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EbrSales', 'url'=>array('index')),
	array('label'=>'Manage EbrSales', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('create', "
$('#EbrSales_group_id').change(function(){
		var group= this.value;
		var url = $('#appURL').val();
		$.ajax({
               type: 'POST',
               url: url,
				dataType: 'json',
               data: { groupId:group},

                           success: function(data1)
                               {
		 $('#EbrSales_shop_id').empty();
		 var select = document.getElementById('EbrSales_shop_id');
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


");
?>

<h1>Create EbrSales</h1>
<input type="hidden" id="appURL"  value="<?php echo $this->createUrl('site/shops')?>"/>
<?php echo $this->renderPartial('_form', array('model'=>$model,'allShops'=>$allShops)); ?>