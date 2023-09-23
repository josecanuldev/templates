<?php

/**
 * This is the model class for table "tarifas".
 *
 * The followings are the available columns in table 'tarifas':
 * @property integer $id_tarifa
 * @property integer $id_ruta
 * @property integer $id_tipo_tarifa
 * @property string $nombre_tarifa
 * @property string $codigo
 * @property string $fecha_inicio
 * @property string $fecha_final
 * @property string $moneda
 * @property double $tipo_cambio
 * @property integer $estatus
 * @property integer $no_reembosable
 * @property string $restricciones
 * @property string $terminoscondiciones
 * @property string $politicas_cancelacion
 * @property integer $id_tipoviaje
 * @property string $last_updated
 */
class Tarifas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tarifas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_ruta, nombre_tarifa, fecha_inicio, fecha_final, moneda, id_tipoviaje', 'required'),
			array('id_ruta, id_tipo_tarifa, id_agencia, estatus, no_reembosable, id_tipoviaje', 'numerical', 'integerOnly'=>true),
			array('tipo_cambio', 'numerical'),
			array('nombre_tarifa, codigo', 'length', 'max'=>255),
			array('moneda', 'length', 'max'=>10),
			array('restricciones, terminoscondiciones, politicas_cancelacion, observaciones', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tarifa, id_ruta, id_tipo_tarifa, id_agencia, nombre_tarifa, codigo, fecha_inicio, fecha_final, moneda, tipo_cambio, estatus, no_reembosable, restricciones, terminoscondiciones, politicas_cancelacion, observaciones, id_tipoviaje, last_updated', 'safe', 'on'=>'search'),
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
			'idTipoViaje' => array(self::BELONGS_TO, 'Tipoviaje', 'id_tipoviaje'),
			'idRuta' => array(self::BELONGS_TO, 'Rutas', 'id_ruta')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tarifa' => 'Id Tarifa',
			'id_ruta' => 'Ruta',
			'id_tipo_tarifa' => 'Tipo de Tarifa',
			'nombre_tarifa' => 'Nombre Tarifa',
			'id_agencia' => 'Agencia',
			'codigo' => 'Codigo',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_final' => 'Fecha Final',
			'moneda' => 'Moneda',
			'tipo_cambio' => 'Tipo de Cambio',
			'estatus' => 'Estatus',
			'no_reembosable' => 'No Reembosable',
			'restricciones' => 'Restricciones',
			'terminoscondiciones' => 'Terminos y condiciones',
			'politicas_cancelacion' => 'Politicas de Cancelación',
			'observaciones' => 'Información Adicional',
			'id_tipoviaje' => 'Tipo de viaje',
			'last_updated' => 'Ultima actualización',
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

		$criteria->compare('id_tarifa',$this->id_tarifa);
		$criteria->compare('id_ruta',$this->id_ruta);
		$criteria->compare('id_tipo_tarifa',$this->id_tipo_tarifa);
		$criteria->compare('nombre_tarifa',$this->nombre_tarifa,true);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_final',$this->fecha_final,true);
		$criteria->compare('moneda',$this->moneda,true);
		$criteria->compare('tipo_cambio',$this->tipo_cambio);
		$criteria->compare('estatus',$this->estatus);
		$criteria->compare('no_reembosable',$this->no_reembosable);
		$criteria->compare('restricciones',$this->restricciones,true);
		$criteria->compare('terminoscondiciones',$this->terminoscondiciones,true);
		$criteria->compare('politicas_cancelacion',$this->politicas_cancelacion,true);
		$criteria->compare('id_tipoviaje',$this->id_tipoviaje);
		$criteria->compare('last_updated',$this->last_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tarifas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
