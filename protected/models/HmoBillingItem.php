<?php

/**
 * This is the model class for table "hmo_billing_item".
 *
 * The followings are the available columns in table 'hmo_billing_item':
 * @property string $id
 * @property string $hmo_id
 * @property string $hmo
 * @property string $ref_no
 * @property string $avail_date
 * @property string $date_entered
 * @property string $patient_id
 * @property string $patient_name
  @property string $cardno
 * @property string $doctor_id
 * @property string $doctor
 * @property string $diagnosis
 * @property string $medicalservice
 * @property string $charge_type
 * @property double $charge
 * @property string $by_userid
 * @property string $hmo_billing_id
 *
 * The followings are the available model relations:
 * @property HmoBilling $hmoBilling
 */
class HmoBillingItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HmoBillingItem the static model class
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
		return 'hmo_billing_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('patient_id, doctor_id, hmo_id, charge_type, charge', 'required'),     
			array('charge', 'numerical'),
			array('hmo_id, patient_id, doctor_id, charge_type, by_userid', 'length', 'max'=>11),
			array('refno, cardno, approval_code, patient_name, doctor', 'length', 'max'=>150),
			array('hmo, diagnosis, medicalservice', 'length', 'max'=>250),
			array('hmo_billing_id', 'length', 'max'=>20),
			array('avail_date, date_entered', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hmo_id, hmo, cardno, refno,approval_code, avail_date, date_entered, patient_id, patient_name, doctor_id, doctor, diagnosis, medicalservice, charge_type, charge, by_userid, hmo_billing_id', 'safe', 'on'=>'search'),
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
			'hmoBilling' => array(self::BELONGS_TO, 'HmoBilling', 'hmo_billing_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',     
            'hmo_id' => 'HMO',
            'hmo' => 'HMO Company',
            'refno' => 'Control No',
            'approval_code' => 'Approval Code',            
			'avail_date' => 'Avail Date',
			'date_entered' => 'Date Entered',
			'patient_id' => 'Patient',
			'patient_name' => 'Patient Name',
            'cardno' => 'Member Card No',            
			'doctor_id' => 'Doctor',
			'doctor' => 'Doctor',
			'diagnosis' => 'Diagnosis',
			'medicalservice' => 'Medical Service',
			'charge_type' => 'Charge Type',
			'charge' => 'Charge',
			'by_userid' => 'By Userid',
			'hmo_billing_id' => 'Hmo Billing',
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
        //$criteria->compare('hmo_id',$this->hmo_id,true);   
        //$criteria->compare('hmo',$this->hmo,true);   
        $criteria->compare('LOWER(hmo)',strtolower($this->hmo),true);
        $criteria->compare('refno',$this->refno,true);
        $criteria->compare('approval_code',$this->approval_code,true);
		$criteria->compare('avail_date',$this->avail_date,true);
		$criteria->compare('date_entered',$this->date_entered,true);
		$criteria->compare('patient_id',$this->patient_id,true);
		$criteria->compare('patient_name',$this->patient_name,true);
        $criteria->compare('cardno',$this->cardno,true);
		//$criteria->compare('doctor_id',$this->doctor_id,true);
		$criteria->compare('doctor',$this->doctor,true);
		$criteria->compare('diagnosis',$this->diagnosis,true);
		$criteria->compare('medicalservice',$this->medicalservice,true);
		$criteria->compare('charge_type',$this->charge_type,true);
		//$criteria->compare('charge',$this->charge);
		//$criteria->compare('by_userid',$this->by_userid,true);
		//$criteria->compare('hmo_billing_id',$this->hmo_billing_id,true);
        $criteria->order='id desc';   

		return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));
	}
}