<?php

/**
 * This is the model class for table "ebr_sales".
 *
 * The followings are the available columns in table 'ebr_sales':
 * @property integer $sale_id
 * @property integer $group_id
 * @property integer $shop_id
 * @property integer $product_id
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property integer $sale_amount
 * @property string $sales_deleted
 * @property string $sales_date
 * @property integer $quantity
 * @property integer $client_id
 * @property integer $invoice_number
 * @property integer $vendor_id
 * @property integer $unit_price
 *
 * The followings are the available model relations:
 * @property EbrClient $client
 * @property EbrProducts $product
 * @property EbrVendor $vendor
 * @property EbrGroup $group
 * @property EbrShop $shop
 */
class EbrSales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EbrSales the static model class
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
		return 'ebr_sales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_id, shop_id, product_id, sale_amount, sales_date, quantity, client_id, invoice_number,unit_price', 'required'),
			array('group_id, shop_id, product_id, quantity, client_id, invoice_number', 'numerical', 'integerOnly'=>true),
			array('created_date, created_by, updated_date, updated_by, sales_date', 'length', 'max'=>100),
			array('sales_deleted', 'length', 'max'=>1),
			array('sale_amount,unit_price', 'type', 'type'=>'float'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sale_id, group_id, shop_id, product_id, created_date, created_by, updated_date, updated_by, sale_amount, sales_deleted, sales_date, quantity, client_id, invoice_number', 'safe', 'on'=>'search'),
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
			'client' => array(self::BELONGS_TO, 'EbrClient', 'client_id'),
			'product' => array(self::BELONGS_TO, 'EbrProducts', 'product_id'),
			'vendor' => array(self::BELONGS_TO, 'EbrVendor', 'vendor_id'),
			'group' => array(self::BELONGS_TO, 'EbrGroup', 'group_id'),
			'shop' => array(self::BELONGS_TO, 'EbrShop', 'shop_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sale_id' => 'Sale',
			'group_id' => 'Group',
			'shop_id' => 'Shop',
			'product_id' => 'Product',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'sale_amount' => 'Sale Amount',
			'sales_deleted' => 'Sales Deleted',
			'sales_date' => 'Sales Date',
			'quantity' => 'Quantity',
			'client_id' => 'Client',
			'invoice_number' => 'Invoice Number',
			'vendor_id' => 'Vendor',
			'unit_price' => 'Slaes Price Per Unit',
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
		if(isset($this->client_id)){
			$this->client_id = Utilities::getClient($this->client_id);
		}
		
		$criteria->compare('sale_id',$this->sale_id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('sale_amount',$this->sale_amount);
		$criteria->compare('sales_deleted',$this->sales_deleted,true);
		$criteria->compare('sales_date',$this->sales_date,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('invoice_number',$this->invoice_number);
		$criteria->compare('vendor_id',$this->vendor_id);

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
	
	public function getInvoiceNumber(){
		$criteria = new CDbCriteria();
		$criteria->condition = 'sales_deleted = "N"';
		$criteria->order = 'created_date desc';
		$sale=$this->find($criteria);
		if(isset($sale)){
			return $sale->invoice_number + 1;
		}else{
			return 1;
		}
		
	}
	
	public function getSalesByInvoice($invoice){
		return $this->findAllByAttributes(
				array(
						'sales_deleted'=>array('N'),
						'invoice_number'=>$invoice,
				));
		
	}
}