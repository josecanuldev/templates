<?php

/**
 * This is the model class for table "reservatour_circuito".
 *
 * The followings are the available columns in table 'reservatour_circuito':
 * @property integer $id_circuito
 * @property integer $idreserva
 * @property string $hotel
 * @property string $log
 */
class ReservatourCircuito extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reservatour_circuito';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idreserva, hotel', 'required'),
			array('idreserva', 'numerical', 'integerOnly'=>true),
			array('hotel', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_circuito, idreserva, hotel, log', 'safe', 'on'=>'search'),
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
			'id_circuito' => 'Id Circuito',
			'idreserva' => 'Idreserva',
			'hotel' => 'Hotel',
			'log' => 'Log',
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

		$criteria->compare('id_circuito',$this->id_circuito);
		$criteria->compare('idreserva',$this->idreserva);
		$criteria->compare('hotel',$this->hotel,true);
		$criteria->compare('log',$this->log,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReservatourCircuito the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
