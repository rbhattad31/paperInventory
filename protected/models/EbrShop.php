<?php

/**
 * This is the model class for table "ebr_shop".
 *
 * The followings are the available columns in table 'ebr_shop':
 * @property integer $shop_id
 * @property string $shop_name
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property integer $group_id
 * @property string $shop_deleted
 *
 * The followings are the available model relations:
 * @property EbrPurchase[] $ebrPurchases
 * @property EbrSales[] $ebrSales
 * @property EbrGroup $group
 * @property EbrStock[] $ebrStocks
 */
class EbrShop extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EbrShop the static model class
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
		return 'ebr_shop';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('shop_name, group_id', 'required'),
				array('shop_name', 'unique'),
			array('group_id', 'numerical', 'integerOnly'=>true),
			array('shop_name, created_date, created_by, updated_date, updated_by', 'length', 'max'=>100),
			array('shop_deleted', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('shop_id, shop_name, created_date, created_by, updated_date, updated_by, group_id, shop_deleted', 'safe', 'on'=>'search'),
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
			'ebrPurchases' => array(self::HAS_MANY, 'EbrPurchase', 'shop_id'),
			'ebrSales' => array(self::HAS_MANY, 'EbrSales', 'shop_id'),
			'group' => array(self::BELONGS_TO, 'EbrGroup', 'group_id'),
			'ebrStocks' => array(self::HAS_MANY, 'EbrStock', 'shop_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'shop_id' => 'Shop',
			'shop_name' => 'Shop Name',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'group_id' => 'Group',
			'shop_deleted' => 'Shop Deleted',
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

		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('shop_name',$this->shop_name,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('shop_deleted',$this->shop_deleted,true);

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
	
	public function getActiveShops(){
		return EbrShop::model()->findAllByAttributes(
				array(
						'shop_deleted'=>array('N')
				));
	
	}
}