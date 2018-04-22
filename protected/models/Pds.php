<?php

/**
 * This is the model class for table "pds".
 *
 * The followings are the available columns in table 'pds':
 * @property string $id
 * @property string $visitreason
 * @property string $datevisited
 * @property string $patient_id
 *
 * The followings are the available model relations:
 * @property Patient $patient
 * @property PdsHmo[] $pdsHmos
 * @property PdsPatientApperance[] $pdsPatientApperances
 * @property PdsPatientEyeexam[] $pdsPatientEyeexams
 * @property PdsPatientObgyne[] $pdsPatientObgynes
 * @property PdsPatientVitalsign[] $pdsPatientVitalsigns
 */
class Pds extends CActiveRecord
{
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pds the static model class
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
		return 'pds';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('visitreason, datevisited, patient_id', 'required'),
			array('patient_id', 'length', 'max'=>20),
			array('doctor, department', 'length', 'max'=>100),
			array('hmo', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, visitreason, datevisited, patient_id', 'safe', 'on'=>'search'),
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
			'pdsHmos' => array(self::HAS_MANY, 'PdsHmo', 'pds_id'),
			'pdsPatientApperances' => array(self::HAS_MANY, 'PdsPatientApperance', 'pds_id'),
			'pdsPatientEyeexams' => array(self::HAS_MANY, 'PdsPatientEyeexam', 'pds_id'),
			'pdsPatientObgynes' => array(self::HAS_MANY, 'PdsPatientObgyne', 'pds_id'),
			'pdsPatientVitalsigns' => array(self::HAS_MANY, 'PdsPatientVitalsign', 'pds_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'visitreason' => 'Reason for Visit',
			'datevisited' => 'Date Visited',
			'patient_id' => 'Patient',
			'doctor' => 'Doctor',
			'department' => 'Department',
			'hmo' => 'HMO',
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
		$criteria->compare('visitreason',$this->visitreason,true);
		$criteria->compare('datevisited',$this->datevisited,true);
		$criteria->compare('doctor',$this->doctor,true);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('hmo',$this->hmo,true);
		$criteria->addCondition('patient_id in (select id from patient where firstname like "%'.$this->patient_id.'%" or lastname like "%'.$this->patient_id.'%")');
        $criteria->order='id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                        'pageSize'=>50,
                    ),
		));
	}
}