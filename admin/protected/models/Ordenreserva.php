<?php

/**
 * This is the model class for table "ordenreserva".
 *
 * The followings are the available columns in table 'ordenreserva':
 * @property integer $idorden
 * @property integer $idreserva
 * @property string $subtotal
 * @property string $total
 * @property integer $status
 * @property integer $tipo
 * @property string $descuento
 * @property integer $idCodigoPromo
 */
class Ordenreserva extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ordenreserva';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idreserva', 'required'),
			array('idreserva, status, tipo, idCodigoPromo', 'numerical', 'integerOnly'=>true),
			array('subtotal, total, descuento', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idorden, idreserva, subtotal, total, status, tipo, descuento, idCodigoPromo', 'safe', 'on'=>'search'),
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
			'idorden' => 'Idorden',
			'idreserva' => 'Idreserva',
			'subtotal' => 'Subtotal',
			'total' => 'Total',
			'status' => 'Status',
			'tipo' => 'Tipo',
			'descuento' => 'Descuento',
			'idCodigoPromo' => 'Id Codigo Promo',
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

		$criteria->compare('idorden',$this->idorden);
		$criteria->compare('idreserva',$this->idreserva);
		$criteria->compare('subtotal',$this->subtotal,true);
		$criteria->compare('total',$this->total,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('descuento',$this->descuento,true);
		$criteria->compare('idCodigoPromo',$this->idCodigoPromo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ordenreserva the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
