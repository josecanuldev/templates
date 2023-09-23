<?php

/**
 * This is the model class for table "experiencia".
 *
 * The followings are the available columns in table 'experiencia':
 * @property integer $idExperiencia
 * @property integer $idUbicacion
 * @property string $imgPortada
 * @property string $urlAmigable
 * @property string $seccion
 * @property integer $status
 * @property string $id_arrivals
 * @property integer $orden
 */
class Experiencia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'experiencia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUbicacion, imgPortada, urlAmigable, seccion, orden', 'required'),
			array('idUbicacion, status, orden', 'numerical', 'integerOnly'=>true),
			array('imgPortada', 'length', 'max'=>250),
			array('urlAmigable', 'length', 'max'=>200),
			array('seccion, id_arrivals', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idExperiencia, idUbicacion, imgPortada, urlAmigable, seccion, status, id_arrivals, orden', 'safe', 'on'=>'search'),
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
			'idExperiencia' => 'Id Experiencia',
			'idUbicacion' => 'Id Ubicacion',
			'imgPortada' => 'Img Portada',
			'urlAmigable' => 'Url Amigable',
			'seccion' => 'Seccion',
			'status' => 'Status',
			'id_arrivals' => 'Id Arrivals',
			'orden' => 'Orden',
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

		$criteria->compare('idExperiencia',$this->idExperiencia);
		$criteria->compare('idUbicacion',$this->idUbicacion);
		$criteria->compare('imgPortada',$this->imgPortada,true);
		$criteria->compare('urlAmigable',$this->urlAmigable,true);
		$criteria->compare('seccion',$this->seccion,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('id_arrivals',$this->id_arrivals,true);
		$criteria->compare('orden',$this->orden);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Experiencia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
