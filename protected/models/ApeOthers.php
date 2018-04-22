<?php

/**
 * This is the model class for table "ape_others".
 *
 * The followings are the available columns in table 'ape_others':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property string $others1
 * @property string $others2
 * @property string $others3
 * @property string $others4
 * @property string $others5
 * @property string $others6
 * @property string $significant_findings
 * @property string $classification
 */
class ApeOthers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ApeOthers the static model class
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
		return 'ape_others';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ape_id, user_id', 'length', 'max'=>20),
			array('username', 'length', 'max'=>100),
			array('update_datetime, others1, others2, others3, others4, others5, others6, significant_findings, classification', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ape_id, user_id, username, update_datetime, others1, others2, others3, others4, others5, others6, significant_findings, classification', 'safe', 'on'=>'search'),
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
			'ape_id' => 'Ape',
			'user_id' => 'User',
			'username' => 'Username',
			'update_datetime' => 'Update Datetime',
			'others1' => 'Others1',
			'others2' => 'Others2',
			'others3' => 'Others3',
			'others4' => 'Others4',
			'others5' => 'Others5',
			'others6' => 'Others6',
			'significant_findings' => 'Significant Findings',
			'classification' => 'Classification',
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
		$criteria->compare('ape_id',$this->ape_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('update_datetime',$this->update_datetime,true);
		$criteria->compare('others1',$this->others1,true);
		$criteria->compare('others2',$this->others2,true);
		$criteria->compare('others3',$this->others3,true);
		$criteria->compare('others4',$this->others4,true);
		$criteria->compare('others5',$this->others5,true);
		$criteria->compare('others6',$this->others6,true);
		$criteria->compare('significant_findings',$this->significant_findings,true);
		$criteria->compare('classification',$this->classification,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}