<?php

/**
 * This is the model class for table "ebr_purchase".
 *
 * The followings are the available columns in table 'ebr_purchase':
 * @property integer $purchase_id
 * @property integer $group_id
 * @property integer $shop_id
 * @property integer $product_id
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property integer $purchase_amount
 * @property integer $invoice_number
 * @property integer $vendor_id
 * @property string $purchase_deleted
 * @property string $invoice_date
 * @property integer $quantity
 * @property integer $unit_price
 *
 * The followings are the available model relations:
 * @property EbrProducts $product
 * @property EbrGroup $group
 * @property EbrShop $shop
 * @property EbrVendor $vendor
 */
class EbrPurchase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EbrPurchase the static model class
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
		return 'ebr_purchase';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, shop_id, product_id, purchase_amount, invoice_number,unit_price, vendor_id, invoice_date, quantity', 'required'),
			array('group_id, shop_id, product_id, invoice_number, vendor_id, quantity , unit_price,', 'numerical', 'integerOnly'=>true),
			array('created_date, created_by, updated_date, updated_by, invoice_date', 'length', 'max'=>100),
			array('purchase_deleted', 'length', 'max'=>1),
				array('purchase_amount', 'type', 'type'=>'float'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('purchase_id, group_id, shop_id, product_id, created_date, created_by, updated_date, updated_by, purchase_amount, invoice_number, vendor_id, purchase_deleted, invoice_date, quantity', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'EbrProducts', 'product_id'),
			'group' => array(self::BELONGS_TO, 'EbrGroup', 'group_id'),
			'shop' => array(self::BELONGS_TO, 'EbrShop', 'shop_id'),
			'vendor' => array(self::BELONGS_TO, 'EbrVendor', 'vendor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'purchase_id' => 'Purchase',
			'group_id' => 'Group',
			'shop_id' => 'Shop',
			'product_id' => 'Product',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'purchase_amount' => 'Purchase Amount',
			'invoice_number' => 'Invoice Number',
			'vendor_id' => 'Vendor',
			'purchase_deleted' => 'Purchase Deleted',
			'invoice_date' => 'Invoice Date',
			'quantity' => 'Quantity',
			'unit_price' => 'Price Per Unit',
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
		
		$criteria->compare('purchase_id',$this->purchase_id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('purchase_amount',$this->purchase_amount);
		$criteria->compare('invoice_number',$this->invoice_number);
		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('purchase_deleted',$this->purchase_deleted,true);
		$criteria->compare('invoice_date',$this->invoice_date,true);
		$criteria->compare('quantity',$this->quantity);

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
				$this->purchase_deleted= 'N';
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
	
}