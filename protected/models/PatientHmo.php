<?php

/**
 * This is the model class for table "patient_hmo".
 *
 * The followings are the available columns in table 'patient_hmo':
 * @property string $id
 * @property string $primaryname
 * @property string $primarybirthdate
 * @property integer $primaryFlag
 * @property string $cardno
 * @property integer $hmo_id
 * @property string $patient_id
 *
 * The followings are the available model relations:
 * @property Hmo $hmo
 * @property Patient $patient
 */
class PatientHmo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PatientHmo the static model class
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
		return 'patient_hmo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cardno, hmo_id, patient_id', 'required'),
			array('primaryFlag, hmo_id', 'numerical', 'integerOnly'=>true),
			array('primaryname', 'length', 'max'=>128),
			array('cardno', 'length', 'max'=>32),
			array('primarybirthdate, primaryFlag, patient_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, primaryname, primarybirthdate, primaryFlag, cardno, hmo_id, patient_id', 'safe', 'on'=>'search'),
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
			'hmo' => array(self::BELONGS_TO, 'Hmo', 'hmo_id'),
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
			'primaryname' => 'Primary Insured Name',
			'primarybirthdate' => 'Primary Insured Birth Date',
			'primaryFlag' => 'Primary',
			'cardno' => 'Card No.',
			'hmo_id' => 'HMO',
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
		$criteria->compare('primaryname',$this->primaryname,true);
		$criteria->compare('primarybirthdate',$this->primarybirthdate,true);
		$criteria->compare('primaryFlag',$this->primaryFlag);
		$criteria->compare('cardno',$this->cardno,true);
		$criteria->compare('hmo_id',$this->hmo_id);
		$criteria->compare('patient_id',$this->patient_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}