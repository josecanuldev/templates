<?php

/**
 * This is the model class for table "rutas".
 *
 * The followings are the available columns in table 'rutas':
 * @property integer $id_ruta
 * @property integer $id_origen
 * @property integer $id_destino
 * @property integer $menor_paga
 * @property integer $edad_menor_paga
 * @property string $last_updated
 */
class Rutas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rutas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_origen, id_destino, menor_paga', 'required'),
			array('id_origen, id_destino, menor_paga, edad_menor_paga', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_ruta, id_origen, id_destino, menor_paga, edad_menor_paga, last_updated', 'safe', 'on'=>'search'),
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
			'Origen' => array(self::BELONGS_TO, 'Arrivals', 'id_origen'),
			'Destino' => array(self::BELONGS_TO, 'Arrivals', 'id_destino')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_ruta' => 'Id Ruta',
			'id_origen' => 'Id Origen',
			'id_destino' => 'Id Destino',
			'menor_paga' => 'Menor Paga',
			'edad_menor_paga' => 'Edad Menor Paga',
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

		$criteria->compare('id_ruta',$this->id_ruta);
		$criteria->compare('id_origen',$this->id_origen);
		$criteria->compare('id_destino',$this->id_destino);
		$criteria->compare('menor_paga',$this->menor_paga);
		$criteria->compare('edad_menor_paga',$this->edad_menor_paga);
		$criteria->compare('last_updated',$this->last_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rutas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
