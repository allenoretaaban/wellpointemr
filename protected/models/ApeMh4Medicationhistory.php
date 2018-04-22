<?php

/**
 * This is the model class for table "ape_mh4_medicationhistory".
 *
 * The followings are the available columns in table 'ape_mh4_medicationhistory':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property integer $pmt_no
 * @property integer $pmt_yes
 * @property string $sdt
 * @property integer $fdase
 * @property string $specify
 */
class ApeMh4Medicationhistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ape_mh4_medicationhistory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pmt_no, pmt_yes, fdase', 'numerical', 'integerOnly'=>true),
			array('ape_id, user_id', 'length', 'max'=>20),
			array('username', 'length', 'max'=>50),
			array('sdt, specify', 'length', 'max'=>100),
			array('update_datetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ape_id, user_id, username, update_datetime, pmt_no, pmt_yes, sdt, fdase, specify', 'safe', 'on'=>'search'),
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
			'pmt_no' => 'Pmt No',
			'pmt_yes' => 'Pmt Yes',
			'sdt' => 'Sdt',
			'fdase' => 'Fdase',
			'specify' => 'Specify',
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
		$criteria->compare('pmt_no',$this->pmt_no);
		$criteria->compare('pmt_yes',$this->pmt_yes);
		$criteria->compare('sdt',$this->sdt,true);
		$criteria->compare('fdase',$this->fdase);
		$criteria->compare('specify',$this->specify,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApeMh4Medicationhistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
