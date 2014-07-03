<?php

/**
 * This is the model class for table "yii_dialyfpc".
 *
 * The followings are the available columns in table 'yii_dialyfpc':
 * @property integer $Id
 * @property string $ChannelCode
 * @property string $ProgramName
 * @property string $ProgramCode
 * @property string $TeleCastDate
 * @property string $StartTime
 * @property string $EndTime
 * @property integer $AvailableSpot
 * @property integer $BookedSpot
 * @property double $SpotRate
 *
 * The followings are the available model relations:
 * @property YiiChannel $channelCode
 */
class YiiDailyfpc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YiiDailyfpc the static model class
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
		return 'yii_dialyfpc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ChannelCode, ProgramCode, TeleCastDate, StartTime, EndTime', 'required'),
			array('AvailableSpot, BookedSpot', 'numerical', 'integerOnly'=>true),
			array('SpotRate', 'numerical'),
			array('ChannelCode, ProgramCode', 'length', 'max'=>20),
			array('ProgramName', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, ChannelCode, ProgramName, ProgramCode, TeleCastDate, StartTime, EndTime, AvailableSpot, BookedSpot, SpotRate', 'safe', 'on'=>'search'),
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
			'channelCode' => array(self::BELONGS_TO, 'YiiChannel', 'ChannelCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'ChannelCode' => 'Channel Code',
			'ProgramName' => 'Program Name',
			'ProgramCode' => 'Program Code',
			'TeleCastDate' => 'Tele Cast Date',
			'StartTime' => 'Start Time',
			'EndTime' => 'End Time',
			'AvailableSpot' => 'Available Spot',
			'BookedSpot' => 'Booked Spot',
			'SpotRate' => 'Spot Rate',
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
		$criteria->compare('ChannelCode',$this->ChannelCode,true);
		$criteria->compare('ProgramName',$this->ProgramName,true);
		$criteria->compare('ProgramCode',$this->ProgramCode,true);
		$criteria->compare('TeleCastDate',$this->TeleCastDate,true);
		$criteria->compare('StartTime',$this->StartTime,true);
		$criteria->compare('EndTime',$this->EndTime,true);
		$criteria->compare('AvailableSpot',$this->AvailableSpot);
		$criteria->compare('BookedSpot',$this->BookedSpot);
		$criteria->compare('SpotRate',$this->SpotRate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}