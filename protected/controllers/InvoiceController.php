<?php

class InvoiceController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionInvoiceNumber($invoiceNumber)
	{
		$sales = EbrSales::model()->getSalesByInvoice($invoiceNumber);
		
		$this->render('invoiceNumber',array(
				'invoice'=>$invoiceNumber,
				'sales'=>$sales,
				));
	}

	public function actionSearch()
	{
		$invoice = '';
		$sales = array();
		if(isset($_POST['invoice']))
		{
		$invoice = $_POST['invoice'];
		$sales = EbrSales::model()->getSalesByInvoice($invoice);
		}
		$this->render('search',array(
				'invoice'=>$invoice,
				'sales'=>$sales,
				
		));
	}
	
	public function actionPrint($invoice){
		$sales = EbrSales::model()->getSalesByInvoice($invoice);
		$this->renderPartial('print',array(
				'invoice'=>$invoice,
				'sales'=>$sales,
		
		));
	}

	// Uncomment the following methods and override them if needed
	
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
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
						'actions'=>array('index','search','invoiceNumber','print'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
							'actions'=>array('index','search','invoiceNumber','print'),
						'roles'=>array('admin','general'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}
	

	
	
}