<?php

/**
 * This is the model class for table "dailysheetform".
 *
 * The followings are the available columns in table 'dailysheetform':
 * @property string $id
 * @property string $date
 * @property double $beginningcash
 * @property string $supervisorname
 * @property integer $denomination1000
 * @property integer $denomination500
 * @property integer $denomination200
 * @property integer $denomination100
 * @property integer $denomination50
 * @property integer $denomination20
 * @property integer $denomination10
 * @property integer $denomination5
 * @property integer $denomination1
 * @property integer $denomination50c
 * @property integer $denomination25c
 * @property integer $denomination10c
 * @property integer $denomination5c
 * @property integer $hmocensus_laboratory
 * @property integer $hmocensus_ancillary
 * @property integer $hmocensus_consultation
 * @property double $total
 * @property string $verifiedby
 * @property string $preparedby
 */
class Dailysheetform extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Dailysheetform the static model class
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
		return 'dailysheetform';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date, beginningcash', 'required'),
			array('denomination1000, denomination500, denomination200, denomination100, denomination50, denomination20, denomination10, denomination5, denomination1, denomination50c, denomination25c, denomination10c, denomination5c, hmocensus_laboratory, hmocensus_ancillary, hmocensus_consultation', 'numerical', 'integerOnly'=>true),
			array('beginningcash, total', 'numerical'),
			array('supervisorname, verifiedby, preparedby', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, beginningcash, supervisorname, denomination1000, denomination500, denomination200, denomination100, denomination50, denomination20, denomination10, denomination5, denomination1, denomination50c, denomination25c, denomination10c, denomination5c, hmocensus_laboratory, hmocensus_ancillary, hmocensus_consultation, total, verifiedby, preparedby', 'safe', 'on'=>'search'),
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
			'date' => 'Date',
			'beginningcash' => 'Beginning Cash',
			'supervisorname' => 'Supervisor',
			'denomination1000' => '1000 pesos',
			'denomination500' => '500 pesos',
			'denomination200' => '200 pesos',
			'denomination100' => '100 pesos',
			'denomination50' => '50 pesos',
			'denomination20' => '20 pesos',
			'denomination10' => '10 pesos',
			'denomination5' => '5 pesos',
			'denomination1' => '1 peso',
			'denomination50c' => '50 cents',
			'denomination25c' => '25 cents',
			'denomination10c' => '10 cents',
			'denomination5c' => '5 cents',
            'hmocensus_laboratory' => 'Laboratory',
            'hmocensus_ancillary' => 'Ancillary',
            'hmocensus_consultation' => 'Consultation',
            'total' => 'total',
			'verifiedby' => 'Verified By',
			'preparedby' => 'Prepared By',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('beginningcash',$this->beginningcash);
		$criteria->compare('supervisorname',$this->supervisorname,true);
		$criteria->compare('denomination1000',$this->denomination1000);
		$criteria->compare('denomination500',$this->denomination500);
		$criteria->compare('denomination200',$this->denomination200);
		$criteria->compare('denomination100',$this->denomination100);
		$criteria->compare('denomination50',$this->denomination50);
		$criteria->compare('denomination20',$this->denomination20);
		$criteria->compare('denomination10',$this->denomination10);
		$criteria->compare('denomination5',$this->denomination5);
		$criteria->compare('denomination1',$this->denomination1);
		$criteria->compare('denomination50c',$this->denomination50c);
		$criteria->compare('denomination25c',$this->denomination25c);
		$criteria->compare('denomination10c',$this->denomination10c);
		$criteria->compare('denomination5c',$this->denomination5c);
        $criteria->compare('hmocensus_laboratory',$this->hmocensus_laboratory);
        $criteria->compare('hmocensus_ancillary',$this->hmocensus_ancillary);
        $criteria->compare('hmocensus_consultation',$this->hmocensus_consultation);
        $criteria->compare('total',$this->total);
		$criteria->compare('verifiedby',$this->verifiedby,true);
		$criteria->compare('preparedby',$this->preparedby,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}