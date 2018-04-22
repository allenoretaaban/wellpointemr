<?php

/**
 * This is the model class for table "patient_obstetrical".
 *
 * The followings are the available columns in table 'patient_obstetrical':
 * @property string $id
 * @property string $year
 * @property string $place
 * @property integer $gestage
 * @property string $mannerofdelivery
 * @property double $babyweight
 * @property string $babygender
 * @property string $notes
 * @property string $datecreated
 * @property string $patient_id
 */
class PatientObstetrical extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientObstetrical the static model class
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
		return 'patient_obstetrical';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year, place, gestage, mannerofdelivery, babyweight, babygender, patient_id', 'required'),
			array('gestage', 'numerical', 'integerOnly'=>true),
			array('babyweight', 'numerical'),
			array('year', 'length', 'max'=>4),
			array('place, mannerofdelivery', 'length', 'max'=>128),
			array('babygender', 'length', 'max'=>1),
			array('patient_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, year, place, gestage, mannerofdelivery, babyweight, babygender, notes, patient_id', 'safe', 'on'=>'search'),
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
			'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'year' => 'Year',
			'place' => 'Place',
			'gestage' => 'Gestational Age (Weeks)',
			'mannerofdelivery' => 'Manner of Delivery',
			'babyweight' => 'Baby\'s Weight (kg)',
			'babygender' => 'Baby\'s Gender',
			'notes' => 'Notes',
			'patient_id' => 'Patient',
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
		$criteria->compare('year',$this->year,true);
		$criteria->compare('place',$this->place,true);
		$criteria->compare('gestage',$this->gestage);
		$criteria->compare('mannerofdelivery',$this->mannerofdelivery,true);
		$criteria->compare('babyweight',$this->babyweight);
		$criteria->compare('babygender',$this->babygender,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('patient_id',$this->patient_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}