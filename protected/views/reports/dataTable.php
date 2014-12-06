<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modules/data.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modules/exporting.js"></script>
<style type="text/css">
${demo.css}
		</style>
		
		
<?php
Yii::app()->clientScript->registerScript('data', "



$(document).ready(function () {
		$(function () {
    $('#container').highcharts({
        data: {
            table: document.getElementById('datatable')
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Purchase Report'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Units'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
});
$('#citeriaList').change(function(){
		this.form.submit();
		
});
$('#export').click(function(){
		this.form.action = 'export';
		this.form.submit();
		
});
          });
		
		");
?>

<?php echo CHtml::beginForm(); ?>
<?php echo CHtml::dropDownList('criteria',$criteria,Utilities::getCriteriaForProductsList(),array('empty' => 'Select a Criteria',
																									'id'=>'citeriaList')); ?>
<input type="submit" formaction="<?php echo $this->createUrl('reports/exportPurchases')?>"  value="Export"/>
<?php echo CHtml::endForm(); ?>
<table id="datatable">
	<thead>
		<tr>
			<th></th>
			<?php for($i=1;$i<=count($criteriaList);$i++){?>
			<th><?php echo $criteriaList[$i] ?></th>
			<?php }?>
		</tr>
	</thead>
	<tbody>
		
		<?php for($i=0;$i<count($total);$i++){
			
		?>
		<tr>
			<th><?php echo $products[$i]->product_name?></th>
			<?php for($j=0;$j<count($criteriaList);$j++){?>
			<td><?php echo $total[$i][$j]['total']?></td>
		
		<?php
			}
		?>
		</tr>
		<?php } ?>
		 
		
	</tbody>
</table>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
