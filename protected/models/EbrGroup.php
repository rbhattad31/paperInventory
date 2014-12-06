<?php

/**
 * This is the model class for table "ebr_group".
 *
 * The followings are the available columns in table 'ebr_group':
 * @property integer $group_id
 * @property string $group_name
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property string $group_deleted
 *
 * The followings are the available model relations:
 * @property EbrPurchase[] $ebrPurchases
 * @property EbrSales[] $ebrSales
 * @property EbrShop[] $ebrShops
 */
class EbrGroup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EbrGroup the static model class
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
		return 'ebr_group';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('group_name', 'required'),
			array('group_name', 'length', 'max'=>255),
			array('group_name', 'unique'),
			array('created_date, created_by, updated_by', 'length', 'max'=>100),
			array('group_deleted', 'length', 'max'=>1),
			array('updated_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('group_id, group_name, group_deleted', 'safe', 'on'=>'search'),
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
			'ebrPurchases' => array(self::HAS_MANY, 'EbrPurchase', 'group_id'),
			'ebrSales' => array(self::HAS_MANY, 'EbrSales', 'group_id'),
			'ebrShops' => array(self::HAS_MANY, 'EbrShop', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'group_id' => 'Group',
			'group_name' => 'Group Name',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'group_deleted' => 'Group Deleted',
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

		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('group_deleted',$this->group_deleted,true);

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
				$this->group_deleted= 'N';
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
	
	
	public function getActiveGroups(){
		return EbrGroup::model ()->findAllByAttributes ( array (
				'group_deleted' => array (
						'N'
				)
		) );
	}
	
}