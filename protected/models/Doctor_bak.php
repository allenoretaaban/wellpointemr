<?php

/**
 * This is the model class for table "doctor".
 *
 * The followings are the available columns in table 'doctor':
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $specialization
 * @property string $pmano
 * @property string $prcno
 * @property string $tinno
 * @property string $isresident
 */
class Doctor extends CActiveRecord
{
        public $image;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Doctor the static model class
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
		return 'doctor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname', 'required'),
			array('firstname, lastname', 'length', 'max'=>64),
			array('filename, specialization', 'length', 'max'=>128),
			array('pmano, prcno, tinno', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firstname, lastname, specialization, pmano, prcno, tinno', 'safe', 'on'=>'search'),
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
                        'image' => 'Picture',
                        'filename' => 'Picture',
			'firstname' => 'First Name',
			'lastname' => 'Last Name',
			'specialization' => 'Specialization',
			'pmano' => 'PMA No.',
			'prcno' => 'PRC No.',
			'tinno' => 'Tin No.',
            'isresident' => 'Is Resident Doctor'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('specialization',$this->specialization,true);
		$criteria->compare('pmano',$this->pmano,true);
		$criteria->compare('prcno',$this->prcno,true);
		$criteria->compare('tinno',$this->tinno,true);
        $criteria->compare('isresident',$this->tinno,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}