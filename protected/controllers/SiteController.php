<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$model=new LoginForm;
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		
		$this->render('index',array('model'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionCreateRoles(){
		$auth=Yii::app()->authManager;
		$role=$auth->createRole('admin');
		$role=$auth->createRole('general');
		$this->render('index');
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
		
		$user = Yii::app()->user->id;
		

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		if(isset($user)){
			$this->render('index',array('model'=>$model));
		}else
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionSuggestVendors(){
		if(isset($_GET['term']) && ($keyword=trim($_GET['term']))!=='')
		{
			$tags=EbrVendor::model()->suggestVendors($keyword);
			foreach ($tags as $i=>$vendor){
				//$items[$i]['vendor_id']=$vendor->vendor_id;
				$items[$i]=$vendor->vendor_name;
			}
			echo CJSON::encode($items);
				
		}
	}
	
	public function actionSuggestProducts(){
		if(isset($_GET['term']) && ($keyword=trim($_GET['term']))!=='')
		{
			$tags=EbrProducts::model()->suggestProducts($keyword);
			foreach ($tags as $i=>$product){
				//$items[$i]['vendor_id']=$vendor->vendor_id;
				$items[$i]=$product->product_name;
			}
			echo CJSON::encode($items);
				
		}
	}
	
	public function actionSuggestProductsAndVendors(){
		if(isset($_GET['term']) && ($keyword=trim($_GET['term']))!=='')
		{
			$tags=EbrProducts::model()->suggestProducts($keyword);
			foreach ($tags as $i=>$product){
				//$items[$i]['vendor_id']=$vendor->vendor_id;
				$items[$i]['label']=$product->product_name.','.$product->vendor->vendor_name;
				$items[$i]['value']=$product->product_name.','.$product->vendor->vendor_name;
				$items[$i]['units_price']=$product->unit_price;
				$items[$i]['sales_price']=$product->sale_price;
				$items[$i]['units']=$product->unitLookup->lookup_name;
			}
			echo CJSON::encode($items);
	
		}
	}
	
	public function actionSuggestClients(){
		if(isset($_GET['term']) && ($keyword=trim($_GET['term']))!=='')
		{
			$tags=EbrClient::model()->suggestClients($keyword);
			foreach ($tags as $i=>$client){
				//$items[$i]['vendor_id']=$vendor->vendor_id;
				$items[$i]=$client->client_name;
			}
			echo CJSON::encode($items);
	
		}
	}
	
	public function actionShops(){
		if (isset($_POST['groupId'])) {
			$shops= EbrShop::model()->findAllByAttributes(
					array(
							'shop_deleted'=>array('N'),
							'group_id'=>array($_POST['groupId'])
					));
				
		}
		foreach ($shops as $i=>$shop){
			$items[$i]['key']=$shop->shop_id;
			$items[$i]['value']=$shop->shop_name;
		}
		echo CJSON::encode($shops);
	}
	
	
}