<?php

/**
 * This is the model class for table "tarifas_menores".
 *
 * The followings are the available columns in table 'tarifas_menores':
 * @property integer $id_tarifa_menor
 * @property integer $id_tarifa
 * @property integer $id_categoria
 * @property integer $edad_min
 * @property integer $edad_max
 * @property double $precio_neto
 * @property double $iva
 * @property double $precio_publico
 * @property string $moneda
 * @property string $last_updated
 */
class TarifasMenores extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tarifas_menores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_tarifa, id_categoria, edad_min, edad_max, moneda, last_updated', 'required'),
			array('id_tarifa, id_categoria, edad_min, edad_max', 'numerical', 'integerOnly'=>true),
			array('precio_neto, iva, precio_publico', 'numerical'),
			array('moneda', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tarifa_menor, id_tarifa, id_categoria, edad_min, edad_max, precio_neto, iva, precio_publico, moneda, last_updated', 'safe', 'on'=>'search'),
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
			'id_tarifa_menor' => 'Id Tarifa Menor',
			'id_tarifa' => 'Id Tarifa',
			'id_categoria' => 'Id Categoria',
			'edad_min' => 'Edad Min',
			'edad_max' => 'Edad Max',
			'precio_neto' => 'Precio Neto',
			'iva' => 'Iva',
			'precio_publico' => 'Precio Publico',
			'moneda' => 'Moneda',
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

		$criteria->compare('id_tarifa_menor',$this->id_tarifa_menor);
		$criteria->compare('id_tarifa',$this->id_tarifa);
		$criteria->compare('id_categoria',$this->id_categoria);
		$criteria->compare('edad_min',$this->edad_min);
		$criteria->compare('edad_max',$this->edad_max);
		$criteria->compare('precio_neto',$this->precio_neto);
		$criteria->compare('iva',$this->iva);
		$criteria->compare('precio_publico',$this->precio_publico);
		$criteria->compare('moneda',$this->moneda,true);
		$criteria->compare('last_updated',$this->last_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TarifasMenores the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
