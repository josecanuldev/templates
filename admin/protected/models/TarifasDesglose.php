<?php

/**
 * This is the model class for table "tarifas_desglose".
 *
 * The followings are the available columns in table 'tarifas_desglose':
 * @property integer $id_tarifa_desglose
 * @property integer $id_tarifa
 * @property integer $id_categoria
 * @property integer $min_pax
 * @property integer $max_pax
 * @property double $precio_neto
 * @property double $iva
 * @property double $precio_publico
 * @property string $last_updated
 */
class TarifasDesglose extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tarifas_desglose';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tarifa, id_categoria, min_pax, max_pax, precio_publico', 'required'),
			array('id_tarifa, id_categoria, min_pax, max_pax', 'numerical', 'integerOnly'=>true),
			array('precio_neto, iva, precio_publico', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tarifa_desglose, id_tarifa, id_categoria, min_pax, max_pax, precio_neto, iva, precio_publico, last_updated', 'safe', 'on'=>'search'),
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
			'id_tarifa_desglose' => 'Id Tarifa Desglose',
			'id_tarifa' => 'Id Tarifa',
			'id_categoria' => 'Id Categoria',
			'min_pax' => 'Min Pax',
			'max_pax' => 'Max Pax',
			'precio_neto' => 'Precio Neto',
			'iva' => 'Iva',
			'precio_publico' => 'Precio Publico',
			'last_updated' => 'Last Updated',
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

		$criteria->compare('id_tarifa_desglose',$this->id_tarifa_desglose);
		$criteria->compare('id_tarifa',$this->id_tarifa);
		$criteria->compare('id_categoria',$this->id_categoria);
		$criteria->compare('min_pax',$this->min_pax);
		$criteria->compare('max_pax',$this->max_pax);
		$criteria->compare('precio_neto',$this->precio_neto);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('precio_publico',$this->precio_publico);
		$criteria->compare('last_updated',$this->last_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TarifasDesglose the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
