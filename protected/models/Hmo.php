<?php

/**
 * This is the model class for table "Hmo".
 *
 * The followings are the available columns in table 'Hmo':
 * @property integer $id
 * @property string $name
 * @property string $street1
 * @property string $street2
 * @property string $barangay
 * @property string $city
 * @property string $province
 *
 * The followings are the available model relations:
 * @property HmoContact[] $hmoContacts
 * @property Pds[] $pds
 */
class Hmo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Hmo the static model class
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
		return 'Hmo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>128),
			array('street1, street2', 'length', 'max'=>64),
			array('barangay, city, province', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, street1, street2, barangay, city, province', 'safe', 'on'=>'search'),
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
			'hmoContacts' => array(self::HAS_MANY, 'HmoContact', 'hmo_id'),
			'pds' => array(self::HAS_MANY, 'Pds', 'hmo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'street1' => 'Street 1',
			'street2' => 'Street 2',
			'barangay' => 'Barangay',
			'city' => 'City',
			'province' => 'Province',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('street1',$this->street1,true);
		$criteria->compare('street2',$this->street2,true);
		$criteria->compare('barangay',$this->barangay,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('province',$this->province,true);
		$criteria->order='name';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}