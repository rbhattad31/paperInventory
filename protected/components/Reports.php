<?php
class Reports{
	
	/**
	 * 
	 * @return number
	 */
	static function getAmountPurchaseByShops() {
		$products = EbrProducts::model()->findAll();
		$shops = EbrShop::model()->getActiveShops();
		foreach ($products as $i=>$product) {
			
				
			// $amount[$product] = 0;
			foreach ( $shops as $j => $shop ) {
				$amount [$i] [$j] ['total'] = 0;
				$purcahses = $shop->ebrPurchases;
				$total = 0;
				foreach ( $purcahses as $k => $purchase ) {
					if ($purchase->product_id === $product->product_id) {
						$total = $total + $purchase->purchase_amount;
						$amount [$i] [$j] ['total'] = $total;
					}
				}
			}
		}
	
		return $amount;
	}
	
	/**
	 * 
	 * @return number
	 */
	static function getAmountSalesByShops() {
		$products = EbrProducts::model()->findAll();
		$shops = EbrShop::model ()->getActiveShops();
		foreach ($products as $i=>$product) {
			// $amount[$product] = 0;
			foreach ( $shops as $j => $shop ) {
				$amount [$i] [$j] ['total'] = 0;
				$sales = $shop->ebrSales;
				$total = 0;
				foreach ( $sales as $k => $sale ) {
					if ($sale->product_id === $product->product_id) {
						$total = $total + $sale->sale_amount;
						$amount [$i] [$j] ['total'] = $total;
					}
				}
			}
		}
	
		return $amount;
	}
	
	/**
	 * 
	 * @return number
	 */
	static function getAmountPurchaseByVendors() {
		$products = EbrProducts::model()->findAll();
		$vendors = EbrVendor::model ()->getActiveVendors();
		foreach ($products as $i=>$product) {
			foreach ( $vendors as $j => $vendor ) {
				$amount [$i] [$j] ['total'] = 0;
				$purchases = EbrPurchase::model()->findAllByAttributes ( array (
						'purchase_deleted' => 'N',
						'product_id'=>$product->product_id,
						'vendor_id'=>$vendor->vendor_id,
				));
	
				$total = 0;
				foreach ($purchases as $k => $purchase ) {
					if ($purchase->product_id === $product->product_id) {
						$total = $total + $purchase->purchase_amount;
						$amount [$i] [$j] ['total'] = $total;
					}
				}
			}
		}
	
		return $amount;
	}
	
	/**
	 *
	 * @return number
	 */
	static function getAmountSalesByVendors() {
		$products = EbrProducts::model()->findAll();
		$vendors = EbrVendor::model ()->getActiveVendors();
		foreach ($products as $i=>$product) {
			foreach ( $vendors as $j => $vendor ) {
				$amount [$i] [$j] ['total'] = 0;
				$sales = EbrSales::model()->findAllByAttributes ( array (
						'sales_deleted' => 'N',
						'product_id'=>$product->product_id,
						'vendor_id'=>$vendor->vendor_id,
				));
	
				$total = 0;
				foreach ($sales as $k => $sale ) {
					if ($sales->product_id === $product->product_id) {
						$total = $total + $sales->sale_amount;
						$amount [$i] [$j] ['total'] = $total;
					}
				}
			}
		}
	
		return $amount;
	}
	
	
	/**
	 * 
	 * @return number
	 */
	static function getAmountPurchaseByGroups() {
		$products = EbrProducts::model()->findAll();
		$groups = EbrGroup::model ()->getActiveGroups();
	
		foreach ($products as $i=>$product) {		
			// $amount[$product] = 0;
			foreach ( $groups as $j => $group ) {
				$amount [$i] [$j] ['total'] = 0;
	
				$shops = $group->ebrShops;
				$total = 0;
				foreach ( $shops as $k => $shop ) {
					$purcahses = $shop->ebrPurchases;
						
					foreach ( $purcahses as $k => $purchase ) {
	
						if ($purchase->product_id === $product->product_id) {
							$total = $total + $purchase->purchase_amount;
							$amount [$i] [$j] ['total'] = $total;
						}
					}
				}
			}
		}
		return $amount;
	}
	
	/**
	 * 
	 * @return number
	 */
	static function getAmountSalesByGroups() {
		$products = EbrProducts::model()->findAll();
		$groups = EbrGroup::model ()->getActiveGroups();
		foreach ($products as $i=>$product) {
			// $amount[$product] = 0;
			foreach ( $groups as $j => $group ) {
				$amount [$i] [$j] ['total'] = 0;
	
				$shops = $group->ebrShops;
				$total = 0;
				foreach ( $shops as $k => $shop ) {
					$sales = $shop->ebrSales;
	
					foreach ( $sales as $k => $sale ) {
	
						if ($sale->product_id === $product->product_id) {
							$total = $total + $sale->sale_amount;
							$amount [$i] [$j] ['total'] = $total;
						}
					}
				}
			}
		}
		return $amount;
	}
	
	/**
	 * 
	 * @return number
	 */
	static function getAllPurchases(){
		$purchases = EbrPurchase::model()->findAllByAttributes ( array (
				'purchase_deleted' => 'N',
		));
		$products = EbrProducts::model()->findAll();
		foreach ($products as $i=>$product) {			
			for($j=1;$j<=12;$j++){
				$amount [$i][$j]['total'] = 0;
				$total = 0;
				foreach ($purchases as $k => $purchase ) {
					$invoiceDate = $purchase->invoice_date;
					$date = date_parse($invoiceDate);
					$month = $date['month'];
					$year = $date['year'];
					if($year === 2014 && $j===$month && $purchase->product_id === $product->product_id){
						$total = $total + $purchase->purchase_amount;
						$amount [$i] [$j] ['total'] = $total;
					}
				}
			}
		}
		return $amount;
	}
	
	/**
	 * 
	 * @return number
	 */
	static function getAllSales(){
		$sales = EbrSales::model()->findAllByAttributes ( array (
				'sales_deleted' => 'N',
		));
		$products = EbrProducts::model()->findAll();
		foreach ($products as $i=>$product) {
			for($j=1;$j<=12;$j++){
				$amount [$i][$j]['total'] = 0;
				$total = 0;
				foreach ($sales as $k => $sale ) {
					$invoiceDate = $sale->sales_date;
					$date = date_parse($invoiceDate);
					$month = $date['month'];
					$year = $date['year'];
					if($year === 2014 && $j===$month && $sale->product_id === $product->product_id){
						$total = $total + $sale->sale_amount;
						$amount [$i] [$j] ['total'] = $total;
					}
				}
			}
		}
		return $amount;
	}
	
}