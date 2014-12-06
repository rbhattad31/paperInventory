<?php

class ReportsController extends Controller{
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','view'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('admin','reports','exportPurchases','exportSales','dataTablePurchases','allPurchases','allPurchasesData','dataTableSales','allSales','allSalesData'),
						'roles'=>array('admin','general'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	
	public function actionDataTablePurchases(){
		$model=new EbrPurchase;
		$products = EbrProducts::model()->findAll();
		if(isset($_POST['criteria']))
		{
			$criteria = $_POST['criteria'];
			if($criteria === 'Shops'){
				$total = Reports::getAmountPurchaseByShops();
				$shops = EbrShop::model()->getActiveShops();
				foreach($shops as $i=>$shop){
					$criteriaList[$i+1]= $shop->shop_name;
				}
	
			}
			if($criteria === 'Vendors'){
				$total = Reports::getAmountPurchaseByVendors();
				$vendors = EbrVendor::model ()->getActiveVendors();
				foreach($vendors as $i=>$vendor){
					$criteriaList[$i+1]= $vendor->vendor_name;
				}
	
			}
			if($criteria === 'Groups'){
				$total = Reports::getAmountPurchaseByGroups();
				$groups = EbrGroup::model()->getActiveGroups();
				foreach($groups as $i=>$group){
					$criteriaList[$i+1]= $group->group_name;
				}
			}
				
		}else{
			$criteria = 'Shops';
			$total = Reports::getAmountPurchaseByShops();
			$shops = EbrShop::model()->getActiveShops();
			foreach($shops as $i=>$shop){
				$criteriaList[$i+1]= $shop->shop_name;
			}
				
		}
	
	
		$this->render('dataTable',array(
				'model'=>$model,
				'total'=>$total,
				'criteriaList'=>$criteriaList,
				'criteria'=>$criteria,
				'products'=>$products,
		));
	}
	
	public function actionAllPurchases(){
		$this->render('allPurchases',array(
	
		));
	}
	
	public function actionAllPurchasesData(){
		//$total = Utilities::getAllPurchases();
		$total = Reports::getAllPurchases();
		$allPurchaseArray =array();
		$products = EbrProducts::model()->findAll();
		for($i = 0; $i < count ( $total ); $i ++) {
			//$product = $products[$i];
			$allPurchaseArray[$i]['name']= $products[$i]->product_name;
			$data = array();
			for($j = 1; $j <= 12; $j++){
				$data[$j]= $total[$i][$j]['total'];
			}
			$allPurchaseArray[$i]['data']= $data;
		}
		echo CJSON::encode($allPurchaseArray);
	
	}
	
	public function actionDataTableSales(){
		$model=new EbrSales();
		$products = EbrProducts::model()->findAll();
		if(isset($_POST['criteria']))
		{
			$criteria = $_POST['criteria'];
			if($criteria === 'Shops'){
				$total = Reports::getAmountSalesByShops();
				$shops = EbrShop::model()->getActiveShops();
				foreach($shops as $i=>$shop){
					$criteriaList[$i+1]= $shop->shop_name;
				}
	
			}
			if($criteria === 'Groups'){
				$total = Reports::getAmountSalesByGroups();
				$groups = EbrGroup::model()->getActiveGroups();
				foreach($groups as $i=>$group){
					$criteriaList[$i+1]= $group->group_name;
				}
			}
			if($criteria === 'Vendors'){
				$total = Reports::getAmountSalesByVendors();
				$vendors = EbrVendor::model ()->getActiveVendors();
				foreach($vendors as $i=>$vendor){
					$criteriaList[$i+1]= $vendor->vendor_name;
				}
			
			}
			
	
		}else{
			$criteria = 'Shops';
			$total = Reports::getAmountSalesByShops();
			$shops = EbrShop::model()->getActiveShops();
			foreach($shops as $i=>$shop){
				$criteriaList[$i+1]= $shop->shop_name;
			}
	
		}
	
	
		$this->render('dataTableSales',array(
				'model'=>$model,
				'total'=>$total,
				'criteriaList'=>$criteriaList,
				'criteria'=>$criteria,
				'products'=>$products,
		));
	}
	
	public function actionAllSales(){
		$this->render('allSales',array(
	
		));
	}
	
	public function actionAllSalesData(){
		//$total = Utilities::getAllPurchases();
		$total = Reports::getAllSales();
		$allPurchaseArray =array();
		$products = EbrProducts::model()->findAll();
		for($i = 0; $i < count ( $total ); $i ++) {
			//$product = $products[$i];
			$allPurchaseArray[$i]['name']= $products[$i]->product_name;
			$data = array();
			for($j = 1; $j <= 12; $j++){
				$data[$j]= $total[$i][$j]['total'];
			}
			$allPurchaseArray[$i]['data']= $data;
		}
		echo CJSON::encode($allPurchaseArray);
	
	}
	
	public function actionExportPurchases(){
		$model=new EbrPurchase;
		$products = EbrProducts::model()->findAll();
		if(isset($_POST['criteria']))
		{
			$criteria = $_POST['criteria'];
			if($criteria === 'Shops'){
				$total = Reports::getAmountPurchaseByShops();
				$shops = EbrShop::model()->getActiveShops();
				foreach($shops as $i=>$shop){
					$criteriaList[$i+1]= $shop->shop_name;
				}
				ExcelExport::exportToExcel($criteriaList,$products,$total);
	
			}
			else if($criteria === 'Vendors'){
				$total = Reports::getAmountPurchaseByVendors();
				$vendors = EbrVendor::model ()->getActiveVendors();
				foreach($vendors as $i=>$vendor){
					$criteriaList[$i+1]= $vendor->vendor_name;
				}
				ExcelExport::exportToExcel($criteriaList,$products,$total);
			}else if($criteria === 'Groups'){
				$total = Reports::getAmountPurchaseByGroups();
				$groups = EbrGroup::model()->getActiveGroups();
				foreach($groups as $i=>$group){
					$criteriaList[$i+1]= $group->group_name;
				}
				ExcelExport::exportToExcel($criteriaList,$products,$total);
			}
		
		}
	}
	
	public function actionExportSales(){
		
		$products = EbrProducts::model()->findAll();
		if(isset($_POST['criteria']))
		{
			$criteria = $_POST['criteria'];
			if($criteria === 'Shops'){
				$total = Reports::getAmountSalesByShops();
				$shops = EbrShop::model()->getActiveShops();
				foreach($shops as $i=>$shop){
					$criteriaList[$i+1]= $shop->shop_name;
				}
				ExcelExport::exportToExcel($criteriaList,$products,$total);
			}else if($criteria === 'Groups'){
				$total = Reports::getAmountSalesByGroups();
				$groups = EbrGroup::model()->getActiveGroups();
				foreach($groups as $i=>$group){
					$criteriaList[$i+1]= $group->group_name;
				}
				ExcelExport::exportToExcel($criteriaList,$products,$total);
			}else if($criteria === 'Vendors'){
				$total = Reports::getAmountSalesByVendors();
				$vendors = EbrVendor::model ()->getActiveVendors();
				foreach($vendors as $i=>$vendor){
					$criteriaList[$i+1]= $vendor->vendor_name;
				}
				ExcelExport::exportToExcel($criteriaList,$products,$total);
			}
				
		}
	}
	
	
}