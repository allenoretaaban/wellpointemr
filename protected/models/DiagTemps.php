<?php

/**
 * This is the model class for table "diag_temps".
 *
 * The followings are the available columns in table 'diag_temps':
 * @property integer $id
 * @property string $createdate
 * @property integer $createby
 * @property integer $updateby
 * @property string $temp_title
 * @property string $result_title 
 * @property string $diag_type
 */
class DiagTemps extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Diag the static model class
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
		return 'diag_temps';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('updateby, temp_title,content_format,diag_type', 'required'),
			array('createby, updateby', 'numerical', 'integerOnly'=>true),
			array('temp_title, result_title,diag_type', 'length', 'max'=>250),			
            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, createdate, createby, updateby, temp_title, result_title,diag_type', 'safe', 'on'=>'search'),
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
			'createdate' => 'Create Date',
			'createby' => 'Created By',
			'updateby' => 'Update By',
			'temp_title' => 'Diagnostic Result Template Title',
            'result_title' => 'Result Print Title', 
            'content_format' => 'Content Format',
            'diag_type' => 'Diagnostic Type',
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
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('createby',$this->createby);
		$criteria->compare('updateby',$this->updateby);
		$criteria->compare('temp_title',$this->temp_title,true);
        $criteria->compare('diag_type',$this->diag_type,true);
        $criteria->compare('result_title',$this->result_title,true);
        $criteria->compare('content_format',$this->content_format,true);
         $criteria->order = 'temp_title asc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
}
