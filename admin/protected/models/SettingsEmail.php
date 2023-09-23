<?php

/**
 * This is the model class for table "settingsEmail".
 *
 * The followings are the available columns in table 'settingsEmail':
 * @property integer $idsettingsEmail
 * @property string $host
 * @property integer $port
 * @property string $username
 * @property string $password
 * @property string $noReply
 * @property string $fromname
 * @property string $addCC
 */
class SettingsEmail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'settingsEmail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('host, port, username, password, noReply, fromname, addCC', 'required'),
			array('port', 'numerical', 'integerOnly'=>true),
			array('host', 'length', 'max'=>250),
			array('username', 'length', 'max'=>50),
			array('password, noReply, fromname', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idsettingsEmail, host, port, username, password, noReply, fromname, addCC', 'safe', 'on'=>'search'),
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
			'idsettingsEmail' => 'Idsettings Email',
			'host' => 'Host',
			'port' => 'Port',
			'username' => 'Username',
			'password' => 'Password',
			'noReply' => 'No Reply',
			'fromname' => 'Fromname',
			'addCC' => 'Add Cc',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idsettingsEmail',$this->idsettingsEmail);
		$criteria->compare('host',$this->host,true);
		$criteria->compare('port',$this->port);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('noReply',$this->noReply,true);
		$criteria->compare('fromname',$this->fromname,true);
		$criteria->compare('addCC',$this->addCC,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SettingsEmail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
