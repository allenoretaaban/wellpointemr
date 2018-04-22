<?php

/**
 * This is the model class for table "pds_patient_eyeexam".
 *
 * The followings are the available columns in table 'pds_patient_eyeexam':
 * @property string $id
 * @property string $rightlashes
 * @property string $leftlashes
 * @property string $rightcornea
 * @property string $leftcornea
 * @property string $rightantchamber
 * @property string $leftantchamber
 * @property string $rightiris
 * @property string $leftiris
 * @property string $rightpupil
 * @property string $leftpupil
 * @property string $rightlens
 * @property string $leftlens
 * @property string $righteoms
 * @property string $lefteoms
 * @property string $rightfunduscopy
 * @property string $leftfunduscopy
 * @property string $patient_id
 * @property string $pds_id
 *
 * The followings are the available model relations:
 * @property Patient $patient
 * @property Pds $pds
 */
class PdsPatientEyeexam extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PdsPatientEyeexam the static model class
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
		return 'pds_patient_eyeexam';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, pds_id', 'required'),
			array('rightlashes, leftlashes, rightcornea, leftcornea, rightantchamber, leftantchamber, rightiris, leftiris, rightpupil, leftpupil, rightlens, leftlens, righteoms, lefteoms, rightfunduscopy, leftfunduscopy', 'length', 'max'=>64),
			array('patient_id, pds_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, rightlashes, leftlashes, rightcornea, leftcornea, rightantchamber, leftantchamber, rightiris, leftiris, rightpupil, leftpupil, rightlens, leftlens, righteoms, lefteoms, rightfunduscopy, leftfunduscopy, patient_id, pds_id', 'safe', 'on'=>'search'),
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
			'pds' => array(self::BELONGS_TO, 'Pds', 'pds_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'rightlashes' => 'Right Lashes',
			'leftlashes' => 'Left Lashes',
			'rightcornea' => 'Right Cornea',
			'leftcornea' => 'Left Cornea',
			'rightantchamber' => 'Right Ant. Chamber',
			'leftantchamber' => 'Left Ant. Chamber',
			'rightiris' => 'Right Iris',
			'leftiris' => 'Left Iris',
			'rightpupil' => 'Right Pupil',
			'leftpupil' => 'Left Pupil',
			'rightlens' => 'Right Lens',
			'leftlens' => 'Left Lens',
			'righteoms' => 'Right EOMS',
			'lefteoms' => 'Left EOMS',
			'rightfunduscopy' => 'Right Funduscopy',
			'leftfunduscopy' => 'Left Funduscopy',
			'patient_id' => 'Patient',
			'pds_id' => 'PDS',
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
		$criteria->compare('rightlashes',$this->rightlashes,true);
		$criteria->compare('leftlashes',$this->leftlashes,true);
		$criteria->compare('rightcornea',$this->rightcornea,true);
		$criteria->compare('leftcornea',$this->leftcornea,true);
		$criteria->compare('rightantchamber',$this->rightantchamber,true);
		$criteria->compare('leftantchamber',$this->leftantchamber,true);
		$criteria->compare('rightiris',$this->rightiris,true);
		$criteria->compare('leftiris',$this->leftiris,true);
		$criteria->compare('rightpupil',$this->rightpupil,true);
		$criteria->compare('leftpupil',$this->leftpupil,true);
		$criteria->compare('rightlens',$this->rightlens,true);
		$criteria->compare('leftlens',$this->leftlens,true);
		$criteria->compare('righteoms',$this->righteoms,true);
		$criteria->compare('lefteoms',$this->lefteoms,true);
		$criteria->compare('rightfunduscopy',$this->rightfunduscopy,true);
		$criteria->compare('leftfunduscopy',$this->leftfunduscopy,true);
		$criteria->compare('patient_id',$this->patient_id,true);
		$criteria->compare('pds_id',$this->pds_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}