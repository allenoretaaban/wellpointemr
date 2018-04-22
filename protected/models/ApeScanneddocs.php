<?php

/**
 * This is the model class for table "ape_scanneddocs".
 *
 * The followings are the available columns in table 'ape_scanneddocs':
 * @property integer $id
 * @property string $ape_id
 * @property string $user_id
 * @property string $username
 * @property string $update_datetime
 * @property string $title
 * @property string $description
 * @property string $filepath
 */
class ApeScanneddocs extends CActiveRecord
{
    public $file;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ape_scanneddocs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('title, ape_id, user_id', 'required'),
			array('ape_id, user_id', 'length', 'max'=>20),
			array('username', 'length', 'max'=>100),
			array('title, description, filepath', 'length', 'max'=>250),
			array('update_datetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ape_id, user_id, username, update_datetime, title, description, filepath, file, filename, date_uploaded', 'safe', 'on'=>'search'),
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
            'ape' => array(self::BELONGS_TO, 'Ape', 'ape_id'),
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
			'title' => 'Title',
			'description' => 'Description',
            'file' => 'File',
            'filepath' => 'File Path',
            'filename' => 'File Name',
			'date_uploaded' => 'Date Uploaded',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
        $criteria->compare('filepath',$this->filepath,true);
        $criteria->compare('filename',$this->filename,true);
		$criteria->compare('date_uploaded',$this->date_uploaded,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApeScanneddocs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
