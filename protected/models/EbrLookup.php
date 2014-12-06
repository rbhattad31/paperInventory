<?php

/**
 * This is the model class for table "ebr_lookup".
 *
 * The followings are the available columns in table 'ebr_lookup':
 * @property integer $lookup_id
 * @property integer $lookup_number
 * @property string $lookup_name
 * @property string $lookup_value
 * @property string $lookup_description
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 */
class EbrLookup extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EbrLookup the static model class
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
		return 'ebr_lookup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lookup_number, lookup_name, lookup_value, lookup_description', 'required'),
			array('lookup_name', 'unique'),
			array('lookup_number', 'numerical', 'integerOnly'=>true),
			array('lookup_name, lookup_value, lookup_description, created_date, created_by, updated_date, updated_by', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('lookup_id, lookup_number, lookup_name, lookup_value, lookup_description', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'lookup_id' => 'Lookup',
			'lookup_number' => 'Lookup Type',
			'lookup_name' => 'Lookup Name',
			'lookup_value' => 'Lookup Value',
			'lookup_description' => 'Lookup Description',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
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

		$criteria->compare('lookup_id',$this->lookup_id);
		$criteria->compare('lookup_number',$this->lookup_number);
		$criteria->compare('lookup_name',$this->lookup_name,true);
		$criteria->compare('lookup_value',$this->lookup_value,true);
		$criteria->compare('lookup_description',$this->lookup_description,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('updated_by',$this->updated_by,true);

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
}