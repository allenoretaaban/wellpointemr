<?php

/**
 * This is the model class for table "hmo_contact".
 *
 * The followings are the available columns in table 'hmo_contact':
 * @property string $id
 * @property string $number
 * @property string $type
 * @property integer $hmo_id
 *
 * The followings are the available model relations:
 * @property Hmo $hmo
 */
class HmoContact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HmoContact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'hmo_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, type, hmo_id', 'required'),
			array('hmo_id', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>20),
			array('number, type', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, type, hmo_id', 'safe', 'on'=>'search'),
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
			'hmo' => array(self::BELONGS_TO, 'Hmo', 'hmo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Number',
			'type' => 'Type',
			'hmo_id' => 'HMO',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('hmo_id',$this->hmo_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}