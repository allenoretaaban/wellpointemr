<?php

/**
 * This is the model class for table "hmo_billing".
 *
 * The followings are the available columns in table 'hmo_billing':
 * @property string $id
 * @property string $hmo_id
 * @property string $hmo
 * @property string $prepared_by
 * @property string $by_userid
 * @property string $date_prepared
 * @property string $date_due
 * @property string $pds_hmo_id
 * @property double $bill_total
 *
 * The followings are the available model relations:
 * @property PdsHmo $pdsHmo
 * @property HmoBillingItem[] $hmoBillingItems
 */
class HmoBilling extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HmoBilling the static model class
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
		return 'hmo_billing';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hmo_id', 'required'),
			array('bill_total', 'numerical'),
			array('hmo_id, pds_hmo_id', 'length', 'max'=>20),
			array('home, prepared_by', 'length', 'max'=>150),
			array('by_userid', 'length', 'max'=>11),
			array('to_date, from_date, date_prepared, date_due', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, to_date, hmo, from_date, hmo_id, prepared_by, by_userid, date_prepared, date_due, pds_hmo_id, bill_total', 'safe', 'on'=>'search'),
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
			'pdsHmo' => array(self::BELONGS_TO, 'PdsHmo', 'pds_hmo_id'),
			'hmoBillingItems' => array(self::HAS_MANY, 'HmoBillingItem', 'hmo_billing_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'SOA No',
            'to_date' => 'To Date', 
            'from_date' => 'From Date',             
			'hmo_id' => 'HMO Id',
            'hmo' => 'HMO',
			'prepared_by' => 'Prepared By',
			'by_userid' => 'By Userid',
			'date_prepared' => 'Date Prepared',
			'date_due' => 'Due Date',
			'pds_hmo_id' => 'Pds Hmo',
			'bill_total' => 'Bill Total',
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
        $criteria->compare('from_date',$this->from_date,true);
        $criteria->compare('to_date',$this->to_date,true);
		$criteria->compare('hmo_id',$this->hmo_id,true);
		$criteria->compare('prepared_by',$this->prepared_by,true);
		$criteria->compare('by_userid',$this->by_userid,true);
		$criteria->compare('date_prepared',$this->date_prepared,true);
		$criteria->compare('date_due',$this->date_due,true);
		$criteria->compare('pds_hmo_id',$this->pds_hmo_id,true);
        $criteria->order='id desc';    

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
		));
	}
    
    public function searchValuCare()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('hmo_id',14);
        $criteria->compare('from_date',$this->from_date,true);
        $criteria->compare('to_date',$this->to_date,true);
        $criteria->compare('hmo_id',$this->hmo_id,true);
        $criteria->compare('prepared_by',$this->prepared_by,true);
        $criteria->compare('by_userid',$this->by_userid,true);
        $criteria->compare('date_prepared',$this->date_prepared,true);
        $criteria->compare('date_due',$this->date_due,true);
        $criteria->compare('pds_hmo_id',$this->pds_hmo_id,true);
        $criteria->order='id desc';    

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));   
    }
    
    public function searchMaxiCare()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('hmo_id',4);
        $criteria->compare('from_date',$this->from_date,true);
        $criteria->compare('to_date',$this->to_date,true);
        $criteria->compare('hmo_id',$this->hmo_id,true);
        $criteria->compare('prepared_by',$this->prepared_by,true);
        $criteria->compare('by_userid',$this->by_userid,true);
        $criteria->compare('date_prepared',$this->date_prepared,true);
        $criteria->compare('date_due',$this->date_due,true);
        $criteria->compare('pds_hmo_id',$this->pds_hmo_id,true);
        $criteria->order='id desc';    

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));   
    }
    
    public function searchHmi()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('hmo_id',5);
        $criteria->compare('from_date',$this->from_date,true);
        $criteria->compare('to_date',$this->to_date,true);
        $criteria->compare('hmo_id',$this->hmo_id,true);
        $criteria->compare('prepared_by',$this->prepared_by,true);
        $criteria->compare('by_userid',$this->by_userid,true);
        $criteria->compare('date_prepared',$this->date_prepared,true);
        $criteria->compare('date_due',$this->date_due,true);
        $criteria->compare('pds_hmo_id',$this->pds_hmo_id,true);
        $criteria->order='hmo_id desc';    

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>50,
            ),
        ));   
    }
    
    public function arreport(){
        $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM hmo_billing')->queryScalar();
        $sql='SELECT * FROM hmo_billing';
        $dataProvider=new CSqlDataProvider($sql, array(
            'totalItemCount'=>$count,
            'sort'=>array(
                'attributes'=>array(
                     'id'
                ),
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));  
        return $dataProvider ;  
    }
    
    public function hmoArReport($hmoid, $dstart, $dend){
        $criteria=new CDbCriteria;
        //$criteria->addBetweenCondition() = "date_prepared between '$dstart' and '$dend'";
        $criteria->condition = "hmo_id = $hmoid and bill_total > 0";
        $criteria->addBetweenCondition("date_prepared", $dstart, $dend, 'AND');

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>30,
            ),
         ));
        
    }
    
     public function trnxsReport($billid ){
        $count=Yii::app()->db->createCommand('select count(*) as tcount
                                from hmo_form_items b     
                                 left join hmo_form c
                                 on b.hmo_form_id = c.id
                                 where c.hmo_billing_id = '.$billid)->queryScalar();
        $sql='select * from hmo_form_items b     
                                 left join hmo_form c
                                 on b.hmo_form_id = c.id
                                 where c.hmo_billing_id = '.$billid;
        $dataProvider=new CSqlDataProvider($sql, array(
            'totalItemCount'=>$count,
            'sort'=>array(
                'attributes'=>array(
                     'id'
                ),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        
        return $dataProvider;
        
    }
    
    
    
}