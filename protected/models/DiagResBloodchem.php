<?php

/**
 * This is the model class for table "diag_res_bloodchem".
 *
 * The followings are the available columns in table 'diag_res_bloodchem':
 * @property string $id
 * @property string $resultno
 * @property string $sp_no
 * @property string $status
 * @property string $createdate
 * @property integer $createby
 * @property integer $patient_id
 * @property string $patient_name
 * @property integer $age
 * @property string $gender
 * @property string $req_doctor
 * @property string $read_doctor
 * @property string $date_last_print
 * @property integer $lastupdateby
 * @property string $medtech
 * @property string $medtech_license
 * @property integer $med_tech_id
 * @property string $pathologist
 * @property integer $pathologist_id
 * @property string $glucose
 * @property string $bun
 * @property string $creatinine
 * @property string $uric_acid
 * @property string $cholesterol
 * @property string $triglycerides
 * @property string $hdl_c
 * @property string $ldl_c
 * @property string $vldl_c
 * @property string $sgot_ast
 * @property string $sgpt_alt
 * @property string $hba1c
 * @property string $total_bilirubin
 * @property string $direct_bilirubin
 * @property string $indirect_bilirubin
 * @property string $sodium
 * @property string $potassium
 * @property string $chloride
 * @property string $calcium
 * @property string $total_protein
 * @property string `$alkaline_phosphatase`
 * @property text $other
 */
class DiagResBloodchem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiagResBloodchem the static model class
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
		return 'diag_res_bloodchem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sp_no, req_doctor, medtech, medtech_license, pathologist, datereceived, datereleased', 'required'),
			array('createby, patient_id, age, lastupdateby, med_tech_id, pathologist_id', 'numerical', 'integerOnly'=>true),
			array('resultno', 'length', 'max'=>11),
			array('sp_no, patient_name, req_doctor, read_doctor, medtech, pathologist, glucose, bun, creatinine, uric_acid, cholesterol, triglycerides, hdl_c, ldl_c, vldl_c, sgot_ast, sgpt_alt, hba1c, total_bilirubin, direct_bilirubin, indirect_bilirubin, sodium, potassium, chloride, calcium, alkaline_phosphatase, other', 'length', 'max'=>250),
			array('status', 'length', 'max'=>50),
			array('gender', 'length', 'max'=>10),
			array('createdate, date_last_print', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, resultno, sp_no, status, createdate, createby, patient_id, patient_name, age, gender, req_doctor, read_doctor, date_last_print, lastupdateby, medtech, med_tech_id, pathologist, pathologist_id, glucose, bun, creatinine, uric_acid, cholesterol, triglycerides, hdl_c, ldl_c, vldl_c, sgot_ast, sgpt_alt, hba1c, total_bilirubin, direct_bilirubin, indirect_bilirubin, sodium, potassium, chloride, calcium, alkaline_phosphatase, other, datereceived, datereleased', 'safe', 'on'=>'search'),
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
			'resultno' => 'Result No',			
			'sp_no' => 'Sp No',
			'status' => 'Status',
			'createdate' => 'Date Created',
			'createby' => 'Create by',
			'patient_id' => 'Patient',
			'patient_name' => 'Patient Name',
			'age' => 'Age',
			'gender' => 'Gender',
			'req_doctor' => 'Requesting Physician',
			'read_doctor' => 'Assessing Doctor',
			'date_last_print' => 'Date Last Print',
			'lastupdateby' => 'Lastupdateby',
			'medtech' => 'Med Tech',
                'medtech_license' => 'Med Tech License No',            
			'med_tech_id' => 'Med Tech Id',
			'pathologist' => 'Pathologist',
			'pathologist_id' => 'Pathologist Id',
			'glucose' => 'Glucose',
			'bun' => 'Bun',
			'creatinine' => 'Creatinine',
			'uric_acid' => 'Uric Acid',
			'cholesterol' => 'Cholesterol',
			'triglycerides' => 'Triglycerides',
			'hdl_c' => 'HDL-C',
			'ldl_c' => 'LDL-C',
			'vldl_c' => 'VLDL-C',
			'sgot_ast' => 'SGOT/AST',
			'sgpt_alt' => 'SGPT/ALT',
			'hba1c' => 'Hba1c',
			'total_bilirubin' => 'Total Bilirubin',
			'direct_bilirubin' => 'Direct Bilirubin',
			'indirect_bilirubin' => 'Indirect Bilirubin',
			'sodium' => 'Sodium',
			'potassium' => 'Potassium',
			'chloride' => 'Chloride',
			'calcium' => 'Calcium',
			//'total_protein' => 'Total Protein',
			'alkaline_phosphatase' => 'Alkaline Phosphatase',
			'other' => 'Other',
                        'datereceived' => 'Date Received',
                        'datereleased' => 'Date Released',
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
		$criteria->compare('resultno',$this->resultno,true);		
		$criteria->compare('sp_no',$this->sp_no,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('createby',$this->createby);
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('patient_name',$this->patient_name,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('req_doctor',$this->req_doctor,true);
		$criteria->compare('read_doctor',$this->read_doctor,true);
		$criteria->compare('date_last_print',$this->date_last_print,true);
		$criteria->compare('lastupdateby',$this->lastupdateby);
		$criteria->compare('medtech',$this->medtech,true);
		$criteria->compare('med_tech_id',$this->med_tech_id);
		$criteria->compare('pathologist',$this->pathologist,true);
		$criteria->compare('pathologist_id',$this->pathologist_id);
		$criteria->compare('glucose',$this->glucose,true);
		$criteria->compare('bun',$this->bun,true);
		$criteria->compare('creatinine',$this->creatinine,true);
		$criteria->compare('uric_acid',$this->uric_acid,true);
		$criteria->compare('cholesterol',$this->cholesterol,true);
		$criteria->compare('triglycerides',$this->triglycerides,true);
		$criteria->compare('hdl_c',$this->hdl_c,true);
		$criteria->compare('ldl_c',$this->ldl_c,true);
		$criteria->compare('vldl_c',$this->vldl_c,true);
		$criteria->compare('sgot_ast',$this->sgot_ast,true);
		$criteria->compare('sgpt_alt',$this->sgpt_alt,true);
		$criteria->compare('hba1c',$this->hba1c,true);
		$criteria->compare('total_bilirubin',$this->total_bilirubin,true);
		$criteria->compare('direct_bilirubin',$this->direct_bilirubin,true);
		$criteria->compare('indirect_bilirubin',$this->indirect_bilirubin,true);
		$criteria->compare('sodium',$this->sodium,true);
		$criteria->compare('potassium',$this->potassium,true);
		$criteria->compare('chloride',$this->chloride,true);
		$criteria->compare('calcium',$this->calcium,true);
		//$criteria->compare('total_protein',$this->total_protein,true);
		$criteria->compare('alkaline_phosphatase',$this->alkaline_phosphatase,true);
		$criteria->compare('other',$this->other,true);
		$criteria->compare('datereceived',$this->datereceived,true);
		$criteria->compare('datereleased',$this->datereleased,true);
        $criteria->order='id desc';     

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}