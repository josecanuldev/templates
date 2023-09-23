<?php

/**
 * This is the model class for table "reservatour_desglose".
 *
 * The followings are the available columns in table 'reservatour_desglose':
 * @property integer $id_reservatour_desglose
 * @property integer $idreserva
 * @property integer $adultos
 * @property integer $menores
 * @property string $log
 */
class ReservatourDesglose extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reservatour_desglose';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idreserva, adultos, menores', 'required'),
			array('idreserva, adultos, menores', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_reservatour_desglose, idreserva, adultos, menores, log', 'safe', 'on'=>'search'),
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
			'id_reservatour_desglose' => 'Id Reservatour Desglose',
			'idreserva' => 'Idreserva',
			'adultos' => 'Adultos',
			'menores' => 'Menores',
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

		$criteria->compare('id_reservatour_desglose',$this->id_reservatour_desglose);
		$criteria->compare('idreserva',$this->idreserva);
		$criteria->compare('adultos',$this->adultos);
		$criteria->compare('menores',$this->menores);
		$criteria->compare('log',$this->log,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReservatourDesglose the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
