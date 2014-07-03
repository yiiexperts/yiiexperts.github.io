<?php

/**
 * This is the model class for table "yii_agency_channel".
 *
 * The followings are the available columns in table 'yii_agency_channel':
 * @property integer $Id
 * @property integer $AgencyId
 * @property integer $ChannelId
 * @property integer $Status
 *
 * The followings are the available model relations:
 * @property YiiChannel $channel
 * @property YiiAgency $agency
 */
class YiiAgencyChannel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YiiAgencyChannel the static model class
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
		return 'yii_agency_channel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('Id', 'safe'),
			array('AgencyId, ChannelId', 'required'),
			//array('AgencyId, ChannelId, Status', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('Id, AgencyId, ChannelId, Status', 'safe', 'on'=>'search'),
			//array('AgencyId', 'type', 'type' => 'array', 'safe'=>true, 'on'=>'insert',  'allowEmpty' => true),
			//array('ChannelId', 'type', 'type' => 'array', 'safe'=>true, 'on'=>'insert', 'allowEmpty' => true),
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
			'channel' => array(self::BELONGS_TO, 'YiiChannel', 'ChannelId'),
			'agency' => array(self::BELONGS_TO, 'YiiAgency', 'AgencyId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'AgencyId' => 'Agency',
			'ChannelId' => 'Channel',
			'Status' => 'Status',
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

		$criteria->compare('Id',$this->Id);
		$criteria->compare('AgencyId',$this->AgencyId);
		$criteria->compare('ChannelId',$this->ChannelId);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}