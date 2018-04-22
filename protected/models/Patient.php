<?php

/**
 * This is the model class for table "Patient".
 *
 * The followings are the available columns in table 'Patient':
 * @property string $id
 * @property string $filename
 * @property string $firstname
 * @property string $lastname
 * @property string $middleinitial
 * @property string $gender
 * @property string $birthdate
 * @property string $civilstatus
 * @property string $street1
 * @property string $street2
 * @property string $barangay
 * @property string $city
 * @property string $province
 * @property string $mobile_no
 * @property string $tel_no
 * @property string $email
 * @property string $occupation
 * @property string $company
 * @property string $spousename
 * @property string $spouseoccupation
 * @property string $emergencycontactname
 * @property string $emergencycontactrelation
 * @property string $emergencycontactaddress
 * @property string $emergencycontactnos
 * @property string $positionapplyingfor
 *
 * The followings are the available model relations:
 * @property PatientChronicillness[] $patientChronicillnesses
 * @property PatientContact[] $patientContacts
 * @property PatientFamilyhistory[] $patientFamilyhistories
 * @property PatientMedicalstatus[] $patientMedicalstatuses
 * @property PatientObgyne[] $patientObgynes
 * @property PatientObstetrical[] $patientObstetricals
 * @property PatientPregnancyproblem[] $patientPregnancyproblems
 * @property PatientPresentillness[] $patientPresentillnesses
 * @property PatientVaccination[] $patientVaccinations
 * @property PatientVitalsign[] $patientVitalsigns
 * @property Pds[] $pds
 */
class Patient extends CActiveRecord
{
        public $image;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Patient the static model class
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
		return 'Patient';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, gender, birthdate, civilstatus', 'required'),
			array('civilstatus', 'length', 'max'=>16),
			array('firstname, lastname, street1, street2', 'length', 'max'=>64),
			array('middleinitial, gender', 'length', 'max'=>1),
			array('barangay, city, province, mobile_no, tel_no, email, occupation, spouseoccupation, emergencycontactrelation', 'length', 'max'=>32),
			array('filename, company, spousename, emergencycontactname, emergencycontactnos', 'length', 'max'=>128),
			array('emergencycontactaddress', 'length', 'max'=>256),
            array('positionapplyingfor', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, code, firstname, lastname, middleinitial, gender, birthdate, civilstatus, street1, street2, barangay, city, province, occupation, company, spousename, spouseoccupation, emergencycontactname, emergencycontactrelation, emergencycontactaddress, emergencycontactnos', 'safe', 'on'=>'search'),
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
			'patientChronicillnesses' => array(self::HAS_MANY, 'PatientChronicillness', 'patient_id'),
			'patientContacts' => array(self::HAS_MANY, 'PatientContact', 'patient_id'),
			'patientFamilyhistories' => array(self::HAS_MANY, 'PatientFamilyhistory', 'patient_id'),
			'patientMedicalstatuses' => array(self::HAS_MANY, 'PatientMedicalstatus', 'patient_id'),
			'patientObstetricals' => array(self::HAS_MANY, 'PatientObstetrical', 'patient_id'),
			'patientPregnancyproblems' => array(self::HAS_MANY, 'PatientPregnancyproblem', 'patient_id'),
			'patientPresentillnesses' => array(self::HAS_MANY, 'PatientPresentillness', 'patient_id'),
			'patientVaccinations' => array(self::HAS_MANY, 'PatientVaccination', 'patient_id'),
			'pds' => array(self::HAS_MANY, 'Pds', 'patient_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'image' => 'Picture',
            'filename' => 'Filename',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'middleinitial' => 'Middle Initial',
			'gender' => 'Gender',
			'birthdate' => 'Birth Date',
			'civilstatus' => 'Civil Status',
			'street1' => 'Street 1',
			'street2' => 'Street 2',
			'barangay' => 'Barangay',
			'city' => 'City',
			'province' => 'Province',
            'mobile_no' => 'Mobile No.',   
            'tel_no' => 'Tel No.',   
            'email' => 'e-Mail',   
			'occupation' => 'Occupation',
            'positionapplyingfor' => 'Position Applying For',
			'company' => 'Company',
			'spousename' => 'Spouse Name',
			'spouseoccupation' => 'Spouse Occupation',
			'emergencycontactname' => 'Incase of Emergency Contact Person',
			'emergencycontactrelation' => 'Relation',
			'emergencycontactaddress' => 'Address',
			'emergencycontactnos' => 'Contact No',
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
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('middleinitial',$this->middleinitial,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('civilstatus',$this->civilstatus,true);
		$criteria->compare('street1',$this->street1,true);
		$criteria->compare('street2',$this->street2,true);
		$criteria->compare('barangay',$this->barangay,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('occupation',$this->occupation,true);
        $criteria->compare('positionapplyingfor',$this->positionapplyingfor,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('spousename',$this->spousename,true);
		$criteria->compare('spouseoccupation',$this->spouseoccupation,true);
		$criteria->compare('emergencycontactname',$this->emergencycontactname,true);
		$criteria->compare('emergencycontactrelation',$this->emergencycontactrelation,true);
		$criteria->compare('emergencycontactaddress',$this->emergencycontactaddress,true);
		$criteria->compare('emergencycontactnos',$this->emergencycontactnos,true);
        $criteria->order='id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                        'pageSize'=>50,
                    ),
		));
        
        
	}
}