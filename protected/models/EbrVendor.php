<?php

/**
 * This is the model class for table "ebr_vendor".
 *
 * The followings are the available columns in table 'ebr_vendor':
 * @property integer $vendor_id
 * @property string $vendor_name
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property string $vendor_deleted
 * @property string $vendor_address
 *
 * The followings are the available model relations:
 * @property EbrProducts[] $ebrProducts
 * @property EbrPurchase[] $ebrPurchases
 * @property EbrStock[] $ebrStocks
 * @property EbrSales[] $ebrSales
 */
class EbrVendor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EbrVendor the static model class
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
		return 'ebr_vendor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vendor_name, vendor_address', 'required'),
				array('vendor_name', 'unique'),
			array('vendor_name, created_date, created_by, updated_date, updated_by', 'length', 'max'=>100),
			array('vendor_deleted', 'length', 'max'=>1),
			array('vendor_address', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('vendor_id, vendor_name, created_date, created_by, updated_date, updated_by, vendor_deleted, vendor_address', 'safe', 'on'=>'search'),
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
			'ebrProducts' => array(self::HAS_MANY, 'EbrProducts', 'vendor_id'),
			'ebrPurchases' => array(self::HAS_MANY, 'EbrPurchase', 'vendor_id'),
			'ebrStocks' => array(self::HAS_MANY, 'EbrStock', 'vendor_id'),
			'ebrSales' => array(self::HAS_MANY, 'EbrSales', 'vendor_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'vendor_id' => 'Vendor',
			'vendor_name' => 'Vendor Name',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'vendor_deleted' => 'Vendor Deleted',
			'vendor_address' => 'Vendor Address',
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

		$criteria->compare('vendor_id',$this->vendor_id);
		$criteria->compare('vendor_name',$this->vendor_name,true);
		$criteria->compare('vendor_deleted',$this->vendor_deleted,true);
		$criteria->compare('vendor_address',$this->vendor_address,true);

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
				$this->vendor_deleted = 'N';
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
	public function suggestVendors($keyword,$limit=20)
	{
		$tags=$this->findAll(array(
				'condition'=>'vendor_name LIKE :keyword',
				'limit'=>$limit,
				'params'=>array(
						':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
				),
		));
		return $tags;
	}
	
	
	public function getActiveVendors(){
		return EbrVendor::model ()->findAllByAttributes ( array (
		'vendor_deleted' => array (
		'N'
				)
		) );
	}
}