<?php

/**
 * This is the model class for table "diag_urinalysis".
 *
 * The followings are the available columns in table 'diag_urinalysis':
 * @property string $id
 * @property string $create_date
 * @property string $name
 * @property integer $age
 * @property string $sex
 * @property string $requesting_physician
 * @property string $sp_no
 * @property string $pc_color
 * @property string $pc_tranparency
 * @property string $pc_specific_gravity
 * @property string $cc_ph
 * @property string $cc_sugar
 * @property string $cc_protein
 * @property string $m_puscell
 * @property string $m_rbc
 * @property string $m_epitelial_cells
 * @property string $m_mucus_threads
 * @property string $c_amorph_urates
 * @property string $c_amorph_phosphates
 * @property string $c_uric_acid
 * @property string $c_triple_phospate
 * @property string $c_calcium_oxalate
 * @property string $bacteria
 * @property string $casts
 * @property string $pregnancy_test
 * @property string $others
 * @property string $date_created
 * @property string $med_tech
 * @property string $licenseno
 * @property string $pathologist
 * @property string $datereceived
 * @property string $datereleased
 * @property string $patient_id
 *
 * The followings are the available model relations:
 * @property Patient $patient
 */
class DiagUrinalysis extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiagUrinalysis the static model class
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
		return 'diag_urinalysis';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('requesting_physician, med_tech, licenseno, pathologist, datereceived, datereleased', 'required'),
			array('age', 'numerical', 'integerOnly'=>true),
			//array('id', 'length', 'max'=>10),
			array('name, sex, requesting_physician, sp_no, pc_color, pc_tranparency, pc_specific_gravity, cc_ph, cc_sugar, cc_protein, m_puscell, m_rbc, m_epitelial_cells, m_mucus_threads, c_amorph_urates, c_amorph_phosphates, c_uric_acid, c_triple_phospate, c_calcium_oxalate, bacteria, casts, pregnancy_test, licenseno', 'length', 'max'=>250),
			array('others, med_tech, pathologist', 'length', 'max'=>200),
			array('patient_id', 'length', 'max'=>20),
                        array('datecreated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, age, sex, requesting_physician, sp_no, pc_color, pc_tranparency, pc_specific_gravity, cc_ph, cc_sugar, cc_protein, m_puscell, m_rbc, m_epitelial_cells, m_mucus_threads, c_amorph_urates, c_amorph_phosphates, c_uric_acid, c_triple_phospate, c_calcium_oxalate, bacteria, casts, pregnancy_test, others, datecreated, med_tech, licenseno, pathologist, datereceived, datereleased', 'safe', 'on'=>'search'),
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
			'requesting_physician' => 'Requesting Physician',
			'sp_no' => 'Sp No.',
			'pc_color' => 'Color',
			'pc_tranparency' => 'Tranparency',
			'pc_specific_gravity' => 'Specific Gravity',
			'cc_ph' => 'pH',
			'cc_sugar' => 'Sugar',
			'cc_protein' => 'Protein',
			'm_puscell' => 'Pus Cell',
			'm_rbc' => 'RBC',
			'm_epitelial_cells' => 'Epithelial Cells',
			'm_mucus_threads' => 'Mucus Threads',
			'c_amorph_urates' => 'Amorphous Urates',
			'c_amorph_phosphates' => 'Amorphous Phosphates',
			'c_uric_acid' => 'Uric Acid',
            'c_triple_phospate' => 'Triple Phospate',
			'c_calcium_oxalate' => 'Calcium Oxalate',
			'bacteria' => 'Bacteria',
			'casts' => 'Casts',
			'pregnancy_test' => 'Pregnancy Test',
			'others' => 'Others',
            'datecreated' => 'Date Created',
            'med_tech' => 'Med Tech',
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
		$criteria->compare('requesting_physician',$this->requesting_physician,true);
		$criteria->compare('sp_no',$this->sp_no,true);
		$criteria->compare('pc_color',$this->pc_color,true);
		$criteria->compare('pc_tranparency',$this->pc_tranparency,true);
		$criteria->compare('pc_specific_gravity',$this->pc_specific_gravity,true);
		$criteria->compare('cc_ph',$this->cc_ph,true);
		$criteria->compare('cc_sugar',$this->cc_sugar,true);
		$criteria->compare('cc_protein',$this->cc_protein,true);
		$criteria->compare('m_puscell',$this->m_puscell,true);
		$criteria->compare('m_rbc',$this->m_rbc,true);
		$criteria->compare('m_epitelial_cells',$this->m_epitelial_cells,true);
		$criteria->compare('m_mucus_threads',$this->m_mucus_threads,true);
		$criteria->compare('c_amorph_urates',$this->c_amorph_urates,true);
		$criteria->compare('c_amorph_phosphates',$this->c_amorph_phosphates,true);
		$criteria->compare('c_uric_acid',$this->c_uric_acid,true);
                $criteria->compare('c_triple_phospatef',$this->c_triple_phospate,true);
		$criteria->compare('c_calcium_oxalate',$this->c_calcium_oxalate,true);
		$criteria->compare('bacteria',$this->bacteria,true);
		$criteria->compare('casts',$this->casts,true);
		$criteria->compare('pregnancy_test',$this->pregnancy_test,true);
		$criteria->compare('others',$this->others,true);
                $criteria->compare('datecreated',$this->datecreated,true);
		$criteria->compare('med_tech',$this->med_tech,true);
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
