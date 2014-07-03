<?php
/**
 * LoginForm.php
 *
 * @author: antonio ramirez <amigo.cobos@gmail.com>
 * Date: 7/22/12
 * Time: 8:37 PM
 */

class LoginForm extends CFormModel {

	// maximum number of login attempts before display captcha
	
	const MAX_LOGIN_ATTEMPTS = 3;

	public $username;
	public $password;
	public $email;
	public $rememberMe;
	public $verifyCode;
	private $_identity;
	private $_user = null;
	public $rec;
	public $status;

	/**
	 * Model rules
	 * @return array
	 */
	public function rules() {
		return array(
			array('username, password', 'required'),
			array('username', 'length', 'max' => 45),
			array('password', 'length', 'max' => 50, 'min' => 6),
			//array('verifyCode', 'validateCaptcha'),
			array('password', 'authenticate'),
			//array('rememberMe', 'boolean'),
			array('username,email', 'email'),
			array('email', 'length', 'max' => 125),
			array('email', 'exist', 'className' => 'Customer'),
		);
	}

	/**
	 * Returns attribute labels
	 * @return array
	 */
	public function attributeLabels() {
		return array(
			'username' => Yii::t('labels', 'E-mail'),
			'rememberMe' => Yii::t('labels', 'Remember me next time'),
		);
	}

	/**
	 * Authenticates user input against DB
	 * @param $attribute
	 * @param $params
	 */
	/*public function authenticate($attribute, $params) {
		if (!$this->hasErrors()) {
			$this->_identity = new UserIdentity($this->username, $this->password);
			if (!$this->_identity->authenticate()) {
			
				if (($user = $this->user) !== null && $user->login_attempts < 100)
				     $user->saveAttributes(array('login_attempts' => $user->login_attempts + 1));
				$this->addError('username', Yii::t('errors', 'Incorrect email and/or password.'));
				$this->addError('password', Yii::t('errors', 'Incorrect email and/or password.'));
			}
		}
	}*/
	
	
	
	/*public function authenticate($attribute,$params)
        {
           if(!$this->hasErrors())
               {
                 $this->_identity=new UserIdentity($this->username,$this->password);
                   if(!$this->_identity->authenticate())
                        $this->addError('password','Incorrect username or password.');
					else
						$this->addError('password','Incorrect username or password.');
                }
        }*/
		
		
	public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $this->_identity=new UserIdentity($this->username,$this->password);
            if(!$this->_identity->authenticate())
            {
                if(($this->_identity->errorCode == 1) or ($this->_identity->errorCode == 2))
                    $this->addError('password',Yii::t('zii','Incorrect username or password.'));
                elseif($this->_identity->errorCode == 3)
                    $this->addError('username',Yii::t('zii','Username is currently not active'));
                else
                    $this->addError('username',Yii::t('zii','Invalid Exception'));
            }
        }
    }

	/**
	 * Validates captcha code
	 * @param $attribute
	 * @param $params
	 */
	public function validateCaptcha($attribute, $params) {
		if ($this->getRequireCaptcha())
			CValidator::createValidator('captcha', $this, $attribute, $params)->validate($this);
	}

	/**
	 * Login
	 * @return bool
	 */
	public function login() {
		
		/*if(Yii::app()->getRequest()->getIsAjaxRequest()) {
		echo TbActiveForm::validate( array( $model)); 
		Yii::app()->end(); 
		}*/


		if ($this->_identity === null) {
			$this->_identity = new UserIdentity($this->username, $this->password);
			$this->_identity->authenticate();
		}
		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
			$duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
			Yii::app()->user->login($this->_identity, $duration);
			return true;
		}
	}

	/**
	 * Returns
	 * @return null
	 */
	public function getUser() {
		if ($this->_user === null) {
			$attribute = strpos($this->username, '@') ? 'email' : 'username';
			$this->_user = User::model()->find(array('condition' => $attribute . '=:loginname', 'params' => array(':loginname' => $this->username)));
		}
		return $this->_user;
	}

	/**
	 * Returns whether it requires captcha or not
	 * @return bool
	 */
	public function getRequireCaptcha() {
		return ($user = $this->user) !== null && $user->login_attempts >= self::MAX_LOGIN_ATTEMPTS;
	}

}
