<?php
/* @var $this InvoiceController */

$this->breadcrumbs=array(
	'Invoice'=>array('/invoice'),
	'InvoiceNumber',
);
?>
<?php if(Yii::app()->user->hasFlash('printInvoice')): ?>
 
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('printInvoice'); ?>
</div>
 
<?php endif; ?>

<h1> Invoice <?php echo $invoice ?></h1><br/>

<?php if(count($sales) > 0){?>
<input type="button" value="Print" id="prJs" onclick="window.open('<?php echo $this->createUrl('invoice/print',array("invoice" => $invoice))?>','_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400');" /><br/>
<table>
<thead>
<?php echo CHtml::encode(Yii::app()->name); ?>
</thead>
<tbody>
<tr>
<td>
Group &nbsp; <?php echo $sales[0]->group->group_name?>
</td>
<td>
Shop &nbsp; <?php echo $sales[0]->shop->shop_name?>
</td>
</tr>
<tr>
<td>

Client &nbsp; <?php echo $sales[0]->client->client_name?>
</td>
<td>
Sales Date &nbsp; <?php echo $sales[0]->sales_date?><br/>
</td>
</tr>
<tr>
<td>
Client Address&nbsp; <?php echo $sales[0]->client->client_address?>

</td>
<td>
Client Number&nbsp; <?php echo $sales[0]->client->client_number?><br/>
</td>
</tr>

</tbody>
</table>

<table id="datatable">
	<thead>
		<tr>
			<th></th>
			<th>Product</th>
			<th>Unit Price</th>
			<th>Quantity</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		
		<?php for($i=0;$i<count($sales);$i++){
			
		?>
		<tr>
		<td></td>
		<td><?php echo $sales[$i]->product->product_name?>,<?php echo $sales[$i]->vendor->vendor_name?></td>
		<td><?php echo $sales[$i]->unit_price?></td>
		<td><?php echo $sales[$i]->quantity?>&nbsp;<?php echo $sales[$i]->product->unitLookup->lookup_name?></td>
		<td><?php echo $sales[$i]->sale_amount?></td>
		</tr>
		<?php } ?>
		 
		
	</tbody>
</table>
<?php }?>
