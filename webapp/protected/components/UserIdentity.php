<?php
/**
 * UserIdentity.php
 *
 * @author: antonio ramirez <amigo.cobos@gmail.com>
 * Date: 8/12/12
 * Time: 10:00 PM
 */
class UserIdentity extends CUserIdentity {
	/**
	 * @var integer id of logged user
	 */
	 
	
	const ERROR_USERNAME_NOT_ACTIVE  = 3;
	
	private $_id;
	private $_FName;
	private $_LName;
	private $_UserType;
	private $_Status;
	
	

	/**
	 * Authenticates username and password
	 * @return boolean CUserIdentity::ERROR_NONE if successful authentication
	 */
	 

	 
	 
	public function authenticate() {
		$attribute = strpos($this->username, '@') ? 'email' : 'username';
		  
		//$record=User::model()->findByAttributes(array('Email'=>$this->username));
		
		$user = User::model()->find(array('condition' => $attribute . '=:loginname', 'params' =>
			array(':loginname' => $this->username)));
			
		//print_r($user);
		//exit(0);
			
		
		if ($user === null) {
		         
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} 
	    else if ($user->Password!=md5($this->password)) {
		
		 $this->errorCode = self::ERROR_PASSWORD_INVALID;
		}
		
		else if ($user->Status != 0) {
		
		 //$err = "You have been Inactive by Admin.";
         //$this->errorCode = $err;
		 
		 $this->errorCode = self::ERROR_USERNAME_NOT_ACTIVE;
		}
		
		
		 else {
			//$user->regenerateValidationKey();
			
			
			$this->_id = $user->Id;
			$this->_FName = $user->FName;
			$this->_LName = $user->LName;
			$this->_UserType = $user->UserType;
			$this->_Status = $user->Status;
			$this->username = $user->Email;
		        $this->setState('firstName', $user->FName);
		        $this->setState('lastName', $user->LName);
				
				Yii::app()->session;
			    Yii::app()->session['uid'] = $user->Id;
				Yii::app()->session['utype'] = $user->UserType;
			
			$this->errorCode = self::ERROR_NONE;
			
		}
		return !$this->errorCode;
	}
	
	

	/**
	 * Creates an authenticated user with no passwords for registration
	 * process (checkout)
	 * @param string $username
	 * @return self
	 */
	public static function createAuthenticatedIdentity($id, $username) {
		$identity = new self($username, '');
		$identity->_id = $id;
		$identity->errorCode = self::ERROR_NONE;
		return $identity;
	}

	/**
	 *
	 * @return integer id of the logged user, null if not set
	 */
	public function getId() {
		return $this->_id;
	}
	public function getFirstName() {
		return $this->_FName;
	}
	public function getLastName() {
		return $this->_LName;
	}
	public function getUserType() {
		return $this->_UserType;
	}
	public function getStatus() {
		return $this->_Status;
	}
}