<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property string $id
 * @property string $orno
 * @property string $date
 * @property double $subtotal
 * @property double $vatexemptsale
 * @property double $total
 * @property string $preparedby
 * @property string $patientname
 * @property string $patient_id
 * @property string $subtotal_discount
 * @property string $subtotal_vat
 * @property string $vatexemptsale_discount
 * The followings are the available model relations:
 * @property InvoiceDiscount[] $invoiceDiscounts
 * @property InvoiceItem[] $invoiceItems
 * @property Patient $patient
 */
class Invoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
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
		return 'invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date', 'required'),
			array('subtotal, vatexemptsale, total', 'numerical'),
			array('orno', 'length', 'max'=>32),
			array('preparedby, patientname', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, orno, date, subtotal, vatexemptsale, total, preparedby, patientname', 'safe', 'on'=>'search'),
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
			'invoiceDiscounts' => array(self::HAS_MANY, 'InvoiceDiscount', 'invoice_id'),
			'invoiceItems' => array(self::HAS_MANY, 'InvoiceItem', 'invoice_id'),
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
			'orno' => 'OR No.',
			'date' => 'Date',
			'subtotal' => 'Sub Total (Vat applies)',
			'vatexemptsale' => 'VAT Exempt Sale',
			'total' => 'Total',
			'preparedby' => 'Prepared By',
            'patientname' => 'Patient Name',
            'patient_id' => 'Patient Id',
            'subtotal_discount' => 'Discount on Subtotal',
            'subtotal_vat' => 'Vat (After Discount)',
            'vatexemptsale_discount' => 'Discount on vat exempt sale',
           
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
		$criteria->compare('orno',$this->orno,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('subtotal',$this->subtotal);
		$criteria->compare('vatexemptsale',$this->vatexemptsale);
		$criteria->compare('total',$this->total);
		$criteria->compare('preparedby',$this->preparedby,true);
		$criteria->compare('patientname',$this->patientname,true);
		$criteria->compare('patient_id',$this->patient_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}