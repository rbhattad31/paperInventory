<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modules/data.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modules/exporting.js"></script>
<style type="text/css">
${demo.css}
		</style>
<?php
Yii::app()->clientScript->registerScript('data', "


$(document).ready(function ()  {
	var data = [];
var url = $('#appURL').val();
		
	$.ajax({
               type: 'POST',
               url: url,
				dataType: 'json',
				async : false,
                success: function(data1){
					$.each(data1, function(key,value) {
						var object = new Object();	
						object.name = value.name;
						var dataAr = []; 
						$.each(value.data, function(key,value) {
						dataAr.push(value);
						});
						object.data = dataAr;
						data.push(object);
						});
	
	             }

             })
		
    $('#container').highcharts({
        title: {
            text: 'Monthly Product Purchases',
            x: -20 //center
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Rupees'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'Rs'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: data
    });
});
		
			
");
?>
<input type="hidden" id="appURL"  value="<?php echo $this->createUrl('reports/allPurchasesData')?>"/>
<div id="container" style="min-width: 600px; height: 400px; margin: 0 auto"></div>