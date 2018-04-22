<?php

/**
 * This is the model class for table "ape_pe3_visualacuity".
 *
 * The followings are the available columns in table 'ape_pe3_visualacuity':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property integer $is_uncorrected
 * @property integer $is_corrected
 * @property integer $farvision_1_od20
 * @property integer $farvision_1_os20
 * @property integer $farvision_2_od20
 * @property integer $farvision_2_os20
 * @property string $nearvision_1_odj
 * @property string $nearvision_1_osj
 * @property string $nearvision_2_odj
 * @property string $nearvision_2_osj
 * @property integer $is_normal
 * @property integer $is_abnormal
 * @property integer $is_glasses
 * @property integer $is_contactlens
 */
class ApePe3Visualacuity extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ape_pe3_visualacuity';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('is_uncorrected, is_corrected, farvision_1_od20, farvision_1_os20, farvision_2_od20, farvision_2_os20, is_normal, is_abnormal, is_glasses, is_contactlens', 'numerical', 'integerOnly'=>true),
            array('ape_id, user_id', 'length', 'max'=>20),
            array('username, nearvision_1_odj, nearvision_1_osj, nearvision_2_odj, nearvision_2_osj', 'length', 'max'=>100),
            array('update_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ape_id, user_id, username, update_datetime, is_uncorrected, is_corrected, farvision_1_od20, farvision_1_os20, farvision_2_od20, farvision_2_os20, nearvision_1_odj, nearvision_1_osj, nearvision_2_odj, nearvision_2_osj, is_normal, is_abnormal, is_glasses, is_contactlens', 'safe', 'on'=>'search'),
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
            'is_uncorrected' => 'Is Uncorrected',
            'is_corrected' => 'Is Corrected',
            'farvision_1_od20' => 'Farvision 1 Od20',
            'farvision_1_os20' => 'Farvision 1 Os20',
            'farvision_2_od20' => 'Farvision 2 Od20',
            'farvision_2_os20' => 'Farvision 2 Os20',
            'nearvision_1_odj' => 'Nearvision 1 Odj',
            'nearvision_1_osj' => 'Nearvision 1 Osj',
            'nearvision_2_odj' => 'Nearvision 2 Odj',
            'nearvision_2_osj' => 'Nearvision 2 Osj',
            'is_normal' => 'Is Normal',
            'is_abnormal' => 'Is Abnormal',
            'is_glasses' => 'Is Glasses',
            'is_contactlens' => 'Is Contactlens',
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
        $criteria->compare('is_uncorrected',$this->is_uncorrected);
        $criteria->compare('is_corrected',$this->is_corrected);
        $criteria->compare('farvision_1_od20',$this->farvision_1_od20);
        $criteria->compare('farvision_1_os20',$this->farvision_1_os20);
        $criteria->compare('farvision_2_od20',$this->farvision_2_od20);
        $criteria->compare('farvision_2_os20',$this->farvision_2_os20);
        $criteria->compare('nearvision_1_odj',$this->nearvision_1_odj,true);
        $criteria->compare('nearvision_1_osj',$this->nearvision_1_osj,true);
        $criteria->compare('nearvision_2_odj',$this->nearvision_2_odj,true);
        $criteria->compare('nearvision_2_osj',$this->nearvision_2_osj,true);
        $criteria->compare('is_normal',$this->is_normal);
        $criteria->compare('is_abnormal',$this->is_abnormal);
        $criteria->compare('is_glasses',$this->is_glasses);
        $criteria->compare('is_contactlens',$this->is_contactlens);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ApePe3Visualacuity the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
