<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class UserChangePassword extends CFormModel {
	public $oldPassword;
	public $password;
	public $verifyPassword;
	
	public function rules() {
		return Yii::app()->controller->id == 'recovery' ? array(
			array('password, verifyPassword', 'required'),
			array('password, verifyPassword', 'length', 'max'=>128, 'min' => 8,'message' => UserModule::t("Incorrect password (minimal length 8 symbols).")),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retyped Password doesn't match.")),
		) : array(
			array('oldPassword, password, verifyPassword', 'required'),
			array('oldPassword, password, verifyPassword', 'length', 'max'=>128, 'min' => 8,'message' => UserModule::t("Incorrect password (minimal length 8 symbols).")),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retyped Password doesn't match.")),
			array('oldPassword', 'verifyOldPassword'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'oldPassword'=>UserModule::t("Old Password"),
			'password'=>UserModule::t("Password"),
			'verifyPassword'=>UserModule::t("Retype Password"),
		);
	}
	
	/**
	 * Verify Old Password
	 */
	 public function verifyOldPassword($attribute, $params)
	 {
	     $password = User::model()->notsafe()->findByPk(Yii::app()->user->id)->password;
		 if ($password != Yii::app()->getModule('user')->encrypting($this->$attribute, $password))
			 $this->addError($attribute, UserModule::t("Old Password is incorrect."));
	 }
}