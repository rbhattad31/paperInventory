<?php

/**
 * This is the model class for table "ebr_client".
 *
 * The followings are the available columns in table 'ebr_client':
 * @property integer $client_id
 * @property string $client_name
 * @property string $client_address
 * @property string $client_number
 * @property string $client_tin
 * @property string $created_date
 * @property string $created_by
 * @property string $updated_date
 * @property string $updated_by
 * @property string $client_deleted
 *
 * The followings are the available model relations:
 * @property EbrSales[] $ebrSales
 */
class EbrClient extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EbrClient the static model class
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
		return 'ebr_client';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_name, client_number, client_tin', 'required'),
				array('client_name', 'unique'),
			array('client_name, client_address, client_tin, created_date, created_by, updated_date, updated_by', 'length', 'max'=>100),
			array('client_number', 'length', 'max'=>10),
			array('client_deleted', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('client_id, client_name, client_address, client_number, client_tin, created_date, created_by, updated_date, updated_by, client_deleted', 'safe', 'on'=>'search'),
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
			'ebrSales' => array(self::HAS_MANY, 'EbrSales', 'client_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'client_id' => 'Client',
			'client_name' => 'Client Name',
			'client_address' => 'Client Address',
			'client_number' => 'Client Number',
			'client_tin' => 'Client Tin',
			'created_date' => 'Created Date',
			'created_by' => 'Created By',
			'updated_date' => 'Updated Date',
			'updated_by' => 'Updated By',
			'client_deleted' => 'Client Deleted',
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

		$criteria->compare('client_id',$this->client_id);
		$criteria->compare('client_name',$this->client_name,true);
		$criteria->compare('client_address',$this->client_address,true);
		$criteria->compare('client_number',$this->client_number,true);
		$criteria->compare('client_tin',$this->client_tin,true);
		$criteria->compare('client_deleted',$this->client_deleted,true);

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
	public function suggestClients($keyword,$limit=20)
	{
		$tags=$this->findAll(array(
				'condition'=>'client_name LIKE :keyword',
				'limit'=>$limit,
				'params'=>array(
						':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
				),
		));
		return $tags;
	}
}