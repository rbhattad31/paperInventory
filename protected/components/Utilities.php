<?php
class Utilities {
	
	static $vendorsList = array();
	static $productsList = array();
	static $clientsList = array();
	
	
	/**
	 * 
	 * @return Ambigous <mixed, multitype:unknown mixed , multitype:unknown , string, unknown>
	 */
	static function getLookupTypeList() {
		$lookup = LookupConstants::$lookup_list;
		for($i = 1; $i <= count ( $lookup ); $i ++) {
			$lookupList [$i] ['lookup_id'] = $i;
			$lookupList [$i] ['lookup_name'] = $lookup [$i];
		}
		return CHtml::listData ( $lookupList, 'lookup_id', 'lookup_name' );
	}
	
	/**
	 * 
	 * @param unknown $id
	 * @return Ambigous <mixed, multitype:unknown mixed , multitype:unknown , string, unknown>
	 */
	static function getLookupListById($id) {
		return CHtml::listData(EbrLookup::model()->findAllByAttributes(
					array(
							'lookup_number'=>$id
					)), 'lookup_id','lookup_name');
	}
	
	/**
	 * 
	 * @return Ambigous <mixed, multitype:unknown mixed , multitype:unknown , string, unknown>
	 */
	static function getRoles() {
		return CHtml::listData(EbrLookup::model()->findAllByAttributes(
				array(
						'lookup_number'=>LookupConstants::$ROLES_LOOKUP_NUMBER
				)), 'lookup_name','lookup_name');
	}
	
	/**
	 * 
	 * @return Ambigous <mixed, multitype:unknown mixed , multitype:unknown , string, unknown>
	 */
	static function getShopsList() {
		return CHtml::listData ( EbrShop::model ()->findAll ( "shop_deleted='N'" ), 'shop_id', 'shop_name' );
	}
	
	/**
	 * 
	 * @param unknown $groupId
	 * @return Ambigous <mixed, multitype:unknown mixed , multitype:unknown , string, unknown>
	 */
	static function getShopsListForGroup($groupId) {
		return CHtml::listData(EbrShop::model()->findAllByAttributes(
					array(
							'shop_deleted'=>array('N'),
							'group_id'=>$groupId
					)), 'shop_id','shop_name');
	}
	
	/**
	 * 
	 * @return Ambigous <mixed, multitype:unknown mixed , multitype:unknown , string, unknown>
	 */
	static function getGroupsList(){
		return CHtml::listData ( EbrGroup::model ()->findAll ( "group_deleted='N'" ), 'group_id', 'group_name' );
	}
	
	/**
	 * 
	 * @return Ambigous <mixed, multitype:unknown mixed , multitype:unknown , string, unknown>
	 */
	static function getVendorsList(){
		return CHtml::listData ( EbrVendor::model ()->findAll ( "vendor_deleted='N'" ), 'vendor_id', 'vendor_name' );
	}
	
	/**
	 * 
	 * @return Ambigous <mixed, multitype:unknown mixed , multitype:unknown , string, unknown>
	 */
	static function getCriteriaForProductsList() {
		$criteria_list = Constants::$criteria_list_products;
		for($i = 1; $i <= count ( $criteria_list ); $i ++) {
			$criteria [$i] ['criteria_id'] = $i;
			$criteria [$i] ['criteria'] = $criteria_list [$i];
		}
		return CHtml::listData ( $criteria, 'criteria', 'criteria' );
	}
	
	/**
	 * 
	 * @return Ambigous <mixed, multitype:unknown mixed , multitype:unknown , string, unknown>
	 */
	static function getCriteriaForSalesList() {
		$criteria_list = Constants::$criteria_list_sales;
		for($i = 1; $i <= count ( $criteria_list ); $i ++) {
			$criteria [$i] ['criteria_id'] = $i;
			$criteria [$i] ['criteria'] = $criteria_list [$i];
		}
		return CHtml::listData ( $criteria, 'criteria', 'criteria' );
	}
	
	/**
	 * 
	 * @param unknown $vendorName
	 * @return multitype:|string
	 */	
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
	
	/**
	 * 
	 * @param unknown $clientName
	 * @return multitype:|string
	 */
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
	
	/**
	 * 
	 * @param unknown $productName
	 * @return multitype:|string
	 */
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
