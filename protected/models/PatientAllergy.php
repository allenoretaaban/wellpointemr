<?php

/**
 * This is the model class for table "patient_allergy".
 *
 * The followings are the available columns in table 'patient_allergy':
 * @property string $id
 * @property string $foodordrug
 * @property string $type
 * @property string $sideeffects
 * @property string $patient_id
 *
 * The followings are the available model relations:
 * @property Patient $patient
 */
class PatientAllergy extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientAllergy the static model class
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
		return 'patient_allergy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('foodordrug, type, sideeffects, patient_id', 'required'),
			array('foodordrug', 'length', 'max'=>128),
			array('type', 'length', 'max'=>32),
			array('patient_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, foodordrug, type, sideeffects, patient_id', 'safe', 'on'=>'search'),
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
			'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'foodordrug' => 'Food/Drug',
			'type' => 'Type',
			'sideeffects' => 'Side Effects',
			'patient_id' => 'Patient',
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
		$criteria->compare('foodordrug',$this->foodordrug,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('sideeffects',$this->sideeffects,true);
		$criteria->compare('patient_id',$this->patient_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}