<?php

/**
 * This is the model class for table "pds_hmo".
 *
 * The followings are the available columns in table 'pds_hmo':
 * @property string $id
 * @property string $cardno
 * @property string $controlno
 * @property string $approvalcode
 * @property string $notes
 * @property integer $hmo_id
 * @property string $pds_id
 *
 * The followings are the available model relations:
 * @property Hmo $hmo
 * @property Pds $pds
 */
class PdsHmo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PdsHmo the static model class
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
		return 'pds_hmo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cardno, hmo_id, pds_id', 'required'),
			array('hmo_id', 'numerical', 'integerOnly'=>true),
			array('cardno, controlno, approvalcode', 'length', 'max'=>32),
			array('pds_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cardno, controlno, approvalcode, notes, hmo_id, pds_id', 'safe', 'on'=>'search'),
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
			'hmo' => array(self::BELONGS_TO, 'Hmo', 'hmo_id'),
			'pds' => array(self::BELONGS_TO, 'Pds', 'pds_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
                        'cardno' => 'Card No',
			'controlno' => 'Control No',
			'approvalcode' => 'Approval Code',
			'notes' => 'Notes',
			'hmo_id' => 'HMO',
			'pds_id' => 'PDS',
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
		$criteria->compare('cardno',$this->cardno,true);
		$criteria->compare('controlno',$this->controlno,true);
		$criteria->compare('approvalcode',$this->approvalcode,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('hmo_id',$this->hmo_id);
		$criteria->compare('pds_id',$this->pds_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}