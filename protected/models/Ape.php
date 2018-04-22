<?php

/**
 * This is the model class for table "ape".
 *
 * The followings are the available columns in table 'ape':
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property string $datevisited
 * @property string $patient_id
 * @property integer $hmo_id
 * @property string $hmo_member_id
 * @property integer $client_id
 * @property string $employee_id
 * @property integer $is_preemployment
 * @property integer $is_annual
 * @property integer $is_executive
 * @property integer $is_card
 * @property string $card_number
 * @property integer $is_promo
 * @property string $promo
 * @property integer $is_others
 * @property string $others
 * @property string $ape_type
 *
 * The followings are the available model relations:
 * @property Clients $client
 * @property Patient $patient
 * @property Hmo $hmo
 */
class Ape extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ape';
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
            array('user_id, hmo_id, client_id, is_preemployment, is_annual, is_executive, is_card, is_promo, is_others', 'numerical', 'integerOnly'=>true),
            array('username, hmo_member_id, medilink_no, employee_id, card_number, promo, others, status, ape_type', 'length', 'max'=>100),
            array('patient_id', 'length', 'max'=>20),
            array('datevisited', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, user_id, username, datevisited, patient_id, hmo_id, hmo_member_id, medilink_no, client_id, employee_id, is_preemployment, is_annual, is_executive, is_card, card_number, is_promo, promo, is_others, others, status, remarks, date_completed, from_date, to_date, ape_type', 'safe',  'on'=>'search'),
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
            'client' => array(self::BELONGS_TO, 'Clients', 'client_id'),
            'patient' => array(self::BELONGS_TO, 'Patient', 'patient_id'),
            'hmo' => array(self::BELONGS_TO, 'Hmo', 'hmo_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'Ape ID',
            'user_id' => 'User',
            'username' => 'Username',
            'datevisited' => 'Date Visited',
            'patient_id' => 'Patient',
            'hmo_id' => 'Hmo',
            'hmo_member_id' => 'Hmo Member ID',
            'medilink_no' => 'Medilink NO',
            'client_id' => 'Company Name',
            'employee_id' => 'Employee ID',
            'is_preemployment' => 'Is Preemployment',
            'is_annual' => 'Is Annual',
            'is_executive' => 'Is Executive',
            'is_card' => 'Is Card',
            'card_number' => 'Card Number',
            'is_promo' => 'Is Promo',
            'promo' => 'Promo',
            'is_others' => 'Is Others',
            'others' => 'Others',
            'status' => 'Status',
            'date_completed' => 'Date Completed',
            'remarks' => 'Remarks',
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
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('datevisited',$this->datevisited,true);
        $criteria->compare('patient_id',$this->patient_id,true);
        $criteria->compare('hmo_id',$this->hmo_id);
        $criteria->compare('hmo_member_id',$this->hmo_member_id,true);
        $criteria->compare('medilink_no',$this->medilink_no,true);
        $criteria->compare('client_id',$this->client_id);
        $criteria->compare('employee_id',$this->employee_id,true);
        $criteria->compare('is_preemployment',$this->is_preemployment);
        $criteria->compare('is_annual',$this->is_annual);
        $criteria->compare('is_executive',$this->is_executive);
        $criteria->compare('is_card',$this->is_card);
        $criteria->compare('card_number',$this->card_number,true);
        $criteria->compare('is_promo',$this->is_promo);
        $criteria->compare('promo',$this->promo,true);
        $criteria->compare('is_others',$this->is_others);
        $criteria->compare('others',$this->others,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('date_completed',$this->date_completed,true);
        $criteria->compare('remarks',$this->remarks,true);
        $criteria->compare('ape_type',$this->ape_type,true);
        if(!empty($this->from_date) && !empty($this->to_date)){
            $criteria->addBetweenCondition('datevisited',date("Y-m-d",strtotime($this->from_date)),date("Y-m-d",strtotime($this->to_date)));
        }
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ape the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
