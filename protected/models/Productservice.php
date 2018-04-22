<?php

/**
 * This is the model class for table "ref_productservice".
 *
 * The followings are the available columns in table 'ref_productservice':
 * @property integer $id
 * @property double $amount
 * @property string $name
 * @property string $type
 * @property string $provider
 * @property integer $isvatable
 */
class Productservice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Productservice the static model class
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
		return 'ref_productservice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amount, name, type, isvatable, provider', 'required'),
			array('isvatable', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('name, provider', 'length', 'max'=>255),
			array('type', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, amount, name, type, isvatable, provider', 'safe', 'on'=>'search'),
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
			'amount' => 'Amount',
			'name' => 'Name',
			'type' => 'Type',
            'provider' => 'Category',
			'isvatable' => 'Is Vatable',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
        $criteria->compare('provider',$this->provider,true);
		$criteria->compare('isvatable',$this->isvatable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
             'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}