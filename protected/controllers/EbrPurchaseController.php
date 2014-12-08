<?php

class EbrPurchaseController extends Controller
{
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
				'actions'=>array('create','update','suggestVendors','shops','multipleCreate','reports','excel','dataTable','allPurchases','allPurchasesData'),
				'roles'=>array('admin','general'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array('admin'),
			),
					array('deny',  // deny all users
					'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$invoice = $model->invoice_number;
		$models = EbrPurchase::model()->getPurchaseByInvoice($invoice);
		
		$this->render('view',array(
			'model'=>$model,
			'purchases'=>$models,
		));
	}
	
	public function actionDataTable(){
		$model=new EbrPurchase;
		$products = Constants::$product_list;
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
				$vendors = EbrVendor::model ()->findAllByAttributes ( array (
						'vendor_deleted' => array (
								'N'
						)
				) );
				foreach($vendors as $i=>$vendor){
					$criteriaList[$i+1]= $vendor->vendor_name;
				}
				
			}
			if($criteria === 'Groups'){
				$total = Reports::getAmountPurchaseByGroups();
				$groups = EbrGroup::model()->findAllByAttributes(
						array(
								'group_deleted'=>array('N')
						));
				foreach($groups as $i=>$group){
					$criteriaList[$i+1]= $group->group_name;
				}
			}
			
		}else{
			$criteria = 'Shops';
			$total = Reports::getAmountPurchaseByShops();
		$shops =  EbrShop::model()->getActiveShops();
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
		$total = Utilities::getAllPurchases();
		$allPurchaseArray =array();
		$products = Constants::$product_list;
		for($i = 1; $i <= count ( $total ); $i ++) {
			//$product = $products[$i];
			$allPurchaseArray[$i]['name']= $products[$i];
			$data = array();
			for($j = 1; $j <= 12; $j++){
				$data[$j]= $total[$i][$j]['total'];
			}
			$allPurchaseArray[$i]['data']= $data;
		}
		echo CJSON::encode($allPurchaseArray);
		
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new EbrPurchase;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		 $allShops = Utilities::getShopsList();
		if(isset($_POST['EbrPurchase']))
		{
			$model->attributes=$_POST['EbrPurchase'];
			$allShops = Utilities::getShopsListForGroup($model->group_id);
			$str = array();
			
			if(!empty($_POST['EbrPurchase']['product_id'])){
				$str = explode(',', $_POST['EbrPurchase']['product_id']);
			}
			$product = $str[0];
			$vendor = $str[1];
			$model->vendor_id= Utilities::getVendorId($vendor);
			$model->product_id=Utilities::getProductId($product);
			if($model->save()){
				EbrStock::model()->addStock($model->product_id, $model->shop_id, $model->vendor_id, $model->quantity);
				$this->redirect(array('view','id'=>$model->purchase_id));
			}
				
		}
		
		$allShops = Utilities::getShopsListForGroup($model->group_id);
		$this->render('create',array(
			'model'=>$model,
				'allShops'=>$allShops,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$invoice = $model->invoice_number;
		$models = EbrPurchase::model()->getPurchaseByInvoice($invoice);
		$updatedModels = array();
		$allShops = Utilities::getShopsListForGroup($models[0]->group_id);
		//$invoicenumber = $models[0]->invoice_number;
		foreach($models as $j=>$purchase){
			$previousQuantity[$j] = $purchase->quantity;
			$previoudProduct[$j] = $purchase->product_id;
			$previousVendor[$j] = $purchase->vendor_id;
			$previousShop[$j] = $purchase->shop_id;
			$product = EbrProducts::model()->findByPk($purchase->product_id)->product_name;
			$vendor = EbrVendor::model()->findByPk($purchase->vendor_id)->vendor_name;
			$models[$j]->product_id = $product.','.$vendor;
		}
		
		if(isset($_POST['EbrPurchase']))
		{
			if(isset($_POST['rows']) &&  !empty($_POST['rows']) && empty($_POST['formSubmit'])){
				$rowsAdd =$_POST['rows'];
				$i=count($_POST['EbrPurchase']);
				$total = $i+$rowsAdd;
				while($i<$total){
					$models[$i+1]=new EbrPurchase;
					$models[$i+1]->invoice_number = $invoice;
					$i++;
				}
					
			}else if(isset($_POST['rows']) && !empty($_POST['formSubmit']) ){
				$valid=true;
				$group = $_POST['EbrPurchase'][0]['group_id'];
				$shop = $_POST['EbrPurchase'][0]['shop_id'];
			
				$date = $_POST['EbrPurchase'][0]['invoice_date'];
				$i=0;
				foreach ($_POST['EbrPurchase'] as $j=>$sale) {
					if (isset($_POST['EbrPurchase'][$j])) {
						$updatedModels[$j]=$this->loadModel($_POST['EbrPurchase'][$j]['purchase_id']);; // if you had static model only
						$updatedModels[$j]->attributes=$sale;
						$str = array();
						$productEntered[$j] = $updatedModels[$j]->product_id;
						if(isset($models[$j]->product_id)){
							$str = explode(',',$updatedModels[$j]->product_id);
						}
						if(isset($str[0]))
							$product = $str[0];
						if(isset($str[1]))
							$vendor = $str[1];
						if(isset($vendor))
							$updatedModels[$j]->vendor_id= Utilities::getVendorId($vendor);
						if(isset($product))
							$updatedModels[$j]->product_id=Utilities::getProductId($product);
						$updatedModels[$j]->invoice_number = $invoice;
						$updatedModels[$j]->group_id=$group;
						$updatedModels[$j]->shop_id=$shop;
						$updatedModels[$j]->invoice_date=$date;
						$valid=$updatedModels[$j]->validate() && $valid;
						if($valid){
							$validModel[$i]=$updatedModels[$j];
							$i++;
						}
					}
				}
				if ($valid) {
					$i=0;
					$j=count($validModel);
					while ($i<$j) {
						$validModel[$i]->save(false);// models have already been validated
						if($previoudProduct[$i] == $updatedModels[$i]->product_id && $previousShop[$i] == $updatedModels[$i]->shop_id && $previousVendor[$i] == $updatedModels[$i]->vendor_id){
							EbrStock::model()->checkAndUpdateStockQuantity($validModel[$i]->product_id, $validModel[$i]->shop_id, $validModel[$i]->vendor_id, $validModel[$i]->quantity,$previousQuantity[$i]);
							//$valid =  EbrStock::model()->checkAndUpdateStockQuantity($updatedModels[$j]->product_id, $updatedModels[$j]->shop_id, $updatedModels[$j]->vendor_id, $updatedModels[$j]->quantity,$previousQuantity[$j]);
						}else{
							 EbrStock::model()->checkAndLessStockQuantity($previoudProduct[$i], $previousShop[$i], $previousVendor[$i], $previousQuantity[$i]);
							 EbrStock::model()->addStock($validModel[$i]->product_id, $validModel[$i]->shop_id, $validModel[$i]->vendor_id, $validModel[$i]->quantity);
						}
						$i++;
					}
					Yii::app()->user->setFlash('purchaseSuccess','Purchases edited succesfully.');
					//$this->redirect(array('view','id'=>$model->purchase_id));
					$this->redirect(array('ebrPurchase/admin'));
				}else{
					foreach ($_POST['EbrPurchase'] as $j=>$sale) {
						if (isset($_POST['EbrPurchase'][$j])) {
							$updatedModels[$j]->product_id = $productEntered[$j];
						}
					}
				}
				$models = $updatedModels;
			}
		
		}
		$this->render('multipleEdit',array('items'=>$models,
				'invoice'=>$invoice,
				'model'=>$model,
				'allShops'=>$allShops
		));
	
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		//$this->loadModel($id)->delete();
		$model=$this->loadModel($id);
		$model->purchase_deleted = 'Y';
		$model->save();
		EbrStock::model()->deleteStock($model->product_id, $model->shop_id, $model->vendor_id, $model->quantity);
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('EbrPurchase');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EbrPurchase('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EbrPurchase']))
			$model->attributes=$_GET['EbrPurchase'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionReports()
	{
		$count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM tbl_user')->queryScalar();
		$sql='SELECT id,username,password FROM tbl_user';
		$dataProvider=new CSqlDataProvider($sql, array(
				'totalItemCount'=>$count,
				'sort'=>array(
						'attributes'=>array(
								'id', 'username', 'email',
						),
				),
		
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
		
		$model=new EbrPurchase('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EbrPurchase']))
			$model->attributes=$_GET['EbrPurchase'];
	
		$this->render('reports',array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * 
	 */
	public function actionMultipleCreate() {
		$models=array();
		$model=new EbrPurchase;
		$productEntered = array();
		$allShops = array();
		$defaultGroup = Yii::app()->user->getState('defaultGroup');
		if(isset($defaultGroup))
			$allShops = Utilities::getShopsListForGroup($defaultGroup);
		$defaultShop = Yii::app()->user->getState('defaultShop');
		if(isset($_POST['EbrPurchase'][0]['group_id']) && !isset($allShops)){
		$allShops = Utilities::getShopsListForGroup($_POST['EbrPurchase'][0]['group_id']);
		}
		// since you know how many models
		if (!isset($_POST['EbrPurchase'])){
		$i=0;
		while($i<Constants::$purchase_rows) {
			$models[$i]=new EbrPurchase;
			$models[$i]->group_id = $defaultGroup;
			$models[$i]->shop_id = $defaultShop;
			$i++;
			}
		}else{
		foreach ($_POST['EbrPurchase'] as $j=>$purchase) {
					if (isset($_POST['EbrPurchase'][$j])) {
						$models[$j]=new EbrPurchase; // if you had static model only
						$models[$j]->attributes=$purchase;
					}
				}
		}
		
		if (isset($_POST['EbrPurchase'])) {
			if(isset($_POST['rows']) &&  !empty($_POST['rows']) && empty($_POST['formSubmit'])){
				$rowsAdd =$_POST['rows'];
				$j=count($_POST['EbrPurchase']);
				$total = $j+$rowsAdd;
				while($j<$total){
					$models[$j]=new EbrPurchase;
					$j++;
				}
				
			}else if(isset($_POST['rows']) && !empty($_POST['formSubmit']) ){
				$valid=true;
				$group = $_POST['EbrPurchase'][0]['group_id'];
				$shop = $_POST['EbrPurchase'][0]['shop_id'];
				$invoice = $_POST['EbrPurchase'][0]['invoice_number'];
				$date = $_POST['EbrPurchase'][0]['invoice_date'];
				$deleted = array();
				if(!empty($_POST['deletedRows'])){
					$deleted = explode(',', $_POST['deletedRows']);
				}
				$i=0;
				foreach ($_POST['EbrPurchase'] as $j=>$purchase) {
					if (isset($_POST['EbrPurchase'][$j])) {
						if(!in_array($j,$deleted)){
						
						$models[$j]=new EbrPurchase; // if you had static model only
						$models[$j]->attributes=$purchase;
						$str = array();
						$productEntered[$j] = $models[$j]->product_id;
						if(isset($models[$j]->product_id)){
							$str = explode(',',$models[$j]->product_id);
						}
						if(isset($str[0]))
						$product = $str[0];
						if(isset($str[1]))
						$vendor = $str[1];
						if(isset($vendor))
						$models[$j]->vendor_id= Utilities::getVendorId($vendor);
						if(isset($product))
						$models[$j]->product_id=Utilities::getProductId($product);
						$models[$j]->group_id=$group;
						$models[$j]->shop_id=$shop;
						$models[$j]->invoice_number= $invoice;
						$models[$j]->invoice_date= $date;
						$valid=$models[$j]->validate() && $valid;
						if($valid){
						$validModel[$i]=$models[$j];
						$i++;
						}
					}
				}
				}
				if ($valid) {
					$i=0;
					$j=count($validModel);
					while ($i<$j) {
						$validModel[$i]->save(false);// models have already been validated
						EbrStock::model()->addStock($validModel[$i]->product_id, $validModel[$i]->shop_id, $validModel[$i]->vendor_id, $validModel[$i]->quantity);
						$i++;
					}
					// anything else that you want to do, for example a redirect to admin page
					Yii::app()->user->setFlash('purchaseSuccess','Purchases created succesfully.');
					//$this->redirect(array('view','id'=>$model->purchase_id));
					$this->redirect(array('ebrPurchase/admin'));
				}else{
					foreach ($_POST['EbrPurchase'] as $j=>$sale) {
						if (isset($_POST['EbrPurchase'][$j])) {
							if(!in_array($j,$deleted)){
								$models[$j]->product_id = $productEntered[$j];
	
							}
						}
					}
				}
			}
			
		}
		
		$this->render('multipleCreate',array('items'=>$models,
											'model'=>$model,
				'allShops'=>$allShops
		));
	}
	
	
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EbrPurchase the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EbrPurchase::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EbrPurchase $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ebr-purchase-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
