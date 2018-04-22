<?php

/**
 * This is the model class for table "ape_mh3_socialhistory".
 *
 * The followings are the available columns in table 'ape_mh3_socialhistory':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property integer $smoking_no
 * @property integer $smoking_yes
 * @property integer $spd
 * @property integer $smoking_stopped
 * @property integer $n
 * @property integer $is_month
 * @property integer $is_year
 * @property integer $drinking_no
 * @property integer $drinking_yes
 * @property integer $is_occassional
 * @property integer $is_weekly
 * @property integer $is_beer
 * @property integer $is_gin
 * @property integer $is_wine
 * @property integer $shots_n
 * @property integer $is_shots
 * @property integer $bottles_n
 * @property integer $is_bottles
 * @property integer $is_intoxication
 * @property integer $is_nointoxication
 */
class ApeMh3Socialhistory extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ape_mh3_socialhistory';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('smoking_no, smoking_yes, spd, smoking_stopped, n, is_month, is_year, drinking_no, drinking_yes, is_occassional, is_weekly, is_beer, is_gin, is_wine, shots_n, is_shots, bottles_n, is_bottles, is_intoxication, is_nointoxication', 'numerical', 'integerOnly'=>true),
            array('ape_id, user_id', 'length', 'max'=>20),
            array('username', 'length', 'max'=>100),
            array('update_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ape_id, user_id, username, update_datetime, smoking_no, smoking_yes, spd, smoking_stopped, n, is_month, is_year, drinking_no, drinking_yes, is_occassional, is_weekly, is_beer, is_gin, is_wine, shots_n, is_shots, bottles_n, is_bottles, is_intoxication, is_nointoxication', 'safe', 'on'=>'search'),
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
            'smoking_no' => 'Smoking No',
            'smoking_yes' => 'Smoking Yes',
            'spd' => 'Spd',
            'smoking_stopped' => 'Smoking Stopped',
            'n' => 'N',
            'is_month' => 'Is Month',
            'is_year' => 'Is Year',
            'drinking_no' => 'Drinking No',
            'drinking_yes' => 'Drinking Yes',
            'is_occassional' => 'Is Occassional',
            'is_weekly' => 'Is Weekly',
            'is_beer' => 'Is Beer',
            'is_gin' => 'Is Gin',
            'is_wine' => 'Is Wine',
            'shots_n' => 'Shots N',
            'is_shots' => 'Is Shots',
            'bottles_n' => 'Bottles N',
            'is_bottles' => 'Is Bottles',
            'is_intoxication' => 'Is Intoxication',
            'is_nointoxication' => 'Is Nointoxication',
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
        $criteria->compare('smoking_no',$this->smoking_no);
        $criteria->compare('smoking_yes',$this->smoking_yes);
        $criteria->compare('spd',$this->spd);
        $criteria->compare('smoking_stopped',$this->smoking_stopped);
        $criteria->compare('n',$this->n);
        $criteria->compare('is_month',$this->is_month);
        $criteria->compare('is_year',$this->is_year);
        $criteria->compare('drinking_no',$this->drinking_no);
        $criteria->compare('drinking_yes',$this->drinking_yes);
        $criteria->compare('is_occassional',$this->is_occassional);
        $criteria->compare('is_weekly',$this->is_weekly);
        $criteria->compare('is_beer',$this->is_beer);
        $criteria->compare('is_gin',$this->is_gin);
        $criteria->compare('is_wine',$this->is_wine);
        $criteria->compare('shots_n',$this->shots_n);
        $criteria->compare('is_shots',$this->is_shots);
        $criteria->compare('bottles_n',$this->bottles_n);
        $criteria->compare('is_bottles',$this->is_bottles);
        $criteria->compare('is_intoxication',$this->is_intoxication);
        $criteria->compare('is_nointoxication',$this->is_nointoxication);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ApeMh3Socialhistory the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
