

<?php if(count($items) > 0){?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ebr-sales-form',
	'enableAjaxValidation'=>false,
));
Yii::app()->clientScript->registerScript('create', "
$('#EbrSales_0_group_id').change(function(){
		var group= this.value;
		var url = $('#appURL').val();
		$.ajax({
               type: 'POST',
               url: url,
				dataType: 'json',
               data: { groupId:group},

                           success: function(data1)
                               {
		 $('#EbrSales_0_shop_id').empty();
		 var select = document.getElementById('EbrSales_0_shop_id');
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
$('.unitPrice').change(function() {
	var qu1 = $(this);
	var res = qu1.attr('id').split('unitPrice');
	var qu = document.getElementById(res[0]+'quantity').value;
	var unit = this.value;
		if(unit == ''){
		alert('Enter unit price for product');
		this.focus();
		return;
		}else if(unit != null && isNaN(unit)){
		alert('Enter a valid unit price');
		this.focus();
		return;
		}else if(unit != null && qu != null && !isNaN(qu)){
		var total = parseFloat(unit) * parseInt(qu);  
		document.getElementById(res[0]+'amount').value = total;
		}
			
		});
$('.quantity').change(function() {
	var qu = $(this);
	var res = qu.attr('id').split('quantity');
	var price = document.getElementById(res[0]+'unitPrice').value;
		var reg = new RegExp('^(?:[1-9]\d*|0)?(?:\.\d+)?$'); 
	if(price == ''){
		alert('Enter unit price for product');
		document.getElementById(res[0]+'unitPrice').focus();
		return;
	}else if(this.value == ''){
		alert('Enter units for product');
		this.focus();
		return;
	}else if(this.value != null && isNaN(this.value)){
		alert('Enter a valid quantity.');
		this.focus();
		return;
	}else if(price != null && isNaN(price)){
		
		alert('Enter a valid Unit Price.');
		document.getElementById(res[0]+'unitPrice').focus();
		return;
		
	}else{
		var total = parseFloat(document.getElementById(res[0]+'unitPrice').value) * parseInt(this.value);  
		document.getElementById(res[0]+'amount').value = total;
	}
});
		
$('#create').click(function() {
		$('#formSubmit').val('true');
});
		$('#add').click(function() {
		$('#formSubmit').val(null);
});
");

?>

<?php echo CHtml::beginForm(); ?>
<?php if(Yii::app()->user->hasFlash('printInvoice')): ?>
 
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('printInvoice'); ?>
</div>
 
<?php endif; ?>


<input type="hidden" id="appURL"  value="<?php echo $this->createUrl('site/shops')?>"/>
<input type="hidden" id="deleteURL"  value="<?php echo $this->createUrl('ebrSales/delete')?>"/>
<table>
<tbody>
<tr>
<td>
<div class="row">
		<?php echo $form->labelEx($items[0],'group_id'); ?>
		
		<?php echo $form->dropDownList($items[0],"[0]group_id",Utilities::getGroupsList(),array('empty' => 'Select a group')); ?>
		<?php echo $form->error($items[0],'group_id'); ?>
	</div>
</td>
<td>
<div class="row">
		<?php echo $form->labelEx($items[0],'shop_id'); ?>
		<?php echo $form->dropDownList($items[0],'[0]shop_id',$allShops,array('empty' => 'Select a shop')); ?>
		<?php echo $form->error($items[0],'shop_id'); ?>
</div>

</td>
</tr>
<tr>
<td>
<div class="row">
<?php echo $form->labelEx($items[0],'invoice_number'); ?>
		<?php echo $form->textField($items[0],'[0]invoice_number',array(
        'disabled'=>'true'
    )); ?>
		
</div>

</td>
<td>
<div class="row">
		<?php echo $form->labelEx($model,'sales_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    'model' => $items[0],
	'attribute' => '[0]sales_date',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'showOn' => 'both',             // also opens with a button
		'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
		'showOtherMonths' => true,      // show dates in other months
		'selectOtherMonths' => true,    // can seelect dates in other months
		'changeYear' => true,           // can change year
		'changeMonth' => true,          // can change month
		'yearRange' => '2000:2099',     // range of year
		'minDate' => '2000-01-01',      // minimum date
		'maxDate' => '2099-12-31',      // maximum date
		'showButtonPanel' => true,
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
)); 
		 ?>
		<?php echo $form->error($items[0],'sales_date'); ?>
	</div>

</td>
</tr>
<tr>
<td>
<div class="row">
		<?php echo $form->labelEx($model,'client_id'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		'model' => $items[0],
		'attribute' => '[0]client_id',
		'source'=>$this->createUrl('site/suggestClients'),
		'options'=>array(
				'showAnim'=>'fold',
		),
)); ?>
		<?php echo $form->error($items[0],'client_id'); ?>
	</div>

</td>
</tr>

<tr>
<td>
<?php echo CHtml::submitButton('Add Rows',array('id'=>'add')); ?>&nbsp;<input type="text" name="rows">
</td>

</tr>
</tbody>
</table>
	<input type="hidden" id="appURL"  value="<?php echo $this->createUrl('site/shops')?>"/>
	<input type="hidden" id="deletedRows" name="deletedRows" value="">
	<input type="hidden" id="formSubmit" name="formSubmit">

<table>
<tr>
<th><?php echo $form->labelEx($model,'product_id'); ?></th>
<th><?php echo $form->labelEx($model,'unit_price'); ?></th>
<th><?php echo $form->labelEx($model,'quantity'); ?></th>
<th></th>
<th><?php echo $form->labelEx($model,'sale_amount'); ?></th>
</tr>
<?php foreach($items as $i=>$item): ?>

<tr class="row">
<td>

<?php echo CHtml::activeHiddenField($item,"[$i]sale_id"); ?>
<?php 

$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
		'model' => $item,
		'attribute' => "[$i]product_id",
		'source'=>$this->createUrl('site/suggestProductsAndVendors'),
		'options'=>array(
				'showAnim'=>'fold',
				'change' => new CJavaScriptExpression('function(e, ui) {
				var res = this.id.split("product");
				document.getElementById(res[0]+"unitPrice").value = ui.item.sales_price;
			 document.getElementById(res[0]+"units").innerHTML = ui.item.units;
			document.getElementById(res[0]+"quantity").value = null;
			document.getElementById(res[0]+"amount").value = null;
				}')
						),
						'htmlOptions'=>array(
								'id'=>$i.'product',
						),
));
 ?> 
 <?php echo $form->error($item,'product_id'); ?>
 </td>
 <td>
<?php echo CHtml::activeTextField($item,"[$i]unit_price",array('id'=>$i.'unitPrice',
															'class'=>'unitPrice')); ?>
<?php echo $form->error($item,'unit_price'); ?>

</td>

<td>
<?php echo CHtml::activeTextField($item,"[$i]quantity",array('id'=>$i.'quantity',
															'class'=>'quantity')); ?>
<?php echo $form->error($item,'quantity'); ?>
	

</td>
<td id="<?php echo $i.'units'?>">

</td>
 
<td>
<?php echo CHtml::activeTextField($item,"[$i]sale_amount",array('id'=>$i.'amount',
															'class'=>'amount')); ?>
<?php echo $form->error($item,"sale_amount"); ?>
</td>


</tr>

<?php endforeach; ?>
</table>
 
<?php echo CHtml::submitButton('Save',array('id'=>'create')); ?>
<?php echo CHtml::endForm(); ?>
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php }?>