<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property integer $create_time
 * @property integer $update_time
 */
class User extends CActiveRecord
{
	//const ACTIVE_STATUS = 1;
	//public $password_confirm;
	
	public $old_password;
	public $new_password;
	public $confirm_password;
	
	public $repeat_password;
	public $initialPassword;
	
	public $verifyCode;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'credential';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('email, first_name, last_name, password, password_confirm', 'required'),
			 array('password_confirm', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('validation', "Passwords don't match")),
			array('create_time, update_time', 'numerical', 'integerOnly'=>true),
			array('email','email'),
			array('email', 'length', 'max'=>500),
			array('first_name, last_name', 'length', 'max'=>200),
			array('password,password_confirm', 'length', 'max'=>300,'min'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, first_name, last_name, password, create_time, update_time', 'safe', 'on'=>'search'),*/
			
			array('Email, Password', 'required'),
			//array('Status', 'numerical', 'integerOnly'=>true),
			array('Email', 'length', 'max'=>120),
			array('Password', 'length', 'max'=>220),
			array('LastLoginTime', 'safe'),
			//array('Password', 'authenticate'),
			
			//array('old_password', 'compare', 'compareAttribute'=>'Password', 'on'=>'changePwd'),
        	//array('new_password, repeat_password', 'required', 'on' => 'changePwd'),
			//array('repeat_password', 'compare', 'compareAttribute'=>'new_password', 'on'=>'changePwd'),
			
			
			
			//array('Password, repeat_password', 'required', 'on'=>'insert'),
            //array('Password, repeat_password', 'length', 'min'=>6, 'max'=>40),
            //array('Password', 'compare', 'compareAttribute'=>'repeat_password'),
			
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('Id, Email, LoginId, Password, UserType, Status, LastLoginTime', 'safe', 'on'=>'search'),
			
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()), //only on withCaptcha scenario
			
			//array('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements(), 'on' => 'withCaptcha'), //only on withCaptcha scenario
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
			'Id' => 'ID',
			'FName' => 'First Name',
			'LName' => 'Last Name',
			'UserType' => 'User Type',
			'Email' => 'Email',
			'LoginId' => 'Login',
			'Password' => 'Password',
			'Status' => 'Status',
			'LastLoginTime' => 'Last Login Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	/*public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('ChannelId',$this->ChannelId);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('MobileNo',$this->MobileNo,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('LoginId',$this->LoginId,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Status',$this->Status);
		$criteria->compare('CreatedOn',$this->CreatedOn,true);
		$criteria->compare('CreatedBy',$this->CreatedBy);
		$criteria->compare('UpdatedOn',$this->UpdatedOn,true);
		$criteria->compare('UpdatedBy',$this->UpdatedBy);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}*/
	
	/*public function beforeSave()
	{
	  if($this->isNewRecord)
	   {
	     $this->create_time=time();
	     $this->update_time=time();
	   }
	   else
	   {
	     $this->update_time=time();
	   }
	   
	    $this->password=md5($this->password);
	   return parent::beforeSave();
	}*/
	
	
	
	public function beforeSave()
	{
	  $this->LastLoginTime=time();
	  $this->password=md5($this->password);
	   
	  return parent::beforeSave();
	}
	
	
	   /**
     * Generates a new validation key (additional security for cookie)
     */
     /*
    public function regenerateValidationKey()
    {
        $this->saveAttributes(array(
            'validation_key' => md5(mt_rand() . mt_rand() . mt_rand()),
        ));
    }
    */
}