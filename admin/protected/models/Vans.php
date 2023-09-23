<?php

/**
 * This is the model class for table "vans".
 *
 * The followings are the available columns in table 'vans':
 * @property string $id
 * @property string $uuid
 * @property string $model
 * @property string $plates
 * @property integer $max_passenger
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property string $brand
 * @property integer $seats_remove
 */
class Vans extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model, plates, max_passenger', 'required'),
			array('max_passenger, seats_remove', 'numerical', 'integerOnly'=>true),
			array('uuid', 'length', 'max'=>36),
			array('model, plates, brand, codigo_verificacion', 'length', 'max'=>255),
			array('updated_at, deleted_at, fecha_alta, fecha_vencimiento, fecha_seguro, fecha_mantenimiento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uuid, model, plates, max_passenger, created_at, updated_at, deleted_at, brand, seats_remove, codigo_verificacion, fecha_alta, fecha_vencimiento, fecha_seguro, fecha_mantenimiento', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'uuid' => 'Uuid',
			'model' => 'Model',
			'plates' => 'Plates',
			'max_passenger' => 'Max Passenger',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'deleted_at' => 'Deleted At',
			'brand' => 'Brand',
			'seats_remove' => 'Seats Remove',
			'codigo_verificacion' => 'Codigo Verificacion',
			'fecha_alta' => 'Fecha Alta',
			'fecha_vencimiento' => 'Fecha Vencimiento',
			'fecha_seguro' => 'Fecha Seguro',
			'fecha_mantenimiento' => 'Fecha Mantenimiento',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('uuid',$this->uuid,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('plates',$this->plates,true);
		$criteria->compare('max_passenger',$this->max_passenger);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('deleted_at',$this->deleted_at,true);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('seats_remove',$this->seats_remove);
		$criteria->compare('codigo_verificacion',$this->codigo_verificacion,true);
		$criteria->compare('fecha_alta',$this->fecha_alta,true);
		$criteria->compare('fecha_vencimiento',$this->fecha_vencimiento,true);
		$criteria->compare('fecha_seguro',$this->fecha_seguro,true);
		$criteria->compare('fecha_mantenimiento',$this->fecha_mantenimiento,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vans the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
