<?php

/**
 * This is the model class for table "ebr_stock".
 *
 * The followings are the available columns in table 'ebr_stock':
 * @property integer $stock_id
 * @property integer $product_id
 * @property integer $available_quantity
 * @property integer $total_sale
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property integer $shop_id
 * @property integer $vendor_id
 * @property string $year
 *
 * The followings are the available model relations:
 * @property EbrShop $shop
 * @property EbrProducts $product
 * @property EbrVendor $vendor
 */
class EbrStock extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EbrStock the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ebr_stock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, available_quantity, total_sale, shop_id, vendor_id', 'required'),
			array('product_id, available_quantity, total_sale, shop_id, vendor_id', 'numerical', 'integerOnly'=>true),
			array('created_date, created_by, updated_date, updated_by', 'length', 'max'=>100),
			array('year', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('stock_id, product_id, available_quantity, total_sale, created_date, created_by, updated_date, updated_by, shop_id, vendor_id, year', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'shop' => array(self::BELONGS_TO, 'EbrShop', 'shop_id'),
			'product' => array(self::BELONGS_TO, 'EbrProducts', 'product_id'),
			'vendor' => array(self::BELONGS_TO, 'EbrVendor', 'vendor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'stock_id' => 'Stock',
			'product_id' => 'Product',
			'available_quantity' => 'Available Quantity',
			'total_sale' => 'Total Sale',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'shop_id' => 'Shop',
			'vendor_id' => 'Vendor',
			'year' => 'Year',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		if(isset($this->product_id)){
			$this->product_id = Utilities::getProductId($this->product_id);
		}
		if(isset($this->vendor_id)){
			$this->vendor_id = Utilities::getVendorId($this->vendor_id);
		}
		
		$criteria->compare('stock_id',$this->stock_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('available_quantity',$this->available_quantity);
		$criteria->compare('total_sale',$this->total_sale);
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('year',$this->year,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->created_date=date('Y-m-d H:i:s',time());
				$this->created_by=Yii::app()->user->name;
			}
			else{
				$this->updated_date=date('Y-m-d H:i:s',time());
				$this->updated_by=Yii::app()->user->name;
			}
	
			return true;
		}
		else
			return false;
	}
	
	public function addStock($productId,$shopId,$vendorId,$quantity){
		$stock1 = $this->findAllByAttributes(array (
				'product_id'=>$productId,
				'vendor_id'=>$vendorId,
				'shop_id'=>$shopId
		));
		if(isset($stock1[0])){
			$stock1[0]->available_quantity = $quantity + $stock1[0]->available_quantity;
			$stock1[0]->save();
		}else{
			$stock = new EbrStock;
			$stock->product_id = $productId;
			$stock->shop_id = $shopId;
			$stock->vendor_id = $vendorId;
			$stock->year = '2014';
			$stock->total_sale = '0';
			$stock->available_quantity = $quantity;
			$stock->save();
				
		}
	}
	
	public function checkAndLessStock($productId,$shopId,$vendorId,$quantity){
		$stock1 = $this->findAllByAttributes(array (
				'product_id'=>$productId,
				'vendor_id'=>$vendorId,
				'shop_id'=>$shopId
		));
		if(isset($stock1[0])){
			if($stock1[0]->available_quantity > $quantity){
				$stock1[0]->available_quantity =  $stock1[0]->available_quantity - $quantity;
				$stock1[0]->total_sale =  $stock1[0]->total_sale + $quantity;
				$stock1[0]->save();
				return 'success';
			}else{
				return 'quantityFail';
			}
		}else{
			return 'quantityFail';
		}
	}
	
	public function deleteStock($productId,$shopId,$vendorId,$quantity){
		$stock1 = $this->findAllByAttributes(array (
				'product_id'=>$productId,
				'vendor_id'=>$vendorId,
				'shop_id'=>$shopId
		));
		if(isset($stock1[0])){
			$stock1[0]->available_quantity =  $stock1[0]->available_quantity - $quantity;
			$stock1[0]->save();
			return 'true';
		}else{
			return 'false';
		}
	}
}