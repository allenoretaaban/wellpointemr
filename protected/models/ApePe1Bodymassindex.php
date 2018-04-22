<?php

/**
 * This is the model class for table "ape_pe1_bodymassindex".
 *
 * The followings are the available columns in table 'ape_pe1_bodymassindex':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property string $height_ft
 * @property string $height_in
 * @property string $height_cm
 * @property string $weight_lbs
 * @property string $weight_kg
 * @property string $bmi
 * @property integer $bmi_uw
 * @property integer $bmi_n
 * @property integer $bmi_ow
 * @property integer $bmi_oc1
 * @property integer $bmi_oc2
 * @property string $body_built
 */
class ApePe1Bodymassindex extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ape_pe1_bodymassindex';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('bmi_uw, bmi_n, bmi_ow, bmi_oc1, bmi_oc2', 'numerical', 'integerOnly'=>true),
            array('ape_id, user_id', 'length', 'max'=>20),
            array('username, body_built', 'length', 'max'=>100),
            array('height_ft, height_in, height_cm, weight_lbs, weight_kg, bmi', 'length', 'max'=>10),
            array('update_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ape_id, user_id, username, update_datetime, height_ft, height_in, height_cm, weight_lbs, weight_kg, bmi, bmi_uw, bmi_n, bmi_ow, bmi_oc1, bmi_oc2, body_built', 'safe', 'on'=>'search'),
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
            'ape_id' => 'Ape',
            'user_id' => 'User',
            'username' => 'Username',
            'update_datetime' => 'Update Datetime',
            'height_ft' => 'Height Ft',
            'height_in' => 'Height In',
            'height_cm' => 'Height Cm',
            'weight_lbs' => 'Weight Lbs',
            'weight_kg' => 'Weight Kg',
            'bmi' => 'Bmi',
            'bmi_uw' => 'Bmi Uw',
            'bmi_n' => 'Bmi N',
            'bmi_ow' => 'Bmi Ow',
            'bmi_oc1' => 'Bmi Oc1',
            'bmi_oc2' => 'Bmi Oc2',
            'body_built' => 'Body Built',
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
        $criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('update_datetime',$this->update_datetime,true);
        $criteria->compare('height_ft',$this->height_ft,true);
        $criteria->compare('height_in',$this->height_in,true);
        $criteria->compare('height_cm',$this->height_cm,true);
        $criteria->compare('weight_lbs',$this->weight_lbs,true);
        $criteria->compare('weight_kg',$this->weight_kg,true);
        $criteria->compare('bmi',$this->bmi,true);
        $criteria->compare('bmi_uw',$this->bmi_uw);
        $criteria->compare('bmi_n',$this->bmi_n);
        $criteria->compare('bmi_ow',$this->bmi_ow);
        $criteria->compare('bmi_oc1',$this->bmi_oc1);
        $criteria->compare('bmi_oc2',$this->bmi_oc2);
        $criteria->compare('body_built',$this->body_built,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ApePe1Bodymassindex the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
