<?php

/**
 * This is the model class for table "announce".
 *
 * The followings are the available columns in table 'announce':
 * @property integer $id
 * @property string $address_html
 * @property string $address
 * @property string $dasma_address_html
 * @property string $dasma_address
 * @property strings $bacoor_address
 *
 * The followings are the available model relations:
 * @property Users $byuser
 */
class Settings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Announce the static model class
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
		return 'settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address_html', 'required'),
			array('address', 'required'),
			array('dasma_address_html', 'required'),
			array('dasma_address', 'required'),
			array('bacoor_address', 'required'),
			//array('id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id', 'safe', 'on'=>'search'),
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
			'byuser' => array(self::BELONGS_TO, 'Users', 'byuserid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'address_html' => 'Address HTML',
			'address' => 'Address',
			'dasma_address_html' => 'Dasma Address HTML',
			'dasma_address' => 'Dasma Address',
			'bacoor_address' => 'Bacoor Address',
			//'byuserid' => 'Byuserid',
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
		$criteria->compare('address_html',$this->address_html,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('dasma_address_html',$this->dasma_address,true);
		$criteria->compare('dasma_address',$this->dasma_address,true);
		$criteria->compare('bacoor_address',$this->bacoor_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}