<?php
class Utilities {
	
	static $vendorsList = array();
	static $productsList = array();
	static $clientsList = array();
	
	static function getProductsList() {
		//$products = Constants::$product_list;
		$products = EbrProducts::model ()->findAll();
		for($i = 1; $i <= count ( $products ); $i ++) {
			$allProducts [$i] ['product_id'] = $i;
			$allProducts [$i] ['product_name'] = $products [$i];
		}
		return CHtml::listData ( $allProducts, 'product_name', 'product_name' );
	}
	
	static function getLookupTypeList() {
		$lookup = LookupConstants::$lookup_list;
		for($i = 1; $i <= count ( $lookup ); $i ++) {
			$lookupList [$i] ['lookup_id'] = $i;
			$lookupList [$i] ['lookup_name'] = $lookup [$i];
		}
		return CHtml::listData ( $lookupList, 'lookup_id', 'lookup_name' );
	}
	
	static function getLookupListById($id) {
		return CHtml::listData(EbrLookup::model()->findAllByAttributes(
					array(
							'lookup_number'=>$id
					)), 'lookup_id','lookup_name');
	}
	
	static function getRolesList() {
		$roles = Constants::$role_list;
		for($i = 1; $i <= count ( $roles ); $i ++) {
			$allRoles[$i] ['role_name'] = $roles[$i];
		}
		return CHtml::listData ( $allRoles, 'role_name', 'role_name' );
	}
	
	static function getShopsList() {
		return CHtml::listData ( EbrShop::model ()->findAll ( "shop_deleted='N'" ), 'shop_id', 'shop_name' );
	}
	
	static function getShopsListForGroup($groupId) {
		return CHtml::listData(EbrShop::model()->findAllByAttributes(
					array(
							'shop_deleted'=>array('N'),
							'group_id'=>$groupId
					)), 'shop_id','shop_name');
	}
	
	static function getGroupsList(){
		return CHtml::listData ( EbrGroup::model ()->findAll ( "group_deleted='N'" ), 'group_id', 'group_name' );
	}
	
	static function getVendorsList(){
		return CHtml::listData ( EbrVendor::model ()->findAll ( "vendor_deleted='N'" ), 'vendor_id', 'vendor_name' );
	}
	static function getCriteriaForProductsList() {
		$criteria_list = Constants::$criteria_list_products;
		for($i = 1; $i <= count ( $criteria_list ); $i ++) {
			$criteria [$i] ['criteria_id'] = $i;
			$criteria [$i] ['criteria'] = $criteria_list [$i];
		}
		return CHtml::listData ( $criteria, 'criteria', 'criteria' );
	}
	
	static function getCriteriaForSalesList() {
		$criteria_list = Constants::$criteria_list_sales;
		for($i = 1; $i <= count ( $criteria_list ); $i ++) {
			$criteria [$i] ['criteria_id'] = $i;
			$criteria [$i] ['criteria'] = $criteria_list [$i];
		}
		return CHtml::listData ( $criteria, 'criteria', 'criteria' );
	}
	
		
	static function getVendorId($vendorName){
		if(empty(self::$vendorsList)){
		$allVendors= EbrVendor::model()->findAll();
		foreach($allVendors as $i=>$vendor){
			self::$vendorsList[$vendor->vendor_name]= $vendor->vendor_id;
		}
		}
		if(isset(self::$vendorsList[$vendorName]))
		return self::$vendorsList[$vendorName];
		else
		return '';
	}
	
	static function getClient($clientName){
		if(empty(self::$clientsList)){
			$allClients= EbrClient::model()->findAll();
			foreach($allClients as $i=>$client){
				self::$clientsList[$client->client_name] = $client->client_id;
			}
		}
		if(isset(self::$clientsList[$clientName]))
			return self::$clientsList[$clientName];
		else
			return '';
	}
	
	static function getProductId($productName){
		if(empty(self::$productsList)){
			$allPros= EbrProducts::model()->findAll();
			foreach($allPros as $i=>$product){
				self::$productsList[$product->product_name]= $product->product_id;
			}
		}
		if(isset(self::$productsList[$productName]))
			return self::$productsList[$productName];
		else
			return '';
	}
}
