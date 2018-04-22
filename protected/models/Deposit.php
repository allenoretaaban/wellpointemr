<?php

/**
 * This is the model class for table "deposit".
 *
 * The followings are the available columns in table 'deposit':
 * @property string $id
 * @property string $date
 * @property string $description
 * @property double $amount
 * @property string $category
 * @property string $type
 * @property string $checkno
 * @property string $checkdate
 * @property string $checkbank
 * @property string $preparedby
 */
class Deposit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Deposit the static model class
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
		return 'deposit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, description, amount, category, type', 'required'),
			array('amount', 'numerical'),
			array('description, preparedby, checkdate', 'length', 'max'=>128),
            array('type', 'length', 'max'=>16),
			array('category, checkno', 'length', 'max'=>32),
            array('checkbank', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, description, amount, category, type, checkno, checkdate, checkbank, preparedby', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
			'description' => 'Description',
			'amount' => 'Amount',
			'category' => 'Category',
            'type' => 'Type',
            'checkno' => 'Check No.',
            'checkdate' => 'Check Date',
            'checkbank' => 'Check Bank',
			'preparedby' => 'Preparedby',
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
		$criteria->compare('date',$this->date,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('category',$this->category,true);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('checkno',$this->checkno,true);
        $criteria->compare('checkdate',$this->checkdate,true);
        $criteria->compare('checkbank',$this->checkbank,true);
		$criteria->compare('preparedby',$this->preparedby,true);
		$criteria->order='id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}