<?php

class EbrSalesController extends Controller
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
				'actions'=>array('create','update','multipleCreate','multipleEdit','edit'),
				'roles'=>array('admin','general'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array('admin','general'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new EbrSales;
		$invoicenumber = $model->getInvoiceNumber();
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$allShops =  array();
		if(isset($_POST['EbrSales']))
		{
			$model->attributes=$_POST['EbrSales'];
			$model->invoice_number = $invoicenumber;
			$allShops = Utilities::getShopsListForGroup($model->group_id);
			$str = array();
				
			if(!empty($_POST['EbrSales']['product_id'])){
				$str = explode(',', $_POST['EbrSales']['product_id']);
			}
			$product = $str[0];
			$vendor = $str[1];
			$model->vendor_id= Utilities::getVendorId($vendor);
			$model->product_id=Utilities::getProductId($product);
			$model->client_id=Utilities::getClient($model->client_id);
			
			if($model->validate()){
				$valid =  EbrStock::model()->checkAndLessStock($model->product_id, $model->shop_id, $model->vendor_id, $model->quantity);
				if($valid == 'quantityFail'){
					//$model->addErrors('Invalid Quantity');
					$model->addError('quantity', 'Quantity not available.');
				}else{
					$model->save(false);
					$this->redirect(array('view','id'=>$model->sale_id));
				}
				
			}
		}
		$model->invoice_number = $model->getInvoiceNumber();
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
		$models = EbrSales::model()->getSalesByInvoice($model->invoice_number);
		$updatedModels = array();
		$allShops = Utilities::getShopsListForGroup($models[0]->group_id);
		//$invoicenumber = $models[0]->invoice_number;
		foreach($models as $j=>$sale){
			$previousQuantity[$j] = $sale->quantity;
			$previoudProduct[$j] = $sale->product_id;
			$previousVendor[$j] = $sale->vendor_id;
			$previousShop[$j] = $sale->shop_id;
			$product = EbrProducts::model()->findByPk($sale->product_id)->product_name;
			$vendor = EbrVendor::model()->findByPk($sale->vendor_id)->vendor_name;
			$models[$j]->client_id = EbrClient::model()->findByPk($sale->client_id)->client_name;
			$models[$j]->product_id = $product.','.$vendor;
		}
		
		if(isset($_POST['EbrSales']))
		{
			if(isset($_POST['rows']) &&  !empty($_POST['rows']) && empty($_POST['formSubmit'])){
				$rowsAdd =$_POST['rows'];
				$i=count($_POST['EbrSales']);
				$total = $i+$rowsAdd;
				while($i<$total){
					$models[$i+1]=new EbrSales;
					$models[$i+1]->invoice_number = $invoice;
					$i++;
				}
			
			}else if(isset($_POST['rows']) && !empty($_POST['formSubmit']) ){
				$valid=true;
				$valid2=true;
				$valid3 = true;
				$group = $_POST['EbrSales'][0]['group_id'];
				$shop = $_POST['EbrSales'][0]['shop_id'];
				$client = '';
				if($_POST['EbrSales'][0]['client_id'])
					$client=Utilities::getClient($_POST['EbrSales'][0]['client_id']);
				
				$date = $_POST['EbrSales'][0]['sales_date'];
				$i=0;
				foreach ($_POST['EbrSales'] as $j=>$sale) {
					if (isset($_POST['EbrSales'][$j])) {
						$updatedModels[$j]=$this->loadModel($_POST['EbrSales'][$j]['sale_id']);; // if you had static model only
						$updatedModels[$j]->attributes=$sale;
						$str = array();
						$productEntered[$j] = $updatedModels[$j]->product_id;
						$clientEntered[$j] = $updatedModels[$j]->client_id;
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
						$updatedModels[$j]->client_id=$client;
						$updatedModels[$j]->sales_date=$date;
						$valid=$updatedModels[$j]->validate() && $valid;
						if($valid){
							if($previoudProduct[$j] == $updatedModels[$j]->product_id && $previousShop[$j] == $updatedModels[$j]->shop_id && $previousVendor[$j] == $updatedModels[$j]->vendor_id){
								$valid =  EbrStock::model()->checkAndUpdateStock($updatedModels[$j]->product_id, $updatedModels[$j]->shop_id, $updatedModels[$j]->vendor_id, $updatedModels[$j]->quantity,$previousQuantity[$j]);
								if($valid == 'quantityFail'){
									//$model->addErrors('Invalid Quantity');
									$valid2 = false;
									$updatedModels[$j]->addError('quantity', 'Quantity not available');
								}
							}else{
									
								$valid =  EbrStock::model()->checkAndLessStock($updatedModels[$j]->product_id, $updatedModels[$j]->shop_id, $updatedModels[$j]->vendor_id, $updatedModels[$j]->quantity);
								if($valid == 'quantityFail'){
									//$model->addErrors('Invalid Quantity');
									$valid2 = false;
									$updatedModels[$j]->addError('quantity', 'Quantity not available');
								}else{
									EbrStock::model()->addStockandLessSale($previoudProduct[$j], $previousShop[$j], $previousVendor[$j], $previousQuantity[$j]);
								}
							}
							
						}
						if($valid && $valid2){
							$validModel[$i]=$updatedModels[$j];
							$i++;
						}
					}
				}
				if ($valid && $valid2) {
					$i=0;
					$j=count($validModel);
					while ($i<$j) {
						$validModel[$i]->save(false);// models have already been validated
						$i++;
					}
					// anything else that you want to do, for example a redirect to admin page
					Yii::app()->user->setFlash('printInvoice','Sales created succesfully with Invoice Number'.$invoice);
					$this->redirect(array('invoice/invoiceNumber','invoiceNumber'=>$invoice));
						
				}else{
					foreach ($_POST['EbrSales'] as $j=>$sale) {
						if (isset($_POST['EbrSales'][$j])) {
							
								$updatedModels[$j]->product_id = $productEntered[$j];
								$updatedModels[$j]->client_id = $clientEntered[$j];
							
						}
					}
				}
				
				$models = $updatedModels;
			}
				
				
// 			if($model->validate()){
// 				if($previoudProduct == $model->product_id && $previousShop == $model->shop_id && $previousVendor == $model->vendor_id){
// 				$valid =  EbrStock::model()->checkAndUpdateStock($model->product_id, $model->shop_id, $model->vendor_id, $model->quantity,$previousQuantity);
// 				if($valid == 'quantityFail'){
// 					//$model->addErrors('Invalid Quantity');
// 					$model->addError('quantity', 'Quantity not available');
// 				}else{
// 					$model->save(false);
// 					$this->redirect(array('view','id'=>$model->sale_id));
// 				}
// 				}else{
					
// 					$valid =  EbrStock::model()->checkAndLessStock($model->product_id, $model->shop_id, $model->vendor_id, $model->quantity);
// 					if($valid == 'quantityFail'){
// 						//$model->addErrors('Invalid Quantity');
// 						$model->addError('quantity', 'Quantity not available');
// 					}else{
// 						$model->save(false);
// 						EbrStock::model()->addStockandLessSale($previoudProduct, $previousShop, $previousVendor, $previousQuantity);
// 						$this->redirect(array('view','id'=>$model->sale_id));
// 					}
// 				}
// 			}
			
				
		}
// 		$product = EbrProducts::model()->findByPk($model->product_id)->product_name;
// 		$vendor = EbrVendor::model()->findByPk($model->vendor_id)->vendor_name;
// 		$model->client_id = EbrClient::model()->findByPk($model->client_id)->client_name;
// 		$model->product_id = $product.','.$vendor;
// 		$allShops = Utilities::getShopsListForGroup($model->group_id);
// 		$this->render('update',array(
// 				'model'=>$model,
// 				'allShops'=>$allShops,
// 		));
		
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
		
		$model->sales_deleted = 'Y';
		
		$model->save();
		EbrStock::model()->addDeletedStock($model->product_id, $model->shop_id, $model->vendor_id, $model->quantity);

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('EbrSales');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EbrSales('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EbrSales']))
			$model->attributes=$_GET['EbrSales'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EbrSales the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EbrSales::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EbrSales $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ebr-sales-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	/**
	 * 
	 */
	public function actionMultipleCreate() {
		$models=array();
		$model=new EbrSales;
		$productEntered = array();
		$vendorEntered = array();
		$invoicenumber = $model->getInvoiceNumber();
		if(isset($_POST['EbrSales'][0]['group_id'])){
			$allShops = Utilities::getShopsListForGroup($_POST['EbrSales'][0]['group_id']);
		}else {
			$allShops = array();
		}
		// since you know how many models
		if (!isset($_POST['EbrSales'])){
			// since you know how many models
			$i=0;
			while($i<1) {
				$models[$i]=new EbrSales;
				$models[$i]->invoice_number = $invoicenumber;
				$i++;
				// you can also allocate memory for the model with `new Modelname` instead
				// of assigning the static model
			}
		}else{
			foreach ($_POST['EbrSales'] as $j=>$sale) {
				if (isset($_POST['EbrSales'][$j])) {
					$models[$j]=new EbrSales; // if you had static model only
					$models[$j]->attributes=$sale;
					$models[$j]->invoice_number = $invoicenumber;
				}
			}
		}
	
	
	
		if (isset($_POST['EbrSales'])) {
			if(isset($_POST['rows']) &&  !empty($_POST['rows']) && empty($_POST['formSubmit'])){
				$rowsAdd =$_POST['rows'];
				$i=count($_POST['EbrSales']);
				$total = $i+$rowsAdd;
				while($i<$total){
					$models[$i+1]=new EbrSales;
					$models[$i+1]->invoice_number = $invoicenumber;
					$i++;
				}
	
			}else if(isset($_POST['rows']) && !empty($_POST['formSubmit']) ){
				$valid=true;
				$valid2=true;
				$group = $_POST['EbrSales'][0]['group_id'];
				$shop = $_POST['EbrSales'][0]['shop_id'];
				$client = '';
				if($_POST['EbrSales'][0]['client_id'])
					$client=Utilities::getClient($_POST['EbrSales'][0]['client_id']);
				
				$date = $_POST['EbrSales'][0]['sales_date'];
				$deleted = array();
				if(!empty($_POST['deletedRows'])){
					$deleted = explode(',', $_POST['deletedRows']);
				}
				$i=0;
				foreach ($_POST['EbrSales'] as $j=>$sale) {
					if (isset($_POST['EbrSales'][$j])) {
						if(!in_array($j,$deleted)){
							$models[$j]=new EbrSales; // if you had static model only
							$models[$j]->attributes=$sale;
							$str = array();
							$productEntered[$j] = $models[$j]->product_id;
							$vendorEntered[$j] = $models[$j]->client_id;
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
							$models[$j]->invoice_number = $invoicenumber;
							$models[$j]->group_id=$group;
							$models[$j]->shop_id=$shop;
							$models[$j]->client_id=$client;
							$models[$j]->sales_date=$date;
							$valid=$models[$j]->validate() && $valid;
							if($valid){
							$valid1 =  EbrStock::model()->checkAndLessStock($models[$j]->product_id, $models[$j]->shop_id, $models[$j]->vendor_id, $models[$j]->quantity);
							if($valid1 == 'quantityFail'){
								$valid2 = false;
								$models[$j]->addError('quantity', 'Quantity not available.');
								}
							}
							if($valid && $valid2){
								$validModel[$i]=$models[$j];
								$i++;
							}
						}
					}
				}
				if ($valid && $valid2) {
					$i=0;
					$j=count($validModel);
					while ($i<$j) {
						$validModel[$i]->save(false);// models have already been validated
						$i++;
					}
					// anything else that you want to do, for example a redirect to admin page
					Yii::app()->user->setFlash('printInvoice','Sales created succesfully with Invoice Number'.$invoicenumber);
					$this->redirect(array('invoice/invoiceNumber','invoiceNumber'=>$invoicenumber));
					
				}else{
					foreach ($_POST['EbrSales'] as $j=>$sale) {
						if (isset($_POST['EbrSales'][$j])) {
							if(!in_array($j,$deleted)){
								$models[$j]->product_id = $productEntered[$j];
								 $models[$j]->client_id = $vendorEntered[$j];
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
	
	
	public function actionEdit(){
		
		$invoice = '';
		$model=new EbrSales;
		$allShops = array();
		$models = array();
		if(isset($_POST['invoice']))
		{
			$invoice = $_POST['invoice'];
			$models = EbrSales::model()->getSalesByInvoice($invoice);
			$allShops = Utilities::getShopsListForGroup($models[0]->group_id);
			//$invoicenumber = $models[0]->invoice_number;
			foreach($models as $j=>$sale){
				$product = EbrProducts::model()->findByPk($sale->product_id)->product_name;
				$vendor = EbrVendor::model()->findByPk($sale->vendor_id)->vendor_name;
				$models[$j]->client_id = EbrClient::model()->findByPk($sale->client_id)->client_name;
				$models[$j]->product_id = $product.','.$vendor;
			}
		}
		if (isset($_POST['EbrSales'])) {
			if(isset($_POST['rows']) &&  !empty($_POST['rows']) && empty($_POST['formSubmit'])){
				$rowsAdd =$_POST['rows'];
				$i=count($_POST['EbrSales']);
				$total = $i+$rowsAdd;
				while($i<$total){
					$models[$i+1]=new EbrSales;
					$models[$i+1]->invoice_number = $invoice;
					$i++;
				}
		
			}else if(isset($_POST['rows']) && !empty($_POST['formSubmit']) ){
				$valid=true;
				$valid2=true;
				$group = $_POST['EbrSales'][0]['group_id'];
				$shop = $_POST['EbrSales'][0]['shop_id'];
				$client = '';
				if($_POST['EbrSales'][0]['client_id'])
					$client=Utilities::getClient($_POST['EbrSales'][0]['client_id']);
		
				$date = $_POST['EbrSales'][0]['sales_date'];
				$deleted = array();
				if(!empty($_POST['deletedRows'])){
					$deleted = explode(',', $_POST['deletedRows']);
				}
				$i=0;
				foreach ($_POST['EbrSales'] as $j=>$sale) {
					if (isset($_POST['EbrSales'][$j])) {
						if(!in_array($j,$deleted)){
							$models[$j]=new EbrSales; // if you had static model only
							$models[$j]->attributes=$sale;
							$str = array();
							$productEntered[$j] = $models[$j]->product_id;
							$vendorEntered[$j] = $models[$j]->client_id;
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
							$models[$j]->invoice_number = $invoice;
							$models[$j]->group_id=$group;
							$models[$j]->shop_id=$shop;
							$models[$j]->client_id=$client;
							$models[$j]->sales_date=$date;
							$valid=$models[$j]->validate() && $valid;
							if($valid){
								$valid1 =  EbrStock::model()->checkAndLessStock($models[$j]->product_id, $models[$j]->shop_id, $models[$j]->vendor_id, $models[$j]->quantity);
								if($valid1 == 'quantityFail'){
									$valid2 = false;
									$models[$j]->addError('quantity', 'Quantity not available.');
								}
							}
							if($valid && $valid2){
								$validModel[$i]=$models[$j];
								$i++;
							}
						}
					}
				}
				if ($valid && $valid2) {
					$i=0;
					$j=count($validModel);
					while ($i<$j) {
						$validModel[$i]->save(false);// models have already been validated
						$i++;
					}
					// anything else that you want to do, for example a redirect to admin page
					Yii::app()->user->setFlash('printInvoice','Sales created succesfully with Invoice Number'.$invoicenumber);
					$this->redirect(array('invoice/invoiceNumber','invoiceNumber'=>$invoicenumber));
		
				}else{
					foreach ($_POST['EbrSales'] as $j=>$sale) {
						if (isset($_POST['EbrSales'][$j])) {
							if(!in_array($j,$deleted)){
								$models[$j]->product_id = $productEntered[$j];
								$models[$j]->client_id = $vendorEntered[$j];
							}
						}
					}
				}
			}
		
		}
		$this->render('multipleEdit',array('items'=>$models,
				'invoice'=>$invoice,
				'model'=>$model,
				'allShops'=>$allShops
		));
	}
	
	/**
	 *
	 */
	public function actionMultipleEdit() {
		$models=array();
		$model=new EbrSales;
		$productEntered = array();
		$vendorEntered = array();
		$invoicenumber = $model->getInvoiceNumber();
		if(isset($_POST['EbrSales'][0]['group_id'])){
			$allShops = Utilities::getShopsListForGroup($_POST['EbrSales'][0]['group_id']);
		}else {
			$allShops = array();
		}
		// since you know how many models
		if (!isset($_POST['EbrSales'])){
			// since you know how many models
			$i=0;
			while($i<1) {
				$models[$i]=new EbrSales;
				$models[$i]->invoice_number = $invoicenumber;
				$i++;
				// you can also allocate memory for the model with `new Modelname` instead
				// of assigning the static model
			}
		}else{
			foreach ($_POST['EbrSales'] as $j=>$sale) {
				if (isset($_POST['EbrSales'][$j])) {
					$models[$j]=new EbrSales; // if you had static model only
					$models[$j]->attributes=$sale;
					$models[$j]->invoice_number = $invoicenumber;
				}
			}
		}
	
	
	
			}
	
}
