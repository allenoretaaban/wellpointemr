<?php

/**
 * This is the model class for table "ape_reports".
 *
 * The followings are the available columns in table 'ape_reports':
 * @property integer $id
 * @property string $ape_id
 * @property string $datevisited
 * @property integer $client_id
 * @property string $client_name
 * @property integer $hmo_id
 * @property string $hmo_name
 * @property string $hmo_member_id
 * @property integer $patient_id
 * @property string $patient_name
 * @property string $employee_id
 * @property string $age
 * @property string $gender
 * @property string $ht
 * @property string $wt
 * @property string $bmi
 * @property string $body_built
 * @property string $bp
 * @property string $cxr
 * @property string $cbc
 * @property string $fecalysis
 * @property string $urinalysis
 * @property string $drugtest
 * @property string $ecg
 * @property string $papsmear
 * @property string $visual_acuity
 * @property string $audiometry
 * @property string $past_history
 * @property string $physical_exam
 * @property string $others1
 * @property string $others2
 * @property string $others3
 * @property string $others4
 * @property string $others5
 * @property string $others6
 * @property string $significant_findings
 * @property string $recommendations
 * @property string $classification
 * @property string $ape_type
 */
class ApeReports extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ape_reports';
    }
    public $from_date;   
    public $to_date;                              

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('client_id, hmo_id, patient_id', 'numerical', 'integerOnly'=>true),
            array('ape_id', 'length', 'max'=>20),
            array('client_name, hmo_name, hmo_member_id, medilink_no, patient_name, employee_id, age, gender, ht, wt, bmi, cxr, cbc, fecalysis, urinalysis, drugtest, ecg, papsmear, ape_type', 'length', 'max'=>50),
            array('datevisited, body_built, bp, visual_acuity, audiometry, past_history, physical_exam, others1, others2, others3, others4, others5, others6, significant_findings, recommendations, classification', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ape_id, datevisited, client_id, client_name, hmo_id, hmo_name, hmo_member_id, medilink_no, patient_id, patient_name, employee_id, age, gender, ht, wt, bmi, body_built, bp, cxr, cbc, fecalysis, urinalysis, drugtest, ecg, papsmear, visual_acuity, audiometry, past_history, physical_exam, others1, others2, others3, others4, others5, others6, significant_findings, recommendations, classification, from_date, to_date', 'safe', 'on'=>'search'),
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
            'ape_id' => 'APE&nbsp;ID',
            'datevisited' => 'Datevisited',
            'client_id' => 'Company',
            'client_name' => 'COMPANY&nbsp;NAME',
            'hmo_id' => 'HMO&nbsp;',
            'hmo_name' => 'HMO',
            'hmo_member_id' => 'HMO&nbsp;MEMBER&nbsp;ID',
            'medilink_no' => 'MEDILINK&nbsp;NO',
            'patient_id' => 'Patient',
            'patient_name' => 'NAME',
            'employee_id' => 'EMPID',
            'age' => 'AGE',
            'gender' => 'GENDER',
            'ht' => 'HT',
            'wt' => 'WT',
            'bmi' => 'BMI',
            'body_built' => 'BODY&nbsp;BUILT',
            'bp' => 'BP',
            'cxr' => 'CHEST&nbsp;X-RAY',
            'cbc' => 'CBC',
            'fecalysis' => 'FECALYSIS',
            'urinalysis' => 'URINALYSIS',
            'drugtest' => 'DRUG&nbsp;TEST',
            'ecg' => 'ECG',
            'papsmear' => 'PAPSMEAR',
            'visual_acuity' => 'VISUAL&nbsp;ACUITY',
            'audiometry' => 'AUDIOMETRY',
            'past_history' => 'PAST&nbsp;MEDICAL/FAMILY/SOCIAL&nbsp;HISTORY',
            'physical_exam' => 'PHYSICAL ',
            'others1' => 'OTHERS1',
            'others2' => 'OTHERS2',
            'others3' => 'OTHERS3',
            'others4' => 'OTHERS4',
            'others5' => 'OTHERS5',
            'others6' => 'OTHERS6',
            'significant_findings' => 'SIGNIFICANT&nbsp;FINDINGS',
            'recommendations' => 'RECOMMENDATIONS',
            'classification' => 'CLASSIFICATION',
            'ape_type' => 'Ape Type',
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
        $criteria->compare('datevisited',$this->datevisited,true);
        $criteria->compare('client_id',$this->client_id);
        $criteria->compare('client_name',$this->client_name,true);
        $criteria->compare('hmo_id',$this->hmo_id);
        $criteria->compare('hmo_name',$this->hmo_name,true);
        $criteria->compare('hmo_member_id',$this->hmo_member_id,true);
        $criteria->compare('medilink_no',$this->medilink_no,true);
        $criteria->compare('patient_id',$this->patient_id);
        $criteria->compare('patient_name',$this->patient_name,true);
        $criteria->compare('employee_id',$this->employee_id,true);
        $criteria->compare('age',$this->age,true);
        $criteria->compare('gender',$this->gender,true);
        $criteria->compare('ht',$this->ht,true);
        $criteria->compare('wt',$this->wt,true);
        $criteria->compare('bmi',$this->bmi,true);
        $criteria->compare('body_built',$this->body_built,true);
        $criteria->compare('bp',$this->bp,true);
        $criteria->compare('cxr',$this->cxr,true);
        $criteria->compare('cbc',$this->cbc,true);
        $criteria->compare('fecalysis',$this->fecalysis,true);
        $criteria->compare('urinalysis',$this->urinalysis,true);
        $criteria->compare('drugtest',$this->drugtest,true);
        $criteria->compare('ecg',$this->ecg,true);
        $criteria->compare('papsmear',$this->papsmear,true);
        $criteria->compare('visual_acuity',$this->visual_acuity,true);
        $criteria->compare('audiometry',$this->audiometry,true);
        $criteria->compare('past_history',$this->past_history,true);
        $criteria->compare('physical_exam',$this->physical_exam,true);
        $criteria->compare('others1',$this->others1,true);
        $criteria->compare('others2',$this->others2,true);
        $criteria->compare('others3',$this->others3,true);
        $criteria->compare('others4',$this->others4,true);
        $criteria->compare('others5',$this->others5,true);
        $criteria->compare('others6',$this->others6,true);
        $criteria->compare('significant_findings',$this->significant_findings,true);
        $criteria->compare('recommendations',$this->recommendations,true);
        $criteria->compare('classification',$this->classification,true);
        $criteria->compare('ape_type',$this->ape_type,true);
        if(!empty($this->from_date) && !empty($this->to_date)){
            $criteria->addBetweenCondition('datevisited',date("Y-m-d",strtotime($this->from_date)),date("Y-m-d",strtotime($this->to_date)));
        }

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ApeReports the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
