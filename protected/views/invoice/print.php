

Invoice Number : <?php echo $invoice?><br/>

<?php if(count($sales) > 0){?>

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
		<td><?php echo $sales[$i]->quantity?></td>
		<td><?php echo $sales[$i]->sale_amount?></td>
		
		</tr>
		<?php } ?>
		 
		
	</tbody>
</table>
<?php }?>


<script type="text/javascript"> 
window.print();
</script>
