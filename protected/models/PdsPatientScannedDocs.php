<?php

/**
 * This is the model class for table "pds_patient_vitalsign".
 *
 * The followings are the available columns in table 'pds_patient_vitalsign':
 * @property string $id
 * @property double $title
 * @property double $description
 * @property double $filepath
 * @property string $patient_id
 * @property string $pds_id
 *
 * The followings are the available model relations:
 * @property Patient $patient
 * @property Pds $pds
 */
class PdsPatientScannedDocs extends CActiveRecord
{
    public $file;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PdsPatientVitalsign the static model class
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
		return 'pds_patient_scanneddocs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, patient_id, pds_id', 'required'),
			array('description','length','max'=>255),
            array('filepath','length','max'=>128),
			array('patient_id, pds_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, filepath, patient_id, pds_id', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'description' => 'Description',
            'file' => 'File',
			'filepath' => 'File Path',
			'patient_id' => 'Patient',
			'pds_id' => 'Pds',
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
		$criteria->compare('title',$this->title);
		$criteria->compare('description',$this->description);
		$criteria->compare('patient_id',$this->patient_id,true);
		$criteria->compare('pds_id',$this->pds_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}