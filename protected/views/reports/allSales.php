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
	var data1 = [{
            name: 'Product 1',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'Product 2',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: 'Product 3',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }];
		
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
            text: 'Monthly Product Sales',
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
<input type="hidden" id="appURL"  value="<?php echo $this->createUrl('reports/allSalesData')?>"/>
<div id="container" style="min-width: 600px; height: 400px; margin: 0 auto"></div>