<?php

/**
 * This is the model class for table "invoice_item".
 *
 * The followings are the available columns in table 'invoice_item':
 * @property string $id
 * @property string $description
 * @property double $total
 * @property double $amount
 * @property integer $isvatable
 * @property string $discount
 * @property double $discountflat
 * @property double $discountpercentage
 * @property string $invoice_id
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 */
class InvoiceItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InvoiceItem the static model class
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
		return 'invoice_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('description, total, amount, isvatable, invoice_id', 'required'),
			array('total, amount, discountflat, discountpercentage', 'numerical'),
			array('description, discount', 'length', 'max'=>128),
			array('invoice_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, description, total, amount, isvatable, discount, discountflat, discountpercentage, invoice_id', 'safe', 'on'=>'search'),
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
			'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoice_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'description' => 'Description',
			'total' => 'Total',
			'amount' => 'Amount',
            'isvatable' => 'Is Vatable',
			'discount' => 'Discount',
			'discountflat' => 'Flat',
			'discountpercentage' => 'Percentage',
			'invoice_id' => 'Invoice',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('amount',$this->amount);
        $criteria->compare('isvatable',$this->isvatable);
		$criteria->compare('discount',$this->discount,true);
		$criteria->compare('discountflat',$this->discountflat);
		$criteria->compare('discountpercentage',$this->discountpercentage);
		$criteria->compare('invoice_id',$this->invoice_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}