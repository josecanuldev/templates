<?php

/**
 * This is the model class for table "categoriasdestinos".
 *
 * The followings are the available columns in table 'categoriasdestinos':
 * @property integer $id_categoria
 * @property string $tipo
 * @property string $descripcion
 * @property integer $estatus
 * @property string $last_updated
 */
class Categoriasdestinos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'categoriasdestinos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo, last_updated', 'required'),
			array('estatus', 'numerical', 'integerOnly'=>true),
			array('tipo, descripcion', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_categoria, tipo, descripcion, estatus, last_updated', 'safe', 'on'=>'search'),
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
			'id_categoria' => 'Id Categoria',
			'tipo' => 'Tipo',
			'descripcion' => 'Descripcion',
			'estatus' => 'Estatus',
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

		$criteria->compare('id_categoria',$this->id_categoria);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('estatus',$this->estatus);
		$criteria->compare('last_updated',$this->last_updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Categoriasdestinos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
