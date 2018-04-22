<?php

/**
 * This is the model class for table "diag_hematology".
 *
 * The followings are the available columns in table 'diag_hematology':
 * @property string $id
 * @property string $name
 * @property integer $age
 * @property string $sex
 * @property string $requestingphysician
 * @property string $spno
 * @property string $rbc
 * @property string $hemoglobin
 * @property string $hematocrit
 * @property string $wbc
 * @property string $segmenters
 * @property string $lymphocytes
 * @property string $monocytes
 * @property string $eosinophils
 * @property string $stabband
 * @property string $basophil
 * @property string $plateletcount
 * @property string $mcv
 * @property string $mch
 * @property string $mchc
 * @property string $bloodtype
 * @property string $rhtype
 * @property string $esr
 * @property string $bleedingtime
 * @property string $clottingtime
 * @property string $others
 * @property string $datecreated
 * @property string $medicaltechnologist
 * @property string $licenseno
 * @property string $pathologist
 * @property string $patient_id
 *
 * The followings are the available model relations:
 * @property Patient $patient
 */
class DiagHematology extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiagHematology the static model class
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
		return 'diag_hematology';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requestingphysician, medicaltechnologist, licenseno, pathologist, datereceived, datereleased', 'required'),
			array('age', 'numerical', 'integerOnly'=>true),
			array('name, sex, requestingphysician, spno, rbc, hemoglobin, hematocrit, wbc, segmenters, lymphocytes, monocytes, eosinophils, stabband, basophil, plateletcount, mcv, mch, mchc, bloodtype, rhtype, esr, bleedingtime, clottingtime, medicaltechnologist, pathologist', 'length', 'max'=>200),
			array('others', 'length', 'max'=>150),
			array('licenseno, patient_id', 'length', 'max'=>20),
			array('datecreated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, age, sex, requestingphysician, spno, rbc, hemoglobin, hematocrit, wbc, segmenters, lymphocytes, monocytes, eosinophils, stabband, basophil, plateletcount, bloodtype, rhtype, esr, bleedingtime, clottingtime, others, datecreated, medicaltechnologist, licenseno, pathologist, datereceived, datereleased', 'safe', 'on'=>'search'),
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
			'name' => 'Full Name',
			'age' => 'Age',
			'sex' => 'Sex',
			'requestingphysician' => 'Requesting Physician',
			'spno' => 'Sp No.',
			'rbc' => 'RBC',
			'hemoglobin' => 'Hemoglobin',
			'hematocrit' => 'Hematocrit',
			'wbc' => 'WBC',
			'segmenters' => 'Segmenters',
			'lymphocytes' => 'Lymphocytes',
			'monocytes' => 'Monocytes',
			'eosinophils' => 'Eosinophils',
			'stabband' => 'Stab/Band',
			'basophil' => 'Basophil',
			'plateletcount' => 'Platelet Count',
			'mcv' => 'MCV',
			'mch' => 'MCH',
			'mchc' => 'MCHc',
			'bloodtype' => 'Blood Type',
			'rhtype' => 'RH Type',
			'esr' => 'ESR',
			'bleedingtime' => 'Bleeding Time',
			'clottingtime' => 'Clotting Time',
			'others' => 'Others',
			'datecreated' => 'Date Created',
			'medicaltechnologist' => 'Med Tech',
			'licenseno' => 'Medical Technologist License No.',
			'pathologist' => 'Pathologist',
            'datereceived' => 'Date Received',
            'datereleased' => 'Date Released',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('requestingphysician',$this->requestingphysician,true);
		$criteria->compare('spno',$this->spno,true);
		$criteria->compare('rbc',$this->rbc,true);
		$criteria->compare('hemoglobin',$this->hemoglobin,true);
		$criteria->compare('hematocrit',$this->hematocrit,true);
		$criteria->compare('wbc',$this->wbc,true);
		$criteria->compare('segmenters',$this->segmenters,true);
		$criteria->compare('lymphocytes',$this->lymphocytes,true);
		$criteria->compare('monocytes',$this->monocytes,true);
		$criteria->compare('eosinophils',$this->eosinophils,true);
		$criteria->compare('stabband',$this->stabband,true);
		$criteria->compare('basophil',$this->basophil,true);
		$criteria->compare('plateletcount',$this->plateletcount,true);
		$criteria->compare('mcv',$this->mcv,true);
		$criteria->compare('mch',$this->mch,true);
		$criteria->compare('mchc',$this->mchc,true);
		$criteria->compare('bloodtype',$this->bloodtype,true);
		$criteria->compare('rhtype',$this->rhtype,true);
		$criteria->compare('esr',$this->esr,true);
		$criteria->compare('bleedingtime',$this->bleedingtime,true);
		$criteria->compare('clottingtime',$this->clottingtime,true);
		$criteria->compare('others',$this->others,true);
		$criteria->compare('datecreated',$this->datecreated,true);
		$criteria->compare('medicaltechnologist',$this->medicaltechnologist,true);
		$criteria->compare('licenseno',$this->licenseno,true);
		$criteria->compare('pathologist',$this->pathologist,true);
		$criteria->compare('datereceived',$this->datereceived,true);
		$criteria->compare('datereleased',$this->datereleased,true);
		$criteria->compare('patient_id',$this->patient_id,true);
        $criteria->order='id desc';  

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}