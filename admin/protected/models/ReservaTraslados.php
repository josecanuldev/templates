<?php

/**
 * This is the model class for table "{{reserva_traslados}}".
 *
 * The followings are the available columns in table '{{reserva_traslados}}':
 * @property integer $id_reservacion
 * @property string $codigo
 * @property integer $folio
 * @property integer $id_agencia
 * @property integer $id_usuario
 * @property string $fecha_llegada
 * @property string $hora_llegada
 * @property string $aerolinea_llegada
 * @property string $num_vuelo_llegada
 * @property string $fecha_salida
 * @property string $hora_pick_up
 * @property string $hora_vuelo_salida
 * @property string $aerolinea_salida
 * @property string $num_vuelo_salida
 * @property integer $tipo_viaje
 * @property integer $pasajeros
 * @property string $fecha_limite
 * @property string $observaciones
 * @property string $estatus
 * @property string $log
 * @property double $total
 * @property double $saldo
 * @property double $tarifa_agencia
 * @property string $moneda
 * @property integer $manual
 * @property string $motivo_cancelacion
 * @property string $politicas_cancelacion
 */
class ReservaTraslados extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{reserva_traslados}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('folio, id_agencia, id_usuario, tipo_viaje, pasajeros, estatus, log', 'required'),
			array('folio, id_agencia, id_usuario, tipo_viaje, pasajeros, manual', 'numerical', 'integerOnly'=>true),
			array('total, saldo, tarifa_agencia', 'numerical'),
			array('codigo, aerolinea_llegada, num_vuelo_llegada, aerolinea_salida, num_vuelo_salida', 'length', 'max'=>255),
			array('estatus', 'length', 'max'=>1),
			array('moneda', 'length', 'max'=>10),
			array('fecha_llegada, hora_llegada, fecha_salida, hora_pick_up, hora_vuelo_salida, fecha_limite, observaciones, motivo_cancelacion, politicas_cancelacion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_reservacion, codigo, folio, id_agencia, id_usuario, fecha_llegada, hora_llegada, aerolinea_llegada, num_vuelo_llegada, fecha_salida, hora_pick_up, hora_vuelo_salida, aerolinea_salida, num_vuelo_salida, tipo_viaje, pasajeros, fecha_limite, observaciones, estatus, log, total, saldo, tarifa_agencia, moneda, manual, motivo_cancelacion, politicas_cancelacion', 'safe', 'on'=>'search'),
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
			'id_reservacion' => 'Id Reservacion',
			'codigo' => 'Codigo',
			'folio' => 'Folio',
			'id_agencia' => 'Id Agencia',
			'id_usuario' => 'Id Usuario',
			'fecha_llegada' => 'Fecha Llegada',
			'hora_llegada' => 'Hora Llegada',
			'aerolinea_llegada' => 'Aerolinea Llegada',
			'num_vuelo_llegada' => 'Num Vuelo Llegada',
			'fecha_salida' => 'Fecha Salida',
			'hora_pick_up' => 'Hora Pick Up',
			'hora_vuelo_salida' => 'Hora Vuelo Salida',
			'aerolinea_salida' => 'Aerolinea Salida',
			'num_vuelo_salida' => 'Num Vuelo Salida',
			'tipo_viaje' => 'sencillo, redondo',
			'pasajeros' => 'Pasajeros',
			'fecha_limite' => 'Fecha Limite',
			'observaciones' => 'Observaciones',
			'estatus' => 'Estatus',
			'log' => 'Log',
			'total' => 'Total',
			'saldo' => 'Saldo',
			'tarifa_agencia' => 'Tarifa Agencia',
			'moneda' => 'Moneda',
			'manual' => 'Manual',
			'motivo_cancelacion' => 'Motivo Cancelacion',
			'politicas_cancelacion' => 'Politicas Cancelacion',
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

		$criteria->compare('id_reservacion',$this->id_reservacion);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('folio',$this->folio);
		$criteria->compare('id_agencia',$this->id_agencia);
		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('fecha_llegada',$this->fecha_llegada,true);
		$criteria->compare('hora_llegada',$this->hora_llegada,true);
		$criteria->compare('aerolinea_llegada',$this->aerolinea_llegada,true);
		$criteria->compare('num_vuelo_llegada',$this->num_vuelo_llegada,true);
		$criteria->compare('fecha_salida',$this->fecha_salida,true);
		$criteria->compare('hora_pick_up',$this->hora_pick_up,true);
		$criteria->compare('hora_vuelo_salida',$this->hora_vuelo_salida,true);
		$criteria->compare('aerolinea_salida',$this->aerolinea_salida,true);
		$criteria->compare('num_vuelo_salida',$this->num_vuelo_salida,true);
		$criteria->compare('tipo_viaje',$this->tipo_viaje);
		$criteria->compare('pasajeros',$this->pasajeros);
		$criteria->compare('fecha_limite',$this->fecha_limite,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('estatus',$this->estatus,true);
		$criteria->compare('log',$this->log,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('saldo',$this->saldo);
		$criteria->compare('tarifa_agencia',$this->tarifa_agencia);
		$criteria->compare('moneda',$this->moneda,true);
		$criteria->compare('manual',$this->manual);
		$criteria->compare('motivo_cancelacion',$this->motivo_cancelacion,true);
		$criteria->compare('politicas_cancelacion',$this->politicas_cancelacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ReservaTraslados the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
