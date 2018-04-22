<?php

/**
 * This is the model class for table "diag_temps_results".
 *
 * The followings are the available columns in table 'diag_temps_results':
 * @property string $id
 * @property string $resultno
 * @property integer $diagtempid
 * $property string $diagtemptitle
 * @property string $diag_type
 * @property string $status
 * @property string $createdate
 * @property integer $createby
 * @property string $result_content
 * @property integer $patient_id
 * @property string $patient_name
 * @property integer $age
 * @property string $gender
 * @property string $req_doctor
 * @property string $read_doctor
 * @property string $date_last_print
 * @property integer $lastupdateby
 * @property integer $med_tech_id
 */
class DiagTempsResults extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DiagTempsResults the static model class
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
		return 'diag_temps_results';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, age, lastupdateby, med_tech_id, createby, diagtempid, diag_type', 'numerical', 'integerOnly'=>true),
			array('resultno', 'length', 'max'=>11),
			array('status,diag_type', 'length', 'max'=>50),
			array('gender', 'length', 'max'=>10),
			array('req_doctor, read_doctor, patient_name, diagtemptitle', 'length', 'max'=>250),
			array('createdate, result_content, date_last_print', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, resultno, diagtempid, diagtemptitle, diag_type, status, createdate, result_content, patient_id, patient_name, age, gender, req_doctor, read_doctor, date_last_print, lastupdateby, med_tech_id', 'safe', 'on'=>'search'),
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
            'diagtempid' => 'Diag Temp Id',       
            'diagtemptitle' => 'Diag Temp Title',       
			'status' => 'Status',
			'createdate' => 'Create Date',
            'createby' => 'Create By',
			'result_content' => 'Result Content',
			'patient_id' => 'Patient Id',
            'patient_name' => 'Patient Name',
			'age' => 'Age',
			'gender' => 'Gender',
			'req_doctor' => 'Req Doctor',
			'read_doctor' => 'Read Doctor',
			'date_last_print' => 'Date Last Print',
			'lastupdateby' => 'Last Update By',
			'med_tech_id' => 'Med Tech',
            'diag_type' => 'Diagnostic Type',
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
        $criteria->compare('diagtempid',$this->diagtempid,true);
        $criteria->compare('diag_type',$this->diag_type,true);
        $criteria->compare('createby',$this->createby,true);
        $criteria->compare('diagtemptitle',$this->diagtemptitle,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('result_content',$this->result_content,true);
		$criteria->compare('patient_id',$this->patient_id);
        $criteria->compare('patient_name',$this->patient_name,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('req_doctor',$this->req_doctor,true);
		$criteria->compare('read_doctor',$this->read_doctor,true);
		$criteria->compare('date_last_print',$this->date_last_print,true);
		$criteria->compare('lastupdateby',$this->lastupdateby);
		$criteria->compare('med_tech_id',$this->med_tech_id);
        $criteria->order = 'id desc';       
        

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
                ),
		));
	}
    
    public function getNextResultNo()
    {             
        $conn=Yii::app()->db;                
        $sql = "SELECT resultno FROM diag_temps_results WHERE diagtempid=".$this->diagtempid. " order by id DESC limit 1";                
        $command=$conn->createCommand($sql);
        $res = $command->queryRow();

        if ($res["resultno"]){
            $this->resultno = intval($res["resultno"])+ 1;
        }else{
            $this->resultno = 1;
        }
    }
}