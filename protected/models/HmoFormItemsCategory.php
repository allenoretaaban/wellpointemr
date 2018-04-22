<?php

/**
 * This is the model class for table "hmo_form_items_category".
 *
 * The followings are the available columns in table 'hmo_form_items_category':
 * @property string $itemid
 * @property string $hmo_form_item_id
 * @property string $med_service
 * @property double $amount
 * @property string $category
 */
class HmoFormItemsCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HmoFormItemsCategory the static model class
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
		return 'hmo_form_items_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('amount', 'numerical'),
			array('hmo_form_item_id', 'length', 'max'=>20),
			array('med_service', 'length', 'max'=>250),
			array('category', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('itemid, hmo_form_item_id, med_service, amount, category', 'safe', 'on'=>'search'),
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
			'itemid' => 'Itemid',
			'hmo_form_item_id' => 'Hmo Form Item',
			'med_service' => 'Med Service',
			'amount' => 'Amount',
			'category' => 'Category',
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
		$criteria->compare('hmo_form_item_id',$this->hmo_form_item_id,true);
		$criteria->compare('med_service',$this->med_service,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('category',$this->category,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}