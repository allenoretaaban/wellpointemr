<?php

/**
 * This is the model class for table "ape_mh2_familyhistory".
 *
 * The followings are the available columns in table 'ape_mh2_familyhistory':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property integer $is_ha
 * @property string $ha_relationship
 * @property integer $ha_agedetected
 * @property integer $ha_agedied
 * @property integer $is_ht
 * @property string $ht_relationship
 * @property integer $ht_agedetected
 * @property integer $ht_agedied
 * @property integer $is_dm
 * @property string $dm_relationship
 * @property integer $dm_agedetected
 * @property integer $dm_agedied
 * @property integer $is_ptb
 * @property string $ptb_relationship
 * @property integer $ptb_agedetected
 * @property integer $ptb_agedied
 * @property integer $is_cancer
 * @property string $cancer_type
 * @property string $cancer_relationship
 * @property integer $cancer_agedetected
 * @property integer $cancer_agedied
 * @property integer $is_kd
 * @property string $kd_relationship
 * @property integer $kd_agedetected
 * @property integer $kd_agedied
 * @property integer $is_others
 * @property string $others_name
 * @property string $others_relationship
 * @property integer $others_agedetected
 * @property integer $others_agedied
 */
class ApeMh2Familyhistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ape_mh2_familyhistory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_ha, ha_agedetected, ha_agedied, is_ht, ht_agedetected, ht_agedied, is_dm, dm_agedetected, dm_agedied, is_ptb, ptb_agedetected, ptb_agedied, is_cancer, cancer_agedetected, cancer_agedied, is_kd, kd_agedetected, kd_agedied, is_others, others_agedetected, others_agedied', 'numerical', 'integerOnly'=>true),
			array('ape_id, user_id', 'length', 'max'=>20),
			array('username, ha_relationship, ht_relationship, dm_relationship, ptb_relationship, cancer_type, cancer_relationship, kd_relationship, others_name, others_relationship', 'length', 'max'=>100),
			array('update_datetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ape_id, user_id, username, update_datetime, is_ha, ha_relationship, ha_agedetected, ha_agedied, is_ht, ht_relationship, ht_agedetected, ht_agedied, is_dm, dm_relationship, dm_agedetected, dm_agedied, is_ptb, ptb_relationship, ptb_agedetected, ptb_agedied, is_cancer, cancer_type, cancer_relationship, cancer_agedetected, cancer_agedied, is_kd, kd_relationship, kd_agedetected, kd_agedied, is_others, others_name, others_relationship, others_agedetected, others_agedied', 'safe', 'on'=>'search'),
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
			'is_ha' => 'Is Ha',
			'ha_relationship' => 'Ha Relationship',
			'ha_agedetected' => 'Ha Agedetected',
			'ha_agedied' => 'Ha Agedied',
			'is_ht' => 'Is Ht',
			'ht_relationship' => 'Ht Relationship',
			'ht_agedetected' => 'Ht Agedetected',
			'ht_agedied' => 'Ht Agedied',
			'is_dm' => 'Is Dm',
			'dm_relationship' => 'Dm Relationship',
			'dm_agedetected' => 'Dm Agedetected',
			'dm_agedied' => 'Dm Agedied',
			'is_ptb' => 'Is Ptb',
			'ptb_relationship' => 'Ptb Relationship',
			'ptb_agedetected' => 'Ptb Agedetected',
			'ptb_agedied' => 'Ptb Agedied',
			'is_cancer' => 'Is Cancer',
			'cancer_type' => 'Cancer Type',
			'cancer_relationship' => 'Cancer Relationship',
			'cancer_agedetected' => 'Cancer Agedetected',
			'cancer_agedied' => 'Cancer Agedied',
			'is_kd' => 'Is Kd',
			'kd_relationship' => 'Kd Relationship',
			'kd_agedetected' => 'Kd Agedetected',
			'kd_agedied' => 'Kd Agedied',
			'is_others' => 'Is Others',
			'others_name' => 'Others Name',
			'others_relationship' => 'Others Relationship',
			'others_agedetected' => 'Others Agedetected',
			'others_agedied' => 'Others Agedied',
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
		$criteria->compare('is_ha',$this->is_ha);
		$criteria->compare('ha_relationship',$this->ha_relationship,true);
		$criteria->compare('ha_agedetected',$this->ha_agedetected);
		$criteria->compare('ha_agedied',$this->ha_agedied);
		$criteria->compare('is_ht',$this->is_ht);
		$criteria->compare('ht_relationship',$this->ht_relationship,true);
		$criteria->compare('ht_agedetected',$this->ht_agedetected);
		$criteria->compare('ht_agedied',$this->ht_agedied);
		$criteria->compare('is_dm',$this->is_dm);
		$criteria->compare('dm_relationship',$this->dm_relationship,true);
		$criteria->compare('dm_agedetected',$this->dm_agedetected);
		$criteria->compare('dm_agedied',$this->dm_agedied);
		$criteria->compare('is_ptb',$this->is_ptb);
		$criteria->compare('ptb_relationship',$this->ptb_relationship,true);
		$criteria->compare('ptb_agedetected',$this->ptb_agedetected);
		$criteria->compare('ptb_agedied',$this->ptb_agedied);
		$criteria->compare('is_cancer',$this->is_cancer);
		$criteria->compare('cancer_type',$this->cancer_type,true);
		$criteria->compare('cancer_relationship',$this->cancer_relationship,true);
		$criteria->compare('cancer_agedetected',$this->cancer_agedetected);
		$criteria->compare('cancer_agedied',$this->cancer_agedied);
		$criteria->compare('is_kd',$this->is_kd);
		$criteria->compare('kd_relationship',$this->kd_relationship,true);
		$criteria->compare('kd_agedetected',$this->kd_agedetected);
		$criteria->compare('kd_agedied',$this->kd_agedied);
		$criteria->compare('is_others',$this->is_others);
		$criteria->compare('others_name',$this->others_name,true);
		$criteria->compare('others_relationship',$this->others_relationship,true);
		$criteria->compare('others_agedetected',$this->others_agedetected);
		$criteria->compare('others_agedied',$this->others_agedied);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApeMh2Familyhistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
