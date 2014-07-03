<?php

/**
 * This is the model class for table "yii_agency".
 *
 * The followings are the available columns in table 'yii_agency':
 * @property integer $Id
 * @property string $AgencyName
 * @property string $FName
 * @property string $LName
 * @property string $Mobile
 * @property string $Email
 * @property string $Phone
 * @property string $Address
 * @property integer $Status
 * @property string $ModifiedOn
 * @property integer $LoginId
 * @property string $Password
 *
 * The followings are the available model relations:
 * @property YiiAgencyChannel[] $YiiAgencyChannels
 * @property LmiBmsAgencyMapper[] $lmiBmsAgencyMappers
 */
class YiiAgency extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YiiAgency the static model class
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
		return 'yii_agency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('AgencyName, FName, LName, Mobile, Email, Address', 'required', 'on' => 'insert'),
			
			array('AgencyName', 'length', 'min' => 10, 'max'=>200, 
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
			
			array('Phone', 'length', 'min' => 5, 'max'=>15, 
			'tooShort'=>Yii::t("translation", "{attribute} no. Invalid."),
			'tooLong'=>Yii::t("translation", "{attribute} no. Invalid.")),
			
			array('AgencyName', 'unique','message'=>'Channel name already exists!'),
			
			array('Email', 'email','message'=>"The email isn't correct"),
        	array('Email', 'unique','message'=>'Email already exists!'),
			
			
			
			//array('Status, LoginId', 'numerical', 'integerOnly'=>true),
			array('Password', 'length', 'max'=>150),
			//array('FName, LName', 'length', 'max'=>100),
			//array('Mobile, Phone', 'length', 'max'=>20),
			//array('Email', 'length', 'max'=>200),
			array('Address', 'length', 'max'=>500),
			
			array('CreatedOn','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'insert'),
			  
			array('ModifiedOn','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'insert'),
			  
			array('ModifiedOn','default',
              'value'=>new CDbExpression('NOW()'),
              'setOnEmpty'=>false,'on'=>'update'),
			  
			array('ModifiedOn', 'safe'),
			
			array('verifyCode', 'captcha', 'on' => 'insert', 'allowEmpty'=>!CCaptcha::checkRequirements()),

			array('old_password, new_password, repeat_password', 'required', 'on' => 'changePwd'),
			array('old_password', 'equalPasswords', 'on' => 'changePwd'),
			array('repeat_password', 'compare', 'compareAttribute'=>'new_password', 'on'=>'changePwd'),
			
			//array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
			
			//array('Password, repeatpassword', 'match', 'message'=>'Retype Password match'),
			//array('Password,repeatpassword,oldpassword','required','on'=>'resetpassword'),
			
			//array('AgencyName, FName, LName, Mobile, Email, Password, Address', 'required', 'on' => 'update'),
			
			//array('AgencyId', 'safe'),
			//array('ChannelId', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('Id, AgencyName, FName, LName, Mobile, Email, Phone, Address, Status, ModifiedOn, LoginId, Password', 'safe', 'on'=>'search'),
			
			//array('product_ids', 'type', 'type' => 'array', 'allowEmpty' => true),
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
			'YiiAgencyChannels' => array(self::HAS_MANY, 'YiiAgencyChannel', 'AgencyId'),
			'lmiBmsAgencyMappers' => array(self::HAS_MANY, 'LmiBmsAgencyMapper', 'YiiAgencyId'),
			/*'YiiChannel2'=>array(self::HAS_MANY,'YiiChannel',array('Id'=>'ChannelId'),
                    'through'=>'YiiAgencyChannels'),*/
					
					
			//'Recrutation' => array(self::HAS_ONE, 'Recrutation', array('idDocuments'=>'idRecrutation'),'through'=>'declaration'),
			//'YiiChannel2' => array(self::HAS_MANY, 'YiiAgencyChannel', array('Id' => 'ChannelId'), 'through' => 'fruits'),
			//'YiiChannel2' => array(self::HAS_MANY, 'YiiAgencyChannel', array('Id' => 'ChannelId'), 'through' => 'fruits'),
			
			//'YiiChannel2' => array(self::HAS_MANY, 'YiiAgencyChannel', array('Id' => 'ChannelId'), 'through' => 'fruits'),
			
			/*'YiiChannel2'=>array(
                self::HAS_MANY,'YiiChannel',array('Id'=>'ChannelId'),
                    'through'=>'YiiAgencyChannels'
            ),*/
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'AgencyName' => 'Agency Name',
			'FName' => 'First Name',
			'LName' => 'Last Name',
			'Mobile' => 'Mobile',
			'Email' => 'Email',
			'Phone' => 'Phone',
			'Address' => 'Address',
			'Status' => 'Status',
			'CreatedOn' => 'Member Since',
			'ModifiedOn' => 'Modify Profile',
			'LoginId' => 'Login',
			'Password' => 'Password',
			'Check' => 'Check',
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
		$criteria->compare('AgencyName',$this->AgencyName,true);
		$criteria->compare('FName',$this->FName,true);
		$criteria->compare('LName',$this->LName,true);
		$criteria->compare('Mobile',$this->Mobile,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Phone',$this->Phone,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('ModifiedOn',$this->ModifiedOn,true);
		$criteria->compare('LoginId',$this->LoginId);
		$criteria->compare('Password',$this->Password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}