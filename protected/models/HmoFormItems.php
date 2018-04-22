<?php

/**
 * This is the model class for table "hmo_form_items".
 *
 * The followings are the available columns in table 'hmo_form_items':
 * @property string $itemid
 * @property string $hmo_form_id
 * @property string $item_entry_date
 * @property string $item_avail_date
 * @property string $payto
 * @property integer $claim_doctor_id
 * @property string $claim_doctor_name
 * @property string $diagnosis
 * @property string $med_service
 * @property string $service_type
 * @property string $req_doctor
 * @property string $charge_type
 * @property double $charge_fee
 * @property integer $isapplied
 *
 * The followings are the available model relations:
 * @property HmoForm $hmoForm
 */
class HmoFormItems extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HmoFormItems the static model class
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
		return 'hmo_form_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payto, diagnosis, med_service, service_type, charge_type, charge_fee', 'required'),
			array('claim_doctor_id', 'numerical', 'integerOnly'=>true),
			array('charge_fee', 'numerical'),
			array('hmo_form_id', 'length', 'max'=>20),
			array('payto, charge_type', 'length', 'max'=>50),
			array('claim_doctor_name, diagnosis, med_service, req_doctor', 'length', 'max'=>250),
			array('service_type', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, itemid, hmo_form_id, item_entry_date, item_avail_date, payto, claim_doctor_id, claim_doctor_name, diagnosis, med_service, service_type, req_doctor, charge_type, charge_fee, isapplied, double_transaction_tag', 'safe', 'on'=>'search'),
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
			'hmoForm' => array(self::BELONGS_TO, 'HmoForm', 'hmo_form_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'itemid' => 'Itemid',
			'hmo_form_id' => 'Hmo Form',
			'item_entry_date' => 'Item Entry Date',
			'item_avail_date' => 'Item Avail Date',
			'payto' => 'Payable To',
			'claim_doctor_id' => 'Doctor',
			'claim_doctor_name' => 'Doctor Name',
			'diagnosis' => 'Diagnosis',
			'med_service' => 'Medical Service',
			'service_type' => 'Service Type',
			'req_doctor' => 'Requesting Physician (If Diagnostic)',
			'charge_type' => 'Charge Type',
			'charge_fee' => 'Charge Fee',
            'isapplied' => 'Paid',
            
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

		$criteria->compare('itemid',$this->itemid,true);
		$criteria->compare('hmo_form_id',$this->hmo_form_id,true);
		$criteria->compare('item_entry_date',$this->item_entry_date,true);
		$criteria->compare('item_avail_date',$this->item_avail_date,true);
		$criteria->compare('payto',$this->payto,true);
		$criteria->compare('claim_doctor_id',$this->claim_doctor_id);
		$criteria->compare('claim_doctor_name',$this->claim_doctor_name,true);
		$criteria->compare('diagnosis',$this->diagnosis,true);
		$criteria->compare('med_service',$this->med_service,true);
		$criteria->compare('service_type',$this->service_type,true);
		$criteria->compare('req_doctor',$this->req_doctor,true);
		$criteria->compare('charge_type',$this->charge_type,true);
		$criteria->compare('charge_fee',$this->charge_fee);
        $criteria->compare('isapplied',$this->isapplied);
        $criteria->with(array('hmoForm'=>array('joinType'=>'LEFT JOIN')));
        

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}