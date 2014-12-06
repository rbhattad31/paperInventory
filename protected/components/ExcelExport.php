<?php
class ExcelExport {
	
	public static function exportToExcel($criteriaList,$products,$total){
	
	
		$objPHPExcel = new PHPExcel();
	
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Bradsol")
		->setLastModifiedBy("Bradsol")
		->setTitle("Excel Report")
		->setSubject("Excel Report")
		->setDescription("Excel Report")
		->setKeywords("office PHPExcel php YiiExcel UPNFM")
		->setCategory("Excel Report");
	
		// Add some data
		$dataRow = "B";
		for($i=1;$i<=count($criteriaList);$i++){
			$coulumn = "";
			$coulumn .= $dataRow;
			$coulumn .= 1;
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue($coulumn, $criteriaList[$i]);
		$dataRow++;
		}
		
		// Add some data
		$dataRow = "A";
		$k = 2;
		for($i=0;$i<count($total);$i++){
			$coulumn = "";
			$coulumn .= $dataRow;
			$coulumn .= $k;
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue($coulumn,  $products[$i]->product_name);
			//$dataRow++;
			$k++;
		}
		// Miscellaneous glyphs, UTF-8
		$dataRow = "B";
		$k = 2;
		for($i=0;$i<count($total);$i++){
		for($j=0;$j<count($criteriaList);$j++){
			$coulumn = "";
			$coulumn .= $dataRow;
			$coulumn .= $k;
			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue($coulumn, $total[$i][$j]['total']);
			$dataRow++;
		}
		$dataRow = "B";
		$k++;
		}
				
	
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Report');
	
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
	
		$filename = 'Report';
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
				header('Cache-Control: max-age=0');
				
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				
				$objWriter->save('php://output');
				unset($this->objWriter);
				unset($this->objWorksheet);
				unset($this->objReader);
				unset($this->objPHPExcel);
				exit();
	}//fin del mÃ©todo actionExcel
	
	public function actionExcel2(){
	
		//Some data
		$students = array(
				array('name'=>'Test','obs'=>'Mat'),
				array('name'=>'Test 2','obs'=>'Tec'),
				array('name'=>'Test 3','obs'=>'Mat')
		);
	
		$r = new YiiReport(array('template'=> 'students.xls'));
		//$r = new YiiReport();
		$r->load(array(
				array(
						'id' => 'ong',
						'data' => array(
								'name' => 'UNIVERSIDAD PADAGÓGICA NACIONAL'
						)
				),
				array(
						'id'=>'estu',
						'repeat'=>true,
						'data'=>$students,
						'minRows'=>2
				)
		)
		);
	
		echo $r->render('excel5', 'Students');
		//echo $r->render('excel2007', 'Students');
		//echo $r->render('pdf', 'Students');
	
	}//actionExcel method end
	
	
}