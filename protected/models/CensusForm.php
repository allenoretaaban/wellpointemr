<?php

class CensusForm extends CFormModel
{
	public $datefrom;
	public $dateto;
	public $preparedby;
	public $preparedbytitle;
	public $checkedby;
	public $checkedbytitle;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(        
			array('datefrom, dateto, preparedby, preparedbytitle, checkedby, checkedbytitle', 'required'),
            array('preparedby, preparedbytitle, checkedby, checkedbytitle', 'length', 'max'=>128)
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'datefrom'=>'From Date',
			'dateto'=>'To Date',
			'preparedby'=>'Prepared by',
			'preparedbytitle'=>'Designation',
			'checkedby'=>'Checked by',
			'checkedbytitle'=>'Designation',
		);
	}                 
}