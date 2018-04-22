<?php

/**
 * This is the model class for table "ape_diagnostic".
 *
 * The followings are the available columns in table 'ape_diagnostic':
 * @property integer $id
 * @property integer $ape_id
 * @property integer $user_id
 * @property string $username
 * @property string $update_datetime
 * @property integer $cbc_n
 * @property integer $cbc_cif
 * @property integer $cbc_ab
 * @property string $cbc_details
 * @property integer $u_n
 * @property integer $u_cif
 * @property integer $u_ab
 * @property string $u_details
 * @property integer $se_n
 * @property integer $se_cif
 * @property integer $se_ab
 * @property string $se_details
 * @property integer $cx_n
 * @property integer $cx_cif
 * @property integer $cx_ab
 * @property string $cx_details
 * @property integer $hbsag_nr
 * @property integer $hbsag_r
 * @property integer $antihbs_n
 * @property integer $antihbs_p
 * @property integer $dt_n
 * @property integer $dt_p
 * @property integer $dt_marijuana
 * @property integer $dt_shabu
 * @property integer $pt_n
 * @property integer $pt_p
 * @property integer $am_n
 * @property integer $am_cif
 * @property integer $am_ab
 * @property integer $am_chl
 * @property string $chl
 * @property integer $am_shl
 * @property string $shl
 * @property integer $lecg_n
 * @property integer $lecg_cif
 * @property integer $lecg_ab
 * @property string $lecg_details
 * @property integer $us_n
 * @property integer $us_cif
 * @property integer $us_ab
 * @property integer $us_so
 * @property string $so1
 * @property string $so2
 * @property integer $bc_n
 * @property integer $bc_cif
 * @property integer $bc_ab
 * @property integer $bc_st
 * @property string $st1
 * @property string $st2
 * @property integer $others_n
 * @property integer $others_cif
 * @property integer $others_ab
 * @property string $others_details1
 * @property string $others_details2
 * @property string $others_details3
 * @property string $papsmear
 * @property integer $papsmear_n
 * @property integer $papsmear_cif
 * @property integer $papsmear_ab
 */
class ApeDiagnostic extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ape_diagnostic';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ape_id, user_id, cbc_n, cbc_cif, cbc_ab, u_n, u_cif, u_ab, se_n, se_cif, se_ab, cx_n, cx_cif, cx_ab, hbsag_nr, hbsag_r, antihbs_n, antihbs_p, dt_n, dt_p, dt_marijuana, dt_shabu, pt_n, pt_p, am_n, am_cif, am_ab, am_chl, am_shl, lecg_n, lecg_cif, lecg_ab, us_n, us_cif, us_ab, us_so, bc_n, bc_cif, bc_ab, bc_st, others_n, others_cif, others_ab, papsmear_n, papsmear_cif, papsmear_ab', 'numerical', 'integerOnly'=>true),
            array('username, cbc_details, u_details, se_details, cx_details, chl, shl, lecg_details, so1, so2, st1, st2, others_details1, others_details2, others_details3', 'length', 'max'=>100),
            array('update_datetime, papsmear', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ape_id, user_id, username, update_datetime, cbc_n, cbc_cif, cbc_ab, cbc_details, u_n, u_cif, u_ab, u_details, se_n, se_cif, se_ab, se_details, cx_n, cx_cif, cx_ab, cx_details, hbsag_nr, hbsag_r, antihbs_n, antihbs_p, dt_n, dt_p, dt_marijuana, dt_shabu, pt_n, pt_p, am_n, am_cif, am_ab, am_chl, chl, am_shl, shl, lecg_n, lecg_cif, lecg_ab, lecg_details, us_n, us_cif, us_ab, us_so, so1, so2, bc_n, bc_cif, bc_ab, bc_st, st1, st2, others_n, others_cif, others_ab, others_details1, others_details2, others_details3, papsmear, papsmear_n, papsmear_cif, papsmear_ab', 'safe', 'on'=>'search'),
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
            'cbc_n' => 'Cbc N',
            'cbc_cif' => 'Cbc Cif',
            'cbc_ab' => 'Cbc Ab',
            'cbc_details' => 'Cbc Details',
            'u_n' => 'U N',
            'u_cif' => 'U Cif',
            'u_ab' => 'U Ab',
            'u_details' => 'U Details',
            'se_n' => 'Se N',
            'se_cif' => 'Se Cif',
            'se_ab' => 'Se Ab',
            'se_details' => 'Se Details',
            'cx_n' => 'Cx N',
            'cx_cif' => 'Cx Cif',
            'cx_ab' => 'Cx Ab',
            'cx_details' => 'Cx Details',
            'hbsag_nr' => 'Hbsag Nr',
            'hbsag_r' => 'Hbsag R',
            'antihbs_n' => 'Antihbs N',
            'antihbs_p' => 'Antihbs P',
            'dt_n' => 'Dt N',
            'dt_p' => 'Dt P',
            'dt_marijuana' => 'Dt Marijuana',
            'dt_shabu' => 'Dt Shabu',
            'pt_n' => 'Pt N',
            'pt_p' => 'Pt P',
            'am_n' => 'Am N',
            'am_cif' => 'Am Cif',
            'am_ab' => 'Am Ab',
            'am_chl' => 'Am Chl',
            'chl' => 'Chl',
            'am_shl' => 'Am Shl',
            'shl' => 'Shl',
            'lecg_n' => 'Lecg N',
            'lecg_cif' => 'Lecg Cif',
            'lecg_ab' => 'Lecg Ab',
            'lecg_details' => 'Lecg Details',
            'us_n' => 'Us N',
            'us_cif' => 'Us Cif',
            'us_ab' => 'Us Ab',
            'us_so' => 'Us So',
            'so1' => 'So1',
            'so2' => 'So2',
            'bc_n' => 'Bc N',
            'bc_cif' => 'Bc Cif',
            'bc_ab' => 'Bc Ab',
            'bc_st' => 'Bc St',
            'st1' => 'St1',
            'st2' => 'St2',
            'others_n' => 'Others N',
            'others_cif' => 'Others Cif',
            'others_ab' => 'Others Ab',
            'others_details1' => 'Others Details1',
            'others_details2' => 'Others Details2',
            'others_details3' => 'Others Details3',
            'papsmear' => 'Papsmear',
            'papsmear_n' => 'Papsmear N',
            'papsmear_cif' => 'Papsmear Cif',
            'papsmear_ab' => 'Papsmear Ab',
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
        $criteria->compare('ape_id',$this->ape_id);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('update_datetime',$this->update_datetime,true);
        $criteria->compare('cbc_n',$this->cbc_n);
        $criteria->compare('cbc_cif',$this->cbc_cif);
        $criteria->compare('cbc_ab',$this->cbc_ab);
        $criteria->compare('cbc_details',$this->cbc_details,true);
        $criteria->compare('u_n',$this->u_n);
        $criteria->compare('u_cif',$this->u_cif);
        $criteria->compare('u_ab',$this->u_ab);
        $criteria->compare('u_details',$this->u_details,true);
        $criteria->compare('se_n',$this->se_n);
        $criteria->compare('se_cif',$this->se_cif);
        $criteria->compare('se_ab',$this->se_ab);
        $criteria->compare('se_details',$this->se_details,true);
        $criteria->compare('cx_n',$this->cx_n);
        $criteria->compare('cx_cif',$this->cx_cif);
        $criteria->compare('cx_ab',$this->cx_ab);
        $criteria->compare('cx_details',$this->cx_details,true);
        $criteria->compare('hbsag_nr',$this->hbsag_nr);
        $criteria->compare('hbsag_r',$this->hbsag_r);
        $criteria->compare('antihbs_n',$this->antihbs_n);
        $criteria->compare('antihbs_p',$this->antihbs_p);
        $criteria->compare('dt_n',$this->dt_n);
        $criteria->compare('dt_p',$this->dt_p);
        $criteria->compare('dt_marijuana',$this->dt_marijuana);
        $criteria->compare('dt_shabu',$this->dt_shabu);
        $criteria->compare('pt_n',$this->pt_n);
        $criteria->compare('pt_p',$this->pt_p);
        $criteria->compare('am_n',$this->am_n);
        $criteria->compare('am_cif',$this->am_cif);
        $criteria->compare('am_ab',$this->am_ab);
        $criteria->compare('am_chl',$this->am_chl);
        $criteria->compare('chl',$this->chl,true);
        $criteria->compare('am_shl',$this->am_shl);
        $criteria->compare('shl',$this->shl,true);
        $criteria->compare('lecg_n',$this->lecg_n);
        $criteria->compare('lecg_cif',$this->lecg_cif);
        $criteria->compare('lecg_ab',$this->lecg_ab);
        $criteria->compare('lecg_details',$this->lecg_details,true);
        $criteria->compare('us_n',$this->us_n);
        $criteria->compare('us_cif',$this->us_cif);
        $criteria->compare('us_ab',$this->us_ab);
        $criteria->compare('us_so',$this->us_so);
        $criteria->compare('so1',$this->so1,true);
        $criteria->compare('so2',$this->so2,true);
        $criteria->compare('bc_n',$this->bc_n);
        $criteria->compare('bc_cif',$this->bc_cif);
        $criteria->compare('bc_ab',$this->bc_ab);
        $criteria->compare('bc_st',$this->bc_st);
        $criteria->compare('st1',$this->st1,true);
        $criteria->compare('st2',$this->st2,true);
        $criteria->compare('others_n',$this->others_n);
        $criteria->compare('others_cif',$this->others_cif);
        $criteria->compare('others_ab',$this->others_ab);
        $criteria->compare('others_details1',$this->others_details1,true);
        $criteria->compare('others_details2',$this->others_details2,true);
        $criteria->compare('others_details3',$this->others_details3,true);
        $criteria->compare('papsmear',$this->papsmear,true);
        $criteria->compare('papsmear_n',$this->papsmear_n);
        $criteria->compare('papsmear_cif',$this->papsmear_cif);
        $criteria->compare('papsmear_ab',$this->papsmear_ab);

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
     * @return ApeDiagnostic the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
