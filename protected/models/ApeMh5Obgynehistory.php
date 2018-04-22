<?php

/**
 * This is the model class for table "ape_mh5_obgynehistory".
 *
 * The followings are the available columns in table 'ape_mh5_obgynehistory':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property string $lmp
 * @property integer $is_lmpmon
 * @property integer $is_lmpirregular
 * @property integer $is_pyes
 * @property integer $is_pno
 * @property integer $is_preeclampsia
 * @property integer $is_eclampsia
 * @property integer $is_miscarriage
 * @property integer $is_caesarian
 * @property string $miscarriage
 * @property string $caesarian
 */
class ApeMh5Obgynehistory extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ape_mh5_obgynehistory';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('is_lmpmon, is_lmpirregular, is_pyes, is_pno, is_preeclampsia, is_eclampsia, is_miscarriage, is_caesarian', 'numerical', 'integerOnly'=>true),
            array('ape_id, user_id', 'length', 'max'=>20),
            array('username, lmp, miscarriage, caesarian', 'length', 'max'=>100),
            array('update_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ape_id, user_id, username, update_datetime, lmp, is_lmpmon, is_lmpirregular, is_pyes, is_pno, is_preeclampsia, is_eclampsia, is_miscarriage, is_caesarian, miscarriage, caesarian', 'safe', 'on'=>'search'),
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
            'lmp' => 'Lmp',
            'is_lmpmon' => 'Is Lmpmon',
            'is_lmpirregular' => 'Is Lmpirregular',
            'is_pyes' => 'Is Pyes',
            'is_pno' => 'Is Pno',
            'is_preeclampsia' => 'Is Preeclampsia',
            'is_eclampsia' => 'Is Eclampsia',
            'is_miscarriage' => 'Is Miscarriage',
            'is_caesarian' => 'Is Caesarian',
            'miscarriage' => 'Miscarriage',
            'caesarian' => 'Caesarian',
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
        $criteria->compare('lmp',$this->lmp,true);
        $criteria->compare('is_lmpmon',$this->is_lmpmon);
        $criteria->compare('is_lmpirregular',$this->is_lmpirregular);
        $criteria->compare('is_pyes',$this->is_pyes);
        $criteria->compare('is_pno',$this->is_pno);
        $criteria->compare('is_preeclampsia',$this->is_preeclampsia);
        $criteria->compare('is_eclampsia',$this->is_eclampsia);
        $criteria->compare('is_miscarriage',$this->is_miscarriage);
        $criteria->compare('is_caesarian',$this->is_caesarian);
        $criteria->compare('miscarriage',$this->miscarriage,true);
        $criteria->compare('caesarian',$this->caesarian,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ApeMh5Obgynehistory the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
