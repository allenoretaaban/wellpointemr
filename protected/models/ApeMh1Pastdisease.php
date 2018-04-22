<?php

/**
 * This is the model class for table "ape_mh1_pastdisease".
 *
 * The followings are the available columns in table 'ape_mh1_pastdisease':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property integer $is_fhm
 * @property integer $is_lc
 * @property integer $is_dbp
 * @property integer $is_wpnt
 * @property integer $is_bvep
 * @property integer $is_hdep
 * @property integer $is_fstcs
 * @property integer $is_pcsb
 * @property integer $is_fbpr
 * @property integer $is_up
 * @property integer $is_cd
 * @property integer $is_ap
 * @property integer $is_gopd
 * @property integer $is_a
 * @property integer $is_etoaw
 * @property integer $is_cphp
 * @property integer $is_yes
 * @property integer $is_hbbs
 * @property integer $is_fsjs
 * @property integer $is_bt
 * @property integer $is_spcl
 * @property integer $is_etb
 * @property integer $is_la
 * @property integer $is_wlwg
 * @property integer $is_sp
 * @property integer $is_nd
 * @property integer $is_al
 * @property string $al
 * @property integer $is_oc
 * @property string $oc
 * @property integer $is_hpidhs
 * @property string $year1
 * @property string $year1_rd
 * @property string $year2
 * @property string $year2_rd
 */
class ApeMh1Pastdisease extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ape_mh1_pastdisease';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('is_fhm, is_lc, is_dbp, is_wpnt, is_bvep, is_hdep, is_fstcs, is_pcsb, is_fbpr, is_up, is_cd, is_ap, is_gopd, is_a, is_etoaw, is_cphp, is_yes, is_hbbs, is_fsjs, is_bt, is_spcl, is_etb, is_la, is_wlwg, is_sp, is_nd, is_al, is_oc, is_hpidhs', 'numerical', 'integerOnly'=>true),
            array('ape_id, user_id', 'length', 'max'=>20),
            array('username, al, oc, year1_rd, year2_rd', 'length', 'max'=>100),
            array('year1, year2', 'length', 'max'=>4),
            array('update_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ape_id, user_id, username, update_datetime, is_fhm, is_lc, is_dbp, is_wpnt, is_bvep, is_hdep, is_fstcs, is_pcsb, is_fbpr, is_up, is_cd, is_ap, is_gopd, is_a, is_etoaw, is_cphp, is_yes, is_hbbs, is_fsjs, is_bt, is_spcl, is_etb, is_la, is_wlwg, is_sp, is_nd, is_al, al, is_oc, oc, is_hpidhs, year1, year1_rd, year2, year2_rd', 'safe', 'on'=>'search'),
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
            'is_fhm' => 'Is Fhm',
            'is_lc' => 'Is Lc',
            'is_dbp' => 'Is Dbp',
            'is_wpnt' => 'Is Wpnt',
            'is_bvep' => 'Is Bvep',
            'is_hdep' => 'Is Hdep',
            'is_fstcs' => 'Is Fstcs',
            'is_pcsb' => 'Is Pcsb',
            'is_fbpr' => 'Is Fbpr',
            'is_up' => 'Is Up',
            'is_cd' => 'Is Cd',
            'is_ap' => 'Is Ap',
            'is_gopd' => 'Is Gopd',
            'is_a' => 'Is A',
            'is_etoaw' => 'Is Etoaw',
            'is_cphp' => 'Is Cphp',
            'is_yes' => 'Is Yes',
            'is_hbbs' => 'Is Hbbs',
            'is_fsjs' => 'Is Fsjs',
            'is_bt' => 'Is Bt',
            'is_spcl' => 'Is Spcl',
            'is_etb' => 'Is Etb',
            'is_la' => 'Is La',
            'is_wlwg' => 'Is Wlwg',
            'is_sp' => 'Is Sp',
            'is_nd' => 'Is Nd',
            'is_al' => 'Is Al',
            'al' => 'Al',
            'is_oc' => 'Is Oc',
            'oc' => 'Oc',
            'is_hpidhs' => 'Is Hpidhs',
            'year1' => 'Year1',
            'year1_rd' => 'Year1 Rd',
            'year2' => 'Year2',
            'year2_rd' => 'Year2 Rd',
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
        $criteria->compare('is_fhm',$this->is_fhm);
        $criteria->compare('is_lc',$this->is_lc);
        $criteria->compare('is_dbp',$this->is_dbp);
        $criteria->compare('is_wpnt',$this->is_wpnt);
        $criteria->compare('is_bvep',$this->is_bvep);
        $criteria->compare('is_hdep',$this->is_hdep);
        $criteria->compare('is_fstcs',$this->is_fstcs);
        $criteria->compare('is_pcsb',$this->is_pcsb);
        $criteria->compare('is_fbpr',$this->is_fbpr);
        $criteria->compare('is_up',$this->is_up);
        $criteria->compare('is_cd',$this->is_cd);
        $criteria->compare('is_ap',$this->is_ap);
        $criteria->compare('is_gopd',$this->is_gopd);
        $criteria->compare('is_a',$this->is_a);
        $criteria->compare('is_etoaw',$this->is_etoaw);
        $criteria->compare('is_cphp',$this->is_cphp);
        $criteria->compare('is_yes',$this->is_yes);
        $criteria->compare('is_hbbs',$this->is_hbbs);
        $criteria->compare('is_fsjs',$this->is_fsjs);
        $criteria->compare('is_bt',$this->is_bt);
        $criteria->compare('is_spcl',$this->is_spcl);
        $criteria->compare('is_etb',$this->is_etb);
        $criteria->compare('is_la',$this->is_la);
        $criteria->compare('is_wlwg',$this->is_wlwg);
        $criteria->compare('is_sp',$this->is_sp);
        $criteria->compare('is_nd',$this->is_nd);
        $criteria->compare('is_al',$this->is_al);
        $criteria->compare('al',$this->al,true);
        $criteria->compare('is_oc',$this->is_oc);
        $criteria->compare('oc',$this->oc,true);
        $criteria->compare('is_hpidhs',$this->is_hpidhs);
        $criteria->compare('year1',$this->year1,true);
        $criteria->compare('year1_rd',$this->year1_rd,true);
        $criteria->compare('year2',$this->year2,true);
        $criteria->compare('year2_rd',$this->year2_rd,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ApeMh1Pastdisease the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
