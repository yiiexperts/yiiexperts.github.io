<?php

/**
 * This is the model class for table "yii_temp_fpc".
 *
 * The followings are the available columns in table 'yii_temp_fpc':
 * @property integer $Id
 * @property integer $FPCId
 * @property integer $AgencyId
 * @property string $SessionId
 * @property string $Seconds
 *
 * The followings are the available model relations:
 * @property YiiAgency $agency
 * @property BmsDialyfpc $fPC
 */
class YiiTempfpc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YiiTempfpc the static model class
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
		return 'yii_temp_fpc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FPCId, AgencyId, SessionId, Seconds', 'required'),
			array('FPCId, AgencyId', 'numerical', 'integerOnly'=>true),
			array('SessionId', 'length', 'max'=>100),
			array('Seconds', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, FPCId, AgencyId, SessionId, Seconds', 'safe', 'on'=>'search'),
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
			'agency' => array(self::BELONGS_TO, 'YiiAgency', 'AgencyId'),
			'fPC' => array(self::BELONGS_TO, 'BmsDialyfpc', 'FPCId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'FPCId' => 'Fpcid',
			'AgencyId' => 'Agency',
			'SessionId' => 'Session',
			'Seconds' => 'Seconds',
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
		$criteria->compare('FPCId',$this->FPCId);
		$criteria->compare('AgencyId',$this->AgencyId);
		$criteria->compare('SessionId',$this->SessionId,true);
		$criteria->compare('Seconds',$this->Seconds,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}