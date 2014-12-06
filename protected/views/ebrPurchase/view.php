<?php
/* @var $this EbrPurchaseController */
/* @var $model EbrPurchase */

$this->breadcrumbs=array(
	'Purchases'=>array('index'),
	$model->invoice_number,
);

$this->menu=array(
	array('label'=>'List EbrPurchase', 'url'=>array('index')),
	array('label'=>'Create EbrPurchase', 'url'=>array('create')),
	array('label'=>'Update EbrPurchase', 'url'=>array('update', 'id'=>$model->purchase_id)),
	array('label'=>'Manage EbrPurchase', 'url'=>array('admin')),
);
?>

<h1>View Purchase #<?php echo $model->invoice_number; ?></h1>

<?php if(count($purchases) > 0){?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ebr-purchase-form',
	'enableAjaxValidation'=>false,
)); ?>
<table>
<tbody>
<tr>
<td>
<?php echo $form->label($model,'group_id'); ?> &nbsp; <?php echo $purchases[0]->group->group_name?>
</td>
<td>
<?php echo $form->label($model,'shop_id'); ?> &nbsp; <?php echo $purchases[0]->shop->shop_name?>
</td>
</tr>
<tr>
<td>
<?php echo $form->label($model,'invoice'); ?> &nbsp; <?php echo $purchases[0]->invoice_date?><br/>
</td>
</tr>
</tbody>
</table>

<table id="datatable">
	<thead>
		<tr>
			<th></th>
			<th><?php echo $form->label($model,'product_id'); ?></th>
			<th><?php echo $form->label($model,'unit_price'); ?></th>
			<th><?php echo $form->label($model,'quantity'); ?></th>
			<th><?php echo $form->label($model,'purchase_amount'); ?></th>
		</tr>
	</thead>
	<tbody>
		
		<?php for($i=0;$i<count($purchases);$i++){
			
		?>
		<tr>
		<td></td>
		<td><?php echo $purchases[$i]->product->product_name?>,<?php echo $purchases[$i]->vendor->vendor_name?></td>
		<td><?php echo $purchases[$i]->unit_price?></td>
		<td><?php echo $purchases[$i]->quantity?>&nbsp;<?php echo $purchases[$i]->product->unitLookup->lookup_name?></td>
		<td><?php echo $purchases[$i]->purchase_amount?></td>
		</tr>
		<?php } ?>
		 
		
	</tbody>
</table>
<?php $this->endWidget(); ?>
<?php }?>


