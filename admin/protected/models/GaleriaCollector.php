<?php

/**
 * This is the model class for table "galeriaCollector".
 *
 * The followings are the available columns in table 'galeriaCollector':
 * @property integer $id_galeria
 * @property integer $id
 * @property string $path
 * @property string $titulo
 * @property string $descripcion
 * @property string $ubicacion
 * @property string $log
 */
class GaleriaCollector extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'galeriaCollector';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, path', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('ubicacion', 'length', 'max'=>255),
			array('titulo, descripcion', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_galeria, id, path, titulo, descripcion, ubicacion, log', 'safe', 'on'=>'search'),
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
			'id_galeria' => 'Id Galeria',
			'id' => 'ID',
			'path' => 'Path',
			'titulo' => 'Titulo',
			'descripcion' => 'Descripcion',
			'ubicacion' => 'Ubicacion',
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

		$criteria->compare('id_galeria',$this->id_galeria);
		$criteria->compare('id',$this->id);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('ubicacion',$this->ubicacion,true);
		$criteria->compare('log',$this->log,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GaleriaCollector the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
