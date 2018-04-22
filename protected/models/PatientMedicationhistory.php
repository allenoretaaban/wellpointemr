<?php

/**
 * This is the model class for table "patient_medicationhistory".
 *
 * The followings are the available columns in table 'patient_medicationhistory':
 * @property string $id
 * @property string $drugortherapy
 * @property integer $presentFlag
 * @property string $presentAsOfDate
 * @property string $patient_id
 *
 * The followings are the available model relations:
 * @property Patient $patient
 */
class PatientMedicationhistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientMedicationhistory the static model class
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
		return 'patient_medicationhistory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('drugortherapy, presentFlag, patient_id', 'required'),
			array('presentFlag', 'numerical', 'integerOnly'=>true),
			array('drugortherapy', 'length', 'max'=>128),
			array('patient_id', 'length', 'max'=>20),
			array('presentAsOfDate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, drugortherapy, presentFlag, presentAsOfDate, patient_id', 'safe', 'on'=>'search'),
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
			'drugortherapy' => 'Drug/Therapy',
			'presentFlag' => 'Present',
			'presentAsOfDate' => 'As Of',
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
		$criteria->compare('drugortherapy',$this->drugortherapy,true);
		$criteria->compare('presentFlag',$this->presentFlag);
		$criteria->compare('presentAsOfDate',$this->presentAsOfDate,true);
		$criteria->compare('patient_id',$this->patient_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}