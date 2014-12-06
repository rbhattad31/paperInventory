<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/highcharts.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modules/exporting.js"></script>
<style type="text/css">
${demo.css}
		</style>
		
<?php
/* @var $this EbrPurchaseController */
/* @var $model EbrPurchase */

$this->breadcrumbs=array(
	'Purchases'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Purchase', 'url'=>array('index')),
	array('label'=>'Create Purchase', 'url'=>array('batchCreate')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ebr-purchase-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
		
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Historic World Population by Region'
        },
        subtitle: {
            text: 'Source: Wikipedia.org'
        },
        xAxis: {
            categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' millions'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Year 1800',
            data: [107, 31, 635, 203, 2]
        }, {
            name: 'Year 1900',
            data: [133, 156, 947, 408, 6]
        }, {
            name: 'Year 2008',
            data: [973, 914, 4054, 732, 34]
        }]
    });
});
		
");
?>

<h1>Manage Purchases</h1>
<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
<?php echo CHtml::link('Export',array('ebrPurchase/excel'),array('class'=>'delete',
																		)); ?> 
<?php
// $dataProvider->getData() will return a list of arrays.
$this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$dataProvider,
));
 ?>
