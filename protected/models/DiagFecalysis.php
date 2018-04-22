<?php

/**
 * This is the model class for table "diag_fecalysis".
 *
 * The followings are the available columns in table 'diag_fecalysis':
 * @property string $id
 * @property string $name
 * @property integer $age
 * @property string $sex
 * @property string $requestingphysician
 * @property string $spno
 * @property string $color
 * @property string $consistency
 * @property string $mucus
 * @property string $undigestedfood
 * @property string $wbc
 * @property string $rbc
 * @property string $fatglobules
 * @property string $yeastcells
 * @property string $bacteria
 * @property string $parasites
 * @property string $amoeba
 * @property string $occultblood
 * @property string $others
 * @property string $datereleased
 * @property string $medicaltechnologist
 * @property string $licenseno
 * @property string $pathologist
 * @property string $datereceived
 * @property string $datereleased
 * @property string $patient_id
 *
 * The followings are the available model relations:
 * @property Patient $patient_id
 */
class DiagFecalysis extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiagFecalysis the static model class
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
		return 'diag_fecalysis';
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
			array('name, sex, requestingphysician, spno, color, consistency, mucus, undigestedfood, wbc, rbc, fatglobules, yeastcells, bacteria, parasites, amoeba, occultblood, others, medicaltechnologist, licenseno, pathologist', 'length', 'max'=>200),
			array('patient_id', 'length', 'max'=>20),
			array('datecreated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, age, sex, requestingphysician, spno, color, consistency, mucus, undigestedfood, wbc, rbc, fatglobules, yeastcells, bacteria, parasites, amoeba, occultblood, others, medicaltechnologist, licenseno, pathologist, datereceived, datereleased, patient_id', 'safe', 'on'=>'search'),
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
			'patient_id' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
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
			'color' => 'Color',
			'consistency' => 'Consistency',
			'mucus' => 'Mucus',
			'undigestedfood' => 'Undigested Food',
			'wbc' => 'WBC (/hpf)',
			'rbc' => 'RBC (/hpf)',
			'fatglobules' => 'Fat Globules',
			'yeastcells' => 'Yeast Cells',
			'bacteria' => 'Bacteria',
			'parasites' => 'Parasites',
			'amoeba' => 'Amoeba',
			'occultblood' => 'Occult Blood',
			'others' => 'Others',
			'datecreated' => 'Date Created',
			'medicaltechnologist' => 'Med Tech',
			'licenseno' => 'Medical Technologist Licence No.',
			'pathologist' => 'Pathologist',
            'datereceived' => 'Date Received',
            'datereleased' => 'Date Released',
			'patient_id' => 'Patient No.',
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
		$criteria->compare('color',$this->color,true);
		$criteria->compare('consistency',$this->consistency,true);
		$criteria->compare('mucus',$this->mucus,true);
		$criteria->compare('undigestedfood',$this->undigestedfood,true);
		$criteria->compare('wbc',$this->wbc,true);
		$criteria->compare('rbc',$this->rbc,true);
		$criteria->compare('fatglobules',$this->fatglobules,true);
		$criteria->compare('yeastcells',$this->yeastcells,true);
		$criteria->compare('bacteria',$this->bacteria,true);
		$criteria->compare('parasites',$this->parasites,true);
		$criteria->compare('amoeba',$this->amoeba,true);
		$criteria->compare('occultblood',$this->occultblood,true);
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
