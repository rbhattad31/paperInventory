<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-latest.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/script.js"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		
	</div><!-- header -->

<!-- 	<div id="mainmenu"> -->
		<?php
// 		 $this->widget('zii.widgets.CMenu',array(
// 			'items'=>array(
// 				array('label'=>'Home', 'url'=>array('/site/index')),
// 				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
// 				array('label'=>'Contact', 'url'=>array('/site/contact')),
// 				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
// 				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
// 			),
// 		)); ?>
	<!--</div> mainmenu -->
	<div id='cssmenu'>
<ul>
   <li class='active'><a href='<?php echo $this->createUrl('site/index')?>'><span>Home</span></a></li>
   <?php if(Yii::app()->user->getState('role') == 'admin'){?>
   <li class='has-sub'><a href='#'><span>Admin</span></a>
   <ul>
   <li class='has-sub'><a href='#'><span>Groups</span></a>
      <ul>
          <li><a href='<?php echo $this->createUrl('ebrGroup/create')?>'><span>Create Group</span></a></li>
           <li><a href='<?php echo $this->createUrl('ebrGroup/index')?>'><span>View Groups</span></a></li>
           <li class='last'><a href='<?php echo $this->createUrl('ebrGroup/admin')?>'><span>Search Groups</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Vendors</span></a>
      <ul>
          <li><a href='<?php echo $this->createUrl('ebrVendor/create')?>'><span>Create Vendor</span></a></li>
           <li><a href='<?php echo $this->createUrl('ebrVendor/index')?>'><span>View Vendors</span></a></li>
      		<li class='last'><a href='<?php echo $this->createUrl('ebrVendor/admin')?>'><span>Search Vendors</span></a></li>
      </ul>
   </li>
    <li class='has-sub'><a href='#'><span>Products</span></a>
      <ul>
         
          <li><a href='<?php echo $this->createUrl('ebrProducts/create')?>'><span>Create Products</span></a></li>
           <li><a href='<?php echo $this->createUrl('ebrProducts/index')?>'><span>View Products</span></a></li>
           <li class='last'><a href='<?php echo $this->createUrl('ebrProducts/admin')?>'><span>Search Products</span></a></li>
      </ul>
   </li>
  
   <li class='has-sub'><a href='#'><span>Shops</span></a>
      <ul>
         
          <li><a href='<?php echo $this->createUrl('ebrShop/create')?>'><span>Create Shop</span></a></li>
           <li><a href='<?php echo $this->createUrl('ebrShop/index')?>'><span>View Shops</span></a></li>
           <li class='last'><a href='<?php echo $this->createUrl('ebrShop/admin')?>'><span>Search Shops</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Clients</span></a>
      <ul>
         
          <li><a href='<?php echo $this->createUrl('ebrClient/create')?>'><span>Create Clients</span></a></li>
           <li><a href='<?php echo $this->createUrl('ebrClient/index')?>'><span>View Clients</span></a></li>
           <li class='last'><a href='<?php echo $this->createUrl('ebrClient/admin')?>'><span>Search Clients</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Look Up</span></a>
      <ul>
          <li><a href='<?php echo $this->createUrl('ebrLookup/create')?>'><span>Create Lookup</span></a></li>
           <li><a href='<?php echo $this->createUrl('ebrLookup/index')?>'><span>View Lookup</span></a></li>
      		<li class='last'><a href='<?php echo $this->createUrl('ebrLookup/admin')?>'><span>Search Lookup</span></a></li>
      </ul>
   </li>
   
   <li class='has-sub'><a href='#'><span>Users</span></a>
      <ul>
          <li><a href='<?php echo $this->createUrl('ebrUser/create')?>'><span>Create User</span></a></li>
           <li><a href='<?php echo $this->createUrl('ebrUser/index')?>'><span>View Users</span></a></li>
      		<li class='last'><a href='<?php echo $this->createUrl('ebrUser/admin')?>'><span>Search Users</span></a></li>
      </ul>
   </li>
   
   </ul>
   </li>
   <?php }?>
   <li class='has-sub'><a href='#'><span>Purchases</span></a>
      <ul>
         
         <li class='last'><a href='<?php echo $this->createUrl('ebrPurchase/multipleCreate')?>'><span>Create Purchases</span></a></li>
         <li ><a href='<?php echo $this->createUrl('ebrPurchase/index')?>'><span>View Purchases</span></a></li>
         <li class='last'><a href='<?php echo $this->createUrl('ebrPurchase/admin')?>'><span>Search Purchases</span></a></li>
      </ul>
   </li>
   
   <li class='has-sub'><a href='#'><span>Sales</span></a>
   <ul>
         
         <li><a href='<?php echo $this->createUrl('ebrSales/multipleCreate')?>'><span>Create Sales</span></a></li>
         <li><a href='<?php echo $this->createUrl('ebrSales/index')?>'><span>View Sales</span></a></li>
          <li><a href='<?php echo $this->createUrl('ebrSales/edit')?>'><span>Edit Sales</span></a></li>
         <li class='last'><a href='<?php echo $this->createUrl('ebrSales/admin')?>'><span>Search Sales</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Stock</span></a>
   <ul>       
         <li class='last'><a href='<?php echo $this->createUrl('stock/search')?>'><span>Search Stocks</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Invoices</span></a>
   <ul>       
         <li class='last'><a href='<?php echo $this->createUrl('invoice/search')?>'><span>Search Invoice</span></a></li>
         
      </ul>
   </li>
  
   <li class='has-sub'><a href='#'><span>Reports</span></a>
   
   <ul>
         <li><a href='<?php echo $this->createUrl('ebrGroup/reports')?>'><span>Groups</span></a></li>
          <li><a href='<?php echo $this->createUrl('ebrVendor/reports')?>'><span>Vendors</span></a></li>
           <li><a href='<?php echo $this->createUrl('ebrShop/reports')?>'><span>Shops</span></a></li>
           <li class='has-sub'><a href='#'><span>Purchases</span></a>
           <ul>
            <li><a href='<?php echo $this->createUrl('reports/allPurchases')?>'><span>Complete Report</span></a></li>
           <li class='last'><a href='<?php echo $this->createUrl('reports/dataTablePurchases')?>'><span>Product Report</span></a></li>
           </ul>
           </li>
           <li class='has-sub'><a href='#'><span>Sales</span></a>
           <ul>
            <li><a href='<?php echo $this->createUrl('reports/allSales')?>'><span>Complete Report</span></a></li>
           <li class='last'><a href='<?php echo $this->createUrl('reports/dataTableSales')?>'><span>Product Report</span></a></li>
           </ul>
           
           </li>
      </ul>
   </li>
    <?php if(Yii::app()->user->isGuest){?>
   <li class='last'><a href='<?php echo $this->createUrl('site/login')?>'><span>Log In</span></a></li>
   <?php }?>
   <?php if(!Yii::app()->user->isGuest){?>
   <li class='last'><a href='<?php echo $this->createUrl('site/logout')?>'><span>Log Out</span></a></li>
   <?php }?>
</ul>
</div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Bradsol.<br/>
		All Rights Reserved.<br/>
		
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
