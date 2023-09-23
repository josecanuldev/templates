<?php
/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class RegistrationForm extends User {
	public $verifyPassword;
	public $verifyCode;
    
	public function rules() {
		$rules = array(
			array('username, password, verifyPassword, email', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 4, 'message' => UserModule::t("Incorrect username (length between 4 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 8, 'message' => UserModule::t("Incorrect password (minimal length 8 symbols).")),
			array('password', 'match', 'pattern'=>'/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => UserModule::t("Password must contain at least one digit, one uppercase letter and one lowercase letter.")),
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("Username already registered.")),
			array('email', 'unique', 'message' => UserModule::t("Email address already registered.")),
			//array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (use letters, numbers and '_').")),
		);
		if (!(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')) {
			array_push($rules,array('verifyCode', 'captcha', 'allowEmpty'=>!UserModule::doCaptcha('registration')));
		}
		
		array_push($rules,array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retyped password doesn't match.")));
		return $rules;
	}
}