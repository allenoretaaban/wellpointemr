<?php

/**
 * This is the model class for table "cashvoucher".
 *
 * The followings are the available columns in table 'cashvoucher':
 * @property string $id
 * @property string $no
 * @property string $date
 * @property double $amount
 * @property string $description
 * @property string $receivedby
 * @property string $approvedby
 * @property string $preparedby
 */
class Cashvoucher extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cashvoucher the static model class
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
		return 'cashvoucher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, amount, description, receivedby', 'required'),
			array('amount', 'numerical'),
			array('no', 'length', 'max'=>32),
			array('description, receivedby, approvedby, preparedby', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, no, date, amount, description, receivedby, approvedby, preparedby', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'no' => 'No',
			'date' => 'Date',
			'amount' => 'Amount',
			'description' => 'Description',
			'receivedby' => 'Received By',
			'approvedby' => 'Approved By',
			'preparedby' => 'Prepared By',
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
		$criteria->compare('no',$this->no,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('receivedby',$this->receivedby,true);
		$criteria->compare('approvedby',$this->approvedby,true);
		$criteria->compare('preparedby',$this->preparedby,true);
		$criteria->order = 'id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}