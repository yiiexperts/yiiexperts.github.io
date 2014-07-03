<?php

/**
 * This is the model class for table "yii_channel".
 *
 * The followings are the available columns in table 'yii_channel':
 * @property integer $Id
 * @property string $ChannelName
 * @property string $ChannelCode
 * @property string $FName
 * @property integer $LName
 * @property string $Mobile
 * @property string $Phone
 * @property string $Email
 * @property integer $Status
 * @property string $wsldUrl
 * @property string $LoginId
 * @property string $Password
 *
 * The followings are the available model relations:
 * @property BmsAgencymaster[] $bmsAgencymasters
 * @property BmsBookingdetail[] $bmsBookingdetails
 * @property BmsBookingmaster[] $bmsBookingmasters
 * @property BmsClientAgencyMapper[] $bmsClientAgencyMappers
 * @property BmsClientcode[] $bmsClientcodes
 * @property BmsDialyfpc[] $bmsDialyfpcs
 * @property YiiAgencyChannel[] $YiiAgencyChannels
 */
class YiiChannel extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YiiChannel the static model class
	 */
	public $old_password;
	public $new_password;
	public $repeat_password;
	
	public $verifyCode;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'yii_channel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ChannelName, ChannelCode, FName, LName, Mobile, Email, ChannelLogo', 'required', 'on' => 'insert'),
			
			array('ChannelCode', 'length', 'min' => 4, 'max'=>100, 
			'tooShort'=>Yii::t("translation", "{attribute} is too short."),
			'tooLong'=>Yii::t("translation", "{attribute} is too long.")),
	
			array('ChannelName', 'length', 'min' => 2, 'max'=>100, 
			'tooShort'=>Yii::t("translation", "{attribute} is too short."),
			'tooLong'=>Yii::t("translation", "{attribute} is too long.")),
			
			array('FName', 'length', 'min' => 3, 'max'=>100, 
			'tooShort'=>Yii::t("translation", "{attribute} is too short."),
			'tooLong'=>Yii::t("translation", "{attribute} is too long.")),
			
			array('LName', 'length', 'min' => 3, 'max'=>100, 
			'tooShort'=>Yii::t("translation", "{attribute} is too short."),
			'tooLong'=>Yii::t("translation", "{attribute} is too long.")),
			
			array('Mobile', 'length', 'min' => 10, 'max'=>15, 
			'tooShort'=>Yii::t("translation", "{attribute} no. Invalid."),
			'tooLong'=>Yii::t("translation", "{attribute} no. Invalid.")),
			
			array('ChannelCode', 'unique','message'=>'Channel code already exists!'),
			array('ChannelName', 'unique','message'=>'Channel name already exists!'),
			
			array('Email', 'email','message'=>"The email isn't correct"),
        	array('Email', 'unique','message'=>'Email already exists!'),
			
			//array('Status', 'numerical', 'integerOnly'=>true),
			//array('ChannelName, Email', 'length', 'max'=>150),
			//array('ChannelCode, Mobile, Phone', 'length', 'max'=>20),
			//array('FName, LName', 'length', 'max'=>100),
			array('wsldUrl', 'length', 'max'=>200),
			array('LoginId, Password', 'length', 'max'=>120),
			//array('ChannelLogo', 'file', 'types'=>'jpg, jpeg, bmp, gif, png', 'safe'=>true),
			array('ChannelLogo', 'file', 'types'=>'jpg, jpeg, bmp, gif, png', 'safe'=>true,'on'=>'insert'),
			
			array('Phone', 'length', 'min' => 5, 'max'=>15, 
			'tooShort'=>Yii::t("translation", "{attribute} no. Invalid."),
			'tooLong'=>Yii::t("translation", "{attribute} no. Invalid.")),
			
			array('ChannelDescription', 'length', 'max'=>2000),
			
			array('ChannelName, FName, LName, Mobile', 'required','on'=>'update'),
			
			array('CreatedOn','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'insert'),
			  
			array('ModifiedOn','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'insert'),
			  
			array('ModifiedOn','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'update'),

			array('verifyCode', 'captcha', 'on' => 'insert', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			
			array('old_password, new_password, repeat_password', 'required', 'on' => 'changePwd'),
			array('old_password', 'equalPasswords', 'on' => 'changePwd'),
			array('repeat_password', 'compare', 'compareAttribute'=>'new_password', 'on'=>'changePwd'),
			
			//array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
			  
			//array('Password, repeatpassword', 'match', 'message'=>'Retype Password match'),
			//array('Password,repeatpassword,oldpassword','required','on'=>'resetpassword'),
			  
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('Id, ChannelName, ChannelCode, FName, LName, Mobile, Phone, Email, Status, wsldUrl, LoginId, Password', 'safe', 'on'=>'search'),
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
			'bmsAgencymasters' => array(self::HAS_MANY, 'BmsAgencymaster', 'ChannelCode'),
			'bmsBookingdetails' => array(self::HAS_MANY, 'BmsBookingdetail', 'ChannelCode'),
			'bmsBookingmasters' => array(self::HAS_MANY, 'BmsBookingmaster', 'ChannelCode'),
			'bmsClientAgencyMappers' => array(self::HAS_MANY, 'BmsClientAgencyMapper', 'ChannelCode'),
			'bmsClientcodes' => array(self::HAS_MANY, 'BmsClientcode', 'ChannelCode'),
			'bmsDialyfpcs' => array(self::HAS_MANY, 'BmsDialyfpc', 'ChannelCode'),
			'YiiAgencyChannels' => array(self::HAS_MANY, 'YiiAgencyChannel', 'ChannelId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'ChannelName' => 'Channel Name',
			'ChannelCode' => 'Channel Code',
			'ChannelLogo' => 'Channel Logo',
			'FName' => 'First Name',
			'LName' => 'Last Name',
			'Mobile' => 'Mobile',
			'Phone' => 'Phone',
			'Email' => 'Email',
			'Status' => 'Status',
			'wsldUrl' => 'Wsld Url',
			'LoginId' => 'Login',
			'Password' => 'Password',
			'CreatedOn' => 'Member Since',
			'ModifiedOn' => 'Modify Profile',
		);
	}
	
	
	public function equalPasswords($attribute, $params)
	{
		$user = User::model()->findByPk(Yii::app()->user->Id);
		if ($user->Password != md5($this->old_password))
			$this->addError($attribute, 'Old password is incorrect.');
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
		$criteria->compare('ChannelName',$this->ChannelName,true);
		$criteria->compare('ChannelCode',$this->ChannelCode,true);
		$criteria->compare('FName',$this->FName,true);
		$criteria->compare('LName',$this->LName);
		$criteria->compare('Mobile',$this->Mobile,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('wsldUrl',$this->wsldUrl,true);
		$criteria->compare('LoginId',$this->LoginId,true);
		$criteria->compare('Password',$this->Password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}