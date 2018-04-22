<?php

/**
 * This is the model class for table "hmo_form".
 *
 * The followings are the available columns in table 'hmo_form':
 * @property string $id
 * @property string $hmo_billing_id
 * @property integer $hmo_id
 * @property string $patient_id
 * @property string $patient_name
 * @property string $entry_date
 * @property string $avail_date
 * @property string $control_no
 * @property string $card_no
 * @property float $form_total
 * The followings are the available model relations:
 * @property Hmo $hmo
 * @property Patient $patient
 * @property HmoFormItems[] $hmoFormItems
 */
class HmoForm extends CActiveRecord
{
    public $hmo_billing_date;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HmoForm the static model class
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
		return 'hmo_form';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hmo_id, hmo_name, patient_id, patient_name, entry_date, avail_date', 'required'),
			array('hmo_id', 'numerical', 'integerOnly'=>true),
			array('hmo_billing_id, patient_id', 'length', 'max'=>20),
			array('patient_name', 'length', 'max'=>250),
			array('control_no, card_no', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, hmo_billing_id, hmo_id, patient_id, patient_name, entry_date, avail_date, control_no, card_no', 'safe', 'on'=>'search'),
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
			'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
			'hmoFormItems' => array(self::HAS_MANY, 'HmoFormItems', 'hmo_form_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hmo_billing_id' => 'Hmo Billing Id',
			'hmo_id' => 'HMO Id',
            'hmo_name' => 'HMO Company',            
			'patient_id' => 'Patient Id',
			'patient_name' => 'Patient Name',
			'entry_date' => 'Entry Date',
			'avail_date' => 'Avail Date',
			'control_no' => 'Control No',
			'card_no' => 'Card No',
            'form_total' => 'Total',
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
		$criteria->compare('hmo_billing_id',$this->hmo_billing_id,true);
		$criteria->compare('hmo_id',$this->hmo_id,true);
        $criteria->compare('hmo_name',$this->hmo_name,true); 
		$criteria->compare('patient_id',$this->patient_id,true);
		$criteria->compare('patient_name',$this->patient_name,true);
		$criteria->compare('entry_date',$this->entry_date,true);
		$criteria->compare('avail_date',$this->avail_date,true);
		$criteria->compare('control_no',$this->control_no,true);
		$criteria->compare('card_no',$this->card_no,true);
		$criteria->order = 'id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,     
             'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}