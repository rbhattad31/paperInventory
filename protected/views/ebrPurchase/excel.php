<?php
$this->widget('EExcelWriter', array(
		'dataProvider' => $model->search(),
		'title'        => 'EExcelWriter',
		'stream'       => FALSE,
		'fileName'     => 'file.xls',
		'columns'      => array(
				array(
						'header' => 'id',
						'name' => 'purchase_id',
				),
				'group_id',
				'shop_id',
		),
));
