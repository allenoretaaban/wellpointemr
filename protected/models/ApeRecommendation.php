<?php

/**
 * This is the model class for table "ape_recommendation".
 *
 * The followings are the available columns in table 'ape_recommendation':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property string $recommendation1
 * @property string $recommendation2
 * @property string $recommendation3
 * @property string $recommendation4
 * @property string $recommendation5
 */
class ApeRecommendation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ape_recommendation';
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
			array('update_datetime, recommendation1, recommendation2, recommendation3, recommendation4, recommendation5', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ape_id, user_id, username, update_datetime, recommendation1, recommendation2, recommendation3, recommendation4, recommendation5', 'safe', 'on'=>'search'),
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
			'recommendation1' => 'Recommendation1',
			'recommendation2' => 'Recommendation2',
			'recommendation3' => 'Recommendation3',
			'recommendation4' => 'Recommendation4',
			'recommendation5' => 'Recommendation5',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('ape_id',$this->ape_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('update_datetime',$this->update_datetime,true);
		$criteria->compare('recommendation1',$this->recommendation1,true);
		$criteria->compare('recommendation2',$this->recommendation2,true);
		$criteria->compare('recommendation3',$this->recommendation3,true);
		$criteria->compare('recommendation4',$this->recommendation4,true);
		$criteria->compare('recommendation5',$this->recommendation5,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApeRecommendation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
