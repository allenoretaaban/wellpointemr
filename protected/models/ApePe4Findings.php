<?php

/**
 * This is the model class for table "ape_pe4_findings".
 *
 * The followings are the available columns in table 'ape_pe4_findings':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property string $is_ga
 * @property string $ga
 * @property string $is_eyes
 * @property string $eyes
 * @property string $is_ears
 * @property string $ears
 * @property string $is_nose
 * @property string $nose
 * @property string $is_throat
 * @property string $throat
 * @property string $is_mtg
 * @property string $mtg
 * @property string $is_dc
 * @property string $dc
 * @property string $is_dentures
 * @property string $dentures
 * @property string $is_neck
 * @property string $neck
 * @property string $is_heart
 * @property string $heart
 * @property string $is_cl
 * @property string $cl
 * @property string $is_breasts
 * @property string $breasts
 * @property string $is_abdomen
 * @property string $abdomen
 * @property string $is_genital
 * @property string $genital
 * @property string $is_rectal
 * @property string $rectal
 * @property string $is_extr
 * @property string $extr
 * @property string $is_skin
 * @property string $skin
 * @property string $is_neu
 * @property string $neu
 * @property string $is_deform
 * @property string $deform
 * @property string $is_others
 * @property string $others
 */
class ApePe4Findings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ape_pe4_findings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ape_id, user_id', 'length', 'max'=>20),
			array('username, ga, eyes, ears, nose, throat, mtg, dc, dentures, neck, heart, cl, breasts, abdomen, genital, rectal, extr, skin, neu, deform, others', 'length', 'max'=>100),
			array('is_ga, is_eyes, is_ears, is_nose, is_throat, is_mtg, is_dc, is_dentures, is_neck, is_heart, is_cl, is_breasts, is_abdomen, is_genital, is_rectal, is_extr, is_skin, is_neu, is_deform, is_others', 'length', 'max'=>1),
			array('update_datetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ape_id, user_id, username, update_datetime, is_ga, ga, is_eyes, eyes, is_ears, ears, is_nose, nose, is_throat, throat, is_mtg, mtg, is_dc, dc, is_dentures, dentures, is_neck, neck, is_heart, heart, is_cl, cl, is_breasts, breasts, is_abdomen, abdomen, is_genital, genital, is_rectal, rectal, is_extr, extr, is_skin, skin, is_neu, neu, is_deform, deform, is_others, others', 'safe', 'on'=>'search'),
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
			'is_ga' => 'Is Ga',
			'ga' => 'Ga',
			'is_eyes' => 'Is Eyes',
			'eyes' => 'Eyes',
			'is_ears' => 'Is Ears',
			'ears' => 'Ears',
			'is_nose' => 'Is Nose',
			'nose' => 'Nose',
			'is_throat' => 'Is Throat',
			'throat' => 'Throat',
			'is_mtg' => 'Is Mtg',
			'mtg' => 'Mtg',
			'is_dc' => 'Is Dc',
			'dc' => 'Dc',
			'is_dentures' => 'Is Dentures',
			'dentures' => 'Dentures',
			'is_neck' => 'Is Neck',
			'neck' => 'Neck',
			'is_heart' => 'Is Heart',
			'heart' => 'Heart',
			'is_cl' => 'Is Cl',
			'cl' => 'Cl',
			'is_breasts' => 'Is Breasts',
			'breasts' => 'Breasts',
			'is_abdomen' => 'Is Abdomen',
			'abdomen' => 'Abdomen',
			'is_genital' => 'Is Genital',
			'genital' => 'Genital',
			'is_rectal' => 'Is Rectal',
			'rectal' => 'Rectal',
			'is_extr' => 'Is Extr',
			'extr' => 'Extr',
			'is_skin' => 'Is Skin',
			'skin' => 'Skin',
			'is_neu' => 'Is Neu',
			'neu' => 'Neu',
			'is_deform' => 'Is Deform',
			'deform' => 'Deform',
			'is_others' => 'Is Others',
			'others' => 'Others',
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
		$criteria->compare('is_ga',$this->is_ga,true);
		$criteria->compare('ga',$this->ga,true);
		$criteria->compare('is_eyes',$this->is_eyes,true);
		$criteria->compare('eyes',$this->eyes,true);
		$criteria->compare('is_ears',$this->is_ears,true);
		$criteria->compare('ears',$this->ears,true);
		$criteria->compare('is_nose',$this->is_nose,true);
		$criteria->compare('nose',$this->nose,true);
		$criteria->compare('is_throat',$this->is_throat,true);
		$criteria->compare('throat',$this->throat,true);
		$criteria->compare('is_mtg',$this->is_mtg,true);
		$criteria->compare('mtg',$this->mtg,true);
		$criteria->compare('is_dc',$this->is_dc,true);
		$criteria->compare('dc',$this->dc,true);
		$criteria->compare('is_dentures',$this->is_dentures,true);
		$criteria->compare('dentures',$this->dentures,true);
		$criteria->compare('is_neck',$this->is_neck,true);
		$criteria->compare('neck',$this->neck,true);
		$criteria->compare('is_heart',$this->is_heart,true);
		$criteria->compare('heart',$this->heart,true);
		$criteria->compare('is_cl',$this->is_cl,true);
		$criteria->compare('cl',$this->cl,true);
		$criteria->compare('is_breasts',$this->is_breasts,true);
		$criteria->compare('breasts',$this->breasts,true);
		$criteria->compare('is_abdomen',$this->is_abdomen,true);
		$criteria->compare('abdomen',$this->abdomen,true);
		$criteria->compare('is_genital',$this->is_genital,true);
		$criteria->compare('genital',$this->genital,true);
		$criteria->compare('is_rectal',$this->is_rectal,true);
		$criteria->compare('rectal',$this->rectal,true);
		$criteria->compare('is_extr',$this->is_extr,true);
		$criteria->compare('extr',$this->extr,true);
		$criteria->compare('is_skin',$this->is_skin,true);
		$criteria->compare('skin',$this->skin,true);
		$criteria->compare('is_neu',$this->is_neu,true);
		$criteria->compare('neu',$this->neu,true);
		$criteria->compare('is_deform',$this->is_deform,true);
		$criteria->compare('deform',$this->deform,true);
		$criteria->compare('is_others',$this->is_others,true);
		$criteria->compare('others',$this->others,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApePe4Findings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
