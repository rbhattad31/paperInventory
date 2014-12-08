<?php
/* @var $this EbrUserController */
/* @var $model EbrUser */

$this->breadcrumbs=array(
	'Ebr Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EbrUser', 'url'=>array('index')),
	array('label'=>'Create EbrUser', 'url'=>array('create')),
	array('label'=>'View EbrUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EbrUser', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('create', "
$('#EbrUser_default_group').change(function(){
var group= this.value;
var url = $('#appURL').val();
$.ajax({
type: 'POST',
url: url,
dataType: 'json',
data: { groupId:group},

success: function(data1)
{
$('#EbrUser_default_shop').empty();
var select = document.getElementById('EbrUser_default_shop');
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

<h1>Update EbrUser <?php echo $model->id; ?></h1>
<input type="hidden" id="appURL"  value="<?php echo $this->createUrl('site/shops')?>"/>
<?php echo $this->renderPartial('_form', array('model'=>$model,'allShops'=>$allShops)); ?>