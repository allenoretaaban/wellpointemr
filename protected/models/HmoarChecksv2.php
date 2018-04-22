<?php

/**
 * This is the model class for table "hmoar_checks".
 *
 * The followings are the available columns in table 'hmoar_checks':
 * @property string $checkid
 * @property string $check_no
 * @property string $check_date
 * @property string $check_clear_date
 * @property integer $bank_id
 * @property integer $hmo_id
 * @property string $payto
 * @property string $pay_doc_name
 * @property integer $pay_doc_id
 * @property double $check_amnt
 * @property double $billed_amnt
 * @property double $wtax_amnt
 * @property double $provider_xces
 * @property double $member_xces
 * @property double $hmo_xces
 * @property string $hmo_xces_rem
 * @property double $misc_xces
 * @property string $misc_xces_rem
 * @property string test
 * $property string entry_date
 */
class HmoarChecks extends CActiveRecord
{
    public $applied_amnt;
    public $applied_wtax;
    public $custom_links;
    public $entry_date;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HmoarChecks the static model class
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
		return 'hmoar_checks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('check_no, check_date, entry_date, bank_id, hmo_id, payto, check_amnt, billed_amnt', 'required'),
			array('bank_id, hmo_id, pay_doc_id', 'numerical', 'integerOnly'=>true),
			array('check_amnt, billed_amnt, wtax_amnt, provider_xces, member_xces, hmo_xces, misc_xces', 'numerical'),
			array('check_no, payto, pay_doc_name,hmo_xces_rem,misc_xces_rem', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('checkid, check_no, check_date, entry_date, bank_id, hmo_id, payto, pay_doc_id, pay_doc_name, check_amnt, billed_amnt, wtax_amnt, provider_xces, member_xces, hmo_xces, hmo_xces_rem', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'checkid' => 'Checkid',
			'check_no' => 'Check No',
			'check_date' => 'Check Date',
            'entry_date' => 'Entry Date',            
			'check_clear_date' => 'Check Clear Date',
			'bank_id' => 'Bank',
			'hmo_id' => 'Hmo',
			'payto' => 'Payto',
			'pay_doc_id' => 'Pay Doc Id',
            'pay_doc_name' => 'Doctor',
			'check_amnt' => 'Check Amnt',
			'billed_amnt' => 'Billed Amnt',
			'wtax_amnt' => 'Wtax',
            'provider_xces' => 'Provider Excess',
            'member_xces' => 'Member Excess',
            'hmo_xces' => 'HMO Excess',
            'hmo_xces_rem' => 'HMO Excess Remarks',            
            'misc_xces' => 'Misc. Excess',
            'misc_xces_rem' => 'Misc. Excess Remarks',            
            'applied_amnt' => 'Applied Amnt',
            'applied_wtax' => 'Applied Wtax',
            'custom_links' => ' ',
            
            
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

		$criteria->compare('checkid',$this->checkid,true);
		$criteria->compare('check_no',$this->check_no,true);
		$criteria->compare('check_date',$this->check_date,true);
        $criteria->compare('entry_date',$this->check_date,true);        
		$criteria->compare('check_clear_date',$this->check_clear_date,true);
		$criteria->compare('bank_id',$this->bank_id);
		$criteria->compare('hmo_id',$this->hmo_id);
		$criteria->compare('payto',$this->payto,true);
		$criteria->compare('pay_doc_id',$this->pay_doc_id);
        $criteria->compare('pay_doc_name',$this->pay_doc_name);
		$criteria->compare('check_amnt',$this->check_amnt);
		$criteria->compare('billed_amnt',$this->billed_amnt);
		$criteria->compare('wtax_amnt',$this->wtax_amnt);
        $criteria->compare('provider_xces',$this->provider_xces);
        $criteria->compare('member_xces',$this->member_xces);
        $criteria->compare('hmo_xces',$this->hmo_xces);
        $criteria->compare('hmo_xces_rem',$this->hmo_xces_rem);
        $criteria->compare('misc_xces',$this->hmo_xces);
        $criteria->compare('misc_xces_rem',$this->hmo_xces_rem);
        $criteria->order = 'checkid desc';       

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}