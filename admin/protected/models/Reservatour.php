<?php

/**
 * This is the model class for table "reservatour".
 *
 * The followings are the available columns in table 'reservatour':
 * @property integer $idreserva
 * @property integer $folio
 * @property integer $idExperiencia
 * @property string $id_agencia
 * @property string $id_driver
 * @property string $referencia
 * @property string $pasajeros
 * @property string $tipoViaje
 * @property string $fechaLLegada
 * @property string $horarioLLegada
 * @property string $fechaSalida
 * @property string $horarioSalida
 * @property string $horarioPickup
 * @property string $id_arrivals_from
 * @property string $id_arrivals_to
 * @property string $desde
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property string $telefono
 * @property string $pais
 * @property string $ciudad
 * @property string $idioma
 * @property string $fechaReservacion
 * @property string $concepto
 * @property string $conceptoEn
 * @property string $aerolineaLlegada
 * @property string $vueloLlegada
 * @property string $aerolinea
 * @property string $numeroVuelo
 * @property string $datePrivada
 * @property string $horaPrivada
 * @property string $abordaje
 * @property string $tipoVuelo
 * @property string $tipoPrivadoEstandar
 * @property string $hotel
 * @property string $hotelSalida
 * @property string $inverso
 * @property string $estatus
 * @property string $observaciones
 */
class Reservatour extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reservatour';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('idExperiencia, pasajeros, tipoViaje, desde, nombre, apellido, idioma, fechaReservacion, tipoVuelo, tipoPrivadoEstandar', 'required'),
			array('idExperiencia', 'numerical', 'integerOnly'=>true),
			array('id_agencia, id_driver, id_arrivals_from, id_arrivals_to, numeroVuelo, datePrivada, horaPrivada, tipoPrivadoEstandar', 'length', 'max'=>20),
			array('referencia, hotel, hotelSalida', 'length', 'max'=>255),
			array('pasajeros, tipoViaje, fechaLLegada, horarioLLegada, fechaSalida, horarioSalida, telefono, pais, ciudad, fechaReservacion, abordaje, tipoVuelo', 'length', 'max'=>30),
			array('horarioPickup, nombre, apellido, correo, concepto, conceptoEn, aerolinea', 'length', 'max'=>50),
			array('desde', 'length', 'max'=>300),
			array('idioma, estatus', 'length', 'max'=>10),
			array('aerolineaLlegada, vueloLlegada', 'length', 'max'=>200),
			array('inverso', 'length', 'max'=>15),
			array('observaciones', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idreserva, idExperiencia, id_agencia, id_driver, referencia, pasajeros, tipoViaje, fechaLLegada, horarioLLegada, fechaSalida, horarioSalida, horarioPickup, id_arrivals_from, id_arrivals_to, desde, nombre, apellido, correo, telefono, pais, ciudad, idioma, fechaReservacion, concepto, conceptoEn, aerolineaLlegada, vueloLlegada, aerolinea, numeroVuelo, datePrivada, horaPrivada, abordaje, tipoVuelo, tipoPrivadoEstandar, hotel, hotelSalida, inverso, estatus, observaciones', 'safe', 'on'=>'search'),
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
			'idArrivalsFrom' => array(self::BELONGS_TO, 'Arrivals', 'id_arrivals_from'),
			'idArrivalsTo' => array(self::BELONGS_TO, 'Arrivals', 'id_arrivals_to'),
			'idAgencia' => array(self::BELONGS_TO, 'Agencies', 'id_agencia'),
			'idOperador' => array(self::BELONGS_TO, 'Drivers', 'id_driver'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idreserva' => 'Idreserva',
			'idExperiencia' => 'Id Experiencia',
			'id_agencia' => 'Id Agencia',
			'id_driver' => 'Id Driver',
			'referencia' => 'Referencia',
			'pasajeros' => 'Pasajeros',
			'tipoViaje' => 'Tipo Viaje',
			'fechaLLegada' => 'Fecha Llegada',
			'horarioLLegada' => 'Horario Llegada',
			'fechaSalida' => 'Fecha Salida',
			'horarioSalida' => 'Horario Salida',
			'horarioPickup' => 'Horario Pickup',
			'id_arrivals_from' => 'Id Arrivals From',
			'id_arrivals_to' => 'Id Arrivals To',
			'desde' => 'Desde',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'correo' => 'Correo',
			'telefono' => 'Telefono',
			'pais' => 'Pais',
			'ciudad' => 'Ciudad',
			'idioma' => 'Idioma',
			'fechaReservacion' => 'Fecha Reservacion',
			'concepto' => 'Concepto',
			'conceptoEn' => 'Concepto En',
			'aerolineaLlegada' => 'Aerolinea Llegada',
			'vueloLlegada' => 'Vuelo Llegada',
			'aerolinea' => 'Aerolinea',
			'numeroVuelo' => 'Numero Vuelo',
			'datePrivada' => 'Date Privada',
			'horaPrivada' => 'Hora Privada',
			'abordaje' => 'Abordaje',
			'tipoVuelo' => 'Tipo Vuelo',
			'tipoPrivadoEstandar' => 'Tipo Privado Estandar',
			'hotel' => 'Hotel',
			'hotelSalida' => 'Hotel Salida',
			'inverso' => 'Inverso',
			'estatus' => 'Estatus',
			'observaciones' => 'Observaciones',
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

		$criteria->compare('idreserva',$this->idreserva);
		$criteria->compare('idExperiencia',$this->idExperiencia);
		$criteria->compare('id_agencia',$this->id_agencia,true);
		$criteria->compare('id_driver',$this->id_driver,true);
		$criteria->compare('referencia',$this->referencia,true);
		$criteria->compare('pasajeros',$this->pasajeros,true);
		$criteria->compare('tipoViaje',$this->tipoViaje,true);
		$criteria->compare('fechaLLegada',$this->fechaLLegada,true);
		$criteria->compare('horarioLLegada',$this->horarioLLegada,true);
		$criteria->compare('fechaSalida',$this->fechaSalida,true);
		$criteria->compare('horarioSalida',$this->horarioSalida,true);
		$criteria->compare('horarioPickup',$this->horarioPickup,true);
		$criteria->compare('id_arrivals_from',$this->id_arrivals_from,true);
		$criteria->compare('id_arrivals_to',$this->id_arrivals_to,true);
		$criteria->compare('desde',$this->desde,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('pais',$this->pais,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('idioma',$this->idioma,true);
		$criteria->compare('fechaReservacion',$this->fechaReservacion,true);
		$criteria->compare('concepto',$this->concepto,true);
		$criteria->compare('conceptoEn',$this->conceptoEn,true);
		$criteria->compare('aerolineaLlegada',$this->aerolineaLlegada,true);
		$criteria->compare('vueloLlegada',$this->vueloLlegada,true);
		$criteria->compare('aerolinea',$this->aerolinea,true);
		$criteria->compare('numeroVuelo',$this->numeroVuelo,true);
		$criteria->compare('datePrivada',$this->datePrivada,true);
		$criteria->compare('horaPrivada',$this->horaPrivada,true);
		$criteria->compare('abordaje',$this->abordaje,true);
		$criteria->compare('tipoVuelo',$this->tipoVuelo,true);
		$criteria->compare('tipoPrivadoEstandar',$this->tipoPrivadoEstandar,true);
		$criteria->compare('hotel',$this->hotel,true);
		$criteria->compare('hotelSalida',$this->hotelSalida,true);
		$criteria->compare('inverso',$this->inverso,true);
		$criteria->compare('estatus',$this->estatus,true);
		$criteria->compare('observaciones',$this->observaciones,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reservatour the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
