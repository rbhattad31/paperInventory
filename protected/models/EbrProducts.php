<?php

/**
 * This is the model class for table "ebr_products".
 *
 * The followings are the available columns in table 'ebr_products':
 * @property integer $product_id
 * @property string $product_name
 * @property integer $vendor_id
 * @property string $product_description
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
  * @property integer $unit_lookup_id
 * @property integer $unit_price
 *  @property integer $sale_price
 *
 * The followings are the available model relations:
 * @property EbrVendor $vendor
 * @property EbrLookup $unitLookup
 * @property EbrPurchase[] $ebrPurchases
 * @property EbrSales[] $ebrSales
 * @property EbrStock[] $ebrStocks
 */
class EbrProducts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EbrProducts the static model class
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
		return 'ebr_products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_name, vendor_id, product_description , unit_lookup_id , unit_price,sale_price', 'required'),
			array('vendor_id,unit_lookup_id', 'numerical', 'integerOnly'=>true),
			array('unit_price,sale_price', 'type', 'type'=>'float'),
			array('product_name, created_date, created_by, updated_date, updated_by', 'length', 'max'=>100),
			array('product_description', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('product_id, product_name, vendor_id, product_description,unit_price,unit_lookup_id', 'safe', 'on'=>'search'),
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
			'unitLookup' => array(self::BELONGS_TO, 'EbrLookup', 'unit_lookup_id'),
			'vendor' => array(self::BELONGS_TO, 'EbrVendor', 'vendor_id'),
			'ebrPurchases' => array(self::HAS_MANY, 'EbrPurchase', 'product_id'),
			'ebrSales' => array(self::HAS_MANY, 'EbrSales', 'product_id'),
			'ebrStocks' => array(self::HAS_MANY, 'EbrStock', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_id' => 'Product',
			'product_name' => 'Product Name',
			'vendor_id' => 'Vendor',
			'product_description' => 'Product Description',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'unit_lookup_id' => 'Units',
			'unit_price' => 'Price per unit',
				'sale_price' => 'Sale Price',
			
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

		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('product_description',$this->product_description,true);
		$criteria->compare('unit_lookup_id',$this->unit_lookup_id);
		$criteria->compare('unit_price',$this->unit_price);
		
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
	
	/**
	 * Suggests a list of existing tags matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of tags to be returned
	 * @return array list of matching tag names
	 */
	public function suggestProducts($keyword,$limit=20)
	{
		$tags=$this->findAll(array(
				'condition'=>'product_name LIKE :keyword',
				'limit'=>$limit,
				'params'=>array(
						':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
				),
		));
		return $tags;
	}
	
	public function getActiveProducts(){
		return $this->findAll();
	
	}
}