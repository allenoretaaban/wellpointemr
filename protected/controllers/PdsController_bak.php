<?php

class PdsController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','select'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                $model=new Pds;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);
                
                $model->datevisited = date('Y-m-d');

                if(isset($_POST['Pds']))
                {
                        $model->attributes=$_POST['Pds'];
                        $model->patient_id=$_GET['id'];
                        if($model->save())
                                $this->redirect(array('view','id'=>$model->id));
                } else
                {
                        if (!$_GET)
                            $this->redirect(array('select'));
                }

                $this->render('create',array(
                        'model'=>$model,
                ));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pds']))
		{
			$model->attributes=$_POST['Pds'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pds('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pds']))
			$model->attributes=$_GET['Pds'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionSelect()
        {
                $this->render('select',array());
        }
        
        public function actionPrint()
        {
            $pds = Pds::model()->findByPk($_GET['id']);
            $patient = $pds->patient;        
            $print = implode("", file(Yii::app()->getBasePath().'\views\pds\include\PDS_front.html'));
            $imgurl = Yii::app()->request->baseUrl.'/images/pds_front';
            $print = str_replace("[imgurl]",$imgurl,$print);
            $logo = Yii::app()->request->baseUrl.'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);
            $visit = date('F d, Y', strtotime($pds->datevisited));
            $print = str_replace("[datevisited]",$visit,$print);
            $print = str_replace("[visitreason]",$pds->visitreason,$print);
            $print = str_replace("[lastname]",$patient->lastname,$print);
            $print = str_replace("[firstname]",$patient->firstname,$print);
            $print = str_replace("[middleinitial]",$patient->middleinitial,$print);
            $bday = date('F d, Y', strtotime($patient->birthdate));
            $print = str_replace("[birthdate]",$bday,$print);
            //get age
            $birthDate = date('m/d/Y', strtotime($patient->birthdate));
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
            $print = str_replace("[age]",$age,$print);
            //sex
            if($patient->gender == 'M'){
                $boxm = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                $boxf = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            }else{ 
                $boxf = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                $boxm = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            }
            $print = str_replace("[imgurlm]",$boxm,$print);
            $print = str_replace("[imgurlf]",$boxf,$print);
            //civil status
            $boxsin = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            $boxmar = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            $boxwid = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            $boxsep = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            switch(trim($patient->civilstatus)){
                case 'Married':
                    $boxmar = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                break;
                case 'Single':
                    $boxsin = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                break;
                case 'Widow':
                    $boxwid= Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                break;
                case 'Separated':
                    $boxsep = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                break;
                default:
                    $boxsin = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                break;
            }
            $print = str_replace("[imgurlmar]",$boxmar,$print);
            $print = str_replace("[imgurlsin]",$boxsin,$print);
            $print = str_replace("[imgurlwid]",$boxwid,$print);
            $print = str_replace("[imgurlsep]",$boxsep,$print);
            //pds number
            $pds->id == "" ? $pdsid = '______' : $pdsid = $pds->id;
            $print = str_replace("[pdsid]",$pdsid,$print);
            //pds id            
            $patient->id == "" ? $patid = '______' : $patid = $patient->id;
            $print = str_replace("[patid]",$patid,$print);
            $print = str_replace("[company]",$patient->company,$print);
            //patient image
            $picture = Yii::app()->request->baseUrl.'/'.$patient->filename;
            $print = str_replace("[filename]",$picture,$print);  
            //address
            $add = '';
            (trim($patient->street1) != '') ? $add .= trim($patient->street1).', ' : $add.='' ;
            (trim($patient->street2) != '') ? $add .= trim($patient->street2).', ' : $add.='' ;
            (trim($patient->barangay) != '') ? $add .= trim($patient->barangay).', ' : $add.='' ;
            (trim($patient->city) != '') ? $add .= trim($patient->city).', ' : $add.='' ;
            (trim($patient->province) != '') ? $add .= trim($patient->province) : $add.='' ;
            $print = str_replace("[patient_address]",$add,$print);
            
            //other informations
            $print = str_replace("[company]",$patient->company,$print);
            $print = str_replace("[occupation]",$patient->occupation,$print);
            $print = str_replace("[spousename]",$patient->spousename,$print);
            $print = str_replace("[spouseoccupation]",$patient->spouseoccupation,$print);
            $print = str_replace("[emergencycontactname]",$patient->emergencycontactname,$print);
            $print = str_replace("[emergencycontactrelation]",$patient->emergencycontactrelation,$print);
            $print = str_replace("[emergencycontactaddress]",$patient->emergencycontactaddress,$print);
            $print = str_replace("[emergencycontactnos]",$patient->emergencycontactnos,$print);
			
			$contact_no='';$mob='';$tel='';
            (trim($patient->mobile_no) != '') ? $contact_no .= trim($patient->mobile_no) : $contact_no.='' ;
            (trim($patient->tel_no) != '') ? $tel = trim($patient->tel_no) : $tel = '' ;
            (trim($patient->mobile_no) != '') ? $contact_no .= ' / '.$tel : $contact_no .= $tel ;
            $print = str_replace("[patient_contact]",$contact_no,$print);
			
            echo $print;
            exit;
        }
        
        public function actionPrintBack()
        {
            $pds = Pds::model()->findByPk($_GET['id']);
            $patient = $pds->patient;        
            $print = implode("", file(Yii::app()->getBasePath().'\views\pds\include\PDS_back.html'));
            //$print = implode("", file(Yii::app()->getBasePath().'\views\pds\include\pds.html'));
            $imgurl = Yii::app()->request->baseUrl.'/images/pds_back';
            $print = str_replace("[imgurl]",$imgurl,$print);
            $logo = Yii::app()->request->baseUrl.'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);
            $visit = date('F d, Y', strtotime($pds->datevisited));
            $print = str_replace("[datevisited]",$visit,$print);
            $print = str_replace("[visitreason]",$pds->visitreason,$print);
            $print = str_replace("[lastname]",$patient->lastname,$print);
            $print = str_replace("[firstname]",$patient->firstname,$print);
            $print = str_replace("[middleinitial]",$patient->middleinitial,$print);
            $bday = date('F d, Y', strtotime($patient->birthdate));
            $print = str_replace("[birthdate]",$bday,$print);
            //get age
            $birthDate = date('m/d/Y', strtotime($patient->birthdate));
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
            $print = str_replace("[age]",$age,$print);
            //sex
            if($patient->gender == 'M'){
                $boxm = Yii::app()->request->baseUrl.'/images/pds_back/box_x.jpg';
                $boxf = Yii::app()->request->baseUrl.'/images/pds_back/box.jpg';
            }else{ 
                $boxf = Yii::app()->request->baseUrl.'/images/pds_back/box_x.jpg';
                $boxm = Yii::app()->request->baseUrl.'/images/pds_back/box.jpg';
            }
            $print = str_replace("[imgurlm]",$boxm,$print);
            $print = str_replace("[imgurlf]",$boxf,$print);
            //civil status
            $boxsin = Yii::app()->request->baseUrl.'/images/pds_folder/box.jpg';
            $boxmar = Yii::app()->request->baseUrl.'/images/pds_folder/box.jpg';
            $boxwid = Yii::app()->request->baseUrl.'/images/pds_folder/box.jpg';
            $boxsep = Yii::app()->request->baseUrl.'/images/pds_folder/box.jpg';
            switch(trim($patient->civilstatus)){
                case 'Married':
                    $boxmar = Yii::app()->request->baseUrl.'/images/pds_back/box_x.jpg';
                break;
                case 'Single':
                    $boxsin = Yii::app()->request->baseUrl.'/images/pds_back/box_x.jpg';
                break;
                case 'Widow':
                    $boxwid= Yii::app()->request->baseUrl.'/images/pds_back/box_x.jpg';
                break;
                case 'Separated':
                    $boxsep = Yii::app()->request->baseUrl.'/images/pds_back/box_x.jpg';
                break;
                default:
                    $boxsin = Yii::app()->request->baseUrl.'/images/pds_back/box_x.jpg';
                break;
            }
            $print = str_replace("[imgurlmar]",$boxmar,$print);
            $print = str_replace("[imgurlsin]",$boxsin,$print);
            $print = str_replace("[imgurlwid]",$boxwid,$print);
            $print = str_replace("[imgurlsep]",$boxsep,$print);
            //pds number
            $pds->id == "" ? $pdsid = '______' : $pdsid = $pds->id;
            $print = str_replace("[pdsid]",$pdsid,$print);
            //pds id            
            $patient->id == "" ? $patid = '______' : $patid = $patient->id;
            $print = str_replace("[patid]",$patid,$print);
            $print = str_replace("[company]",$patient->company,$print);
            //patient image
            $picture = Yii::app()->request->baseUrl.'/'.$patient->filename;
            $print = str_replace("[filename]",$picture,$print);  
            echo $print;
            exit;
        }
        
        public function actionPrintForm2()
        {
            $pds = Pds::model()->findByPk($_GET['id']);
            $patient = $pds->patient;        
            $print = implode("", file(Yii::app()->getBasePath().'\views\pds\include\pds_form2.html'));
            //$print = implode("", file(Yii::app()->getBasePath().'\views\pds\include\pds.html'));
            $imgurl = Yii::app()->request->baseUrl.'/images/pds_front';
            $print = str_replace("[imgurl]",$imgurl,$print);
            $logo = Yii::app()->request->baseUrl.'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);
            $visit = date('F d, Y', strtotime($pds->datevisited));
            $print = str_replace("[datevisited]",$visit,$print);
            $print = str_replace("[visitreason]",$pds->visitreason,$print);
            $print = str_replace("[lastname]",$patient->lastname,$print);
            $print = str_replace("[firstname]",$patient->firstname,$print);
            $print = str_replace("[middleinitial]",$patient->middleinitial,$print);
            $bday = date('F d, Y', strtotime($patient->birthdate));
            $print = str_replace("[birthdate]",$bday,$print);
            //age
            $birthDate = date('m/d/Y', strtotime($patient->birthdate));
            //explode the date to get month, day and year
            $birthDate = explode("/", $birthDate);
            //get age from date or birthdate
            //$age = date("Y") - $birthDate[2];
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
            $print = str_replace("[age]",$age,$print);
            //normal empty box
            $empty_box = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            $print = str_replace("[empty_box]",$empty_box,$print);
            //sex
            if($patient->gender == 'M'){
                $boxm = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                $boxf = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            }else{ 
                $boxf = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                $boxm = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            }
            $print = str_replace("[imgurlm]",$boxm,$print);
            $print = str_replace("[imgurlf]",$boxf,$print);
            //civil status
            $boxsin = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            $boxmar = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            $boxwid = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            $boxsep = Yii::app()->request->baseUrl.'/images/pds_front/box.jpg';
            switch(trim($patient->civilstatus)){
                case 'Married':
                    $boxmar = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                break;
                case 'Single':
                    $boxsin = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                break;
                case 'Widow':
                    $boxwid= Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                break;
                case 'Separated':
                    $boxsep = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                break;
                default:
                    $boxsin = Yii::app()->request->baseUrl.'/images/pds_front/box_x.jpg';
                break;
            }
            $print = str_replace("[imgurlmar]",$boxmar,$print);
            $print = str_replace("[imgurlsin]",$boxsin,$print);
            $print = str_replace("[imgurlwid]",$boxwid,$print);
            $print = str_replace("[imgurlsep]",$boxsep,$print);
            //pds number
            $pds->id == "" ? $pdsid = '______' : $pdsid = $pds->id;
            $print = str_replace("[pdsid]",$pdsid,$print);
            //pds id            
            $patient->id == "" ? $patid = '______' : $patid = $patient->id;
            $print = str_replace("[patid]",$patid,$print);
            //patient image
            $picture = Yii::app()->request->baseUrl.'/'.$patient->filename;
            $print = str_replace("[filename]",$picture,$print);
			
            //address
            $add = '';
            (trim($patient->street1) != '') ? $add .= trim($patient->street1).', ' : $add.='' ;
            (trim($patient->street2) != '') ? $add .= trim($patient->street2).', ' : $add.='' ;
            (trim($patient->barangay) != '') ? $add .= trim($patient->barangay).', ' : $add.='' ;
            (trim($patient->city) != '') ? $add .= trim($patient->city).', ' : $add.='' ;
            (trim($patient->province) != '') ? $add .= trim($patient->province) : $add.='' ;
            $print = str_replace("[patient_address]",$add,$print);
            
            //other informations
            $print = str_replace("[company]",$patient->company,$print);
            $print = str_replace("[occupation]",$patient->occupation,$print);
            $print = str_replace("[spousename]",$patient->spousename,$print);
            $print = str_replace("[spouseoccupation]",$patient->spouseoccupation,$print);
            $print = str_replace("[emergencycontactname]",$patient->emergencycontactname,$print);
            $print = str_replace("[emergencycontactrelation]",$patient->emergencycontactrelation,$print);
            $print = str_replace("[emergencycontactaddress]",$patient->emergencycontactaddress,$print);
            $print = str_replace("[emergencycontactnos]",$patient->emergencycontactnos,$print);
			
			$contact_no='';$mob='';$tel='';
            (trim($patient->mobile_no) != '') ? $contact_no .= trim($patient->mobile_no) : $contact_no.='' ;
            (trim($patient->tel_no) != '') ? $tel = trim($patient->tel_no) : $tel = '' ;
            (trim($patient->mobile_no) != '') ? $contact_no .= ' / '.$tel : $contact_no .= $tel ;
            $print = str_replace("[patient_contact]",$contact_no,$print);
            
            echo $print;
            exit;
        }
        
        public function actionPrintFollowUp()
        {
            $pds = Pds::model()->findByPk($_GET['id']);
            $patient = $pds->patient;        
            $print = implode("", file(Yii::app()->getBasePath().'\views\pds\include\pds_followup.html'));
            //$print = implode("", file(Yii::app()->getBasePath().'\views\pds\include\pds.html'));
            $imgurl = Yii::app()->request->baseUrl.'/images/pds_followup';
            $print = str_replace("[imgurl]",$imgurl,$print);
            $logo = Yii::app()->request->baseUrl.'/images/printdiagresult/wpprintlogo.png';
            $print = str_replace("[logopath]",$logo,$print);
            $visit = date('F d, Y', strtotime($pds->datevisited));
            $print = str_replace("[datevisited]",$visit,$print);
            $print = str_replace("[visitreason]",$pds->visitreason,$print);
            $print = str_replace("[lastname]",$patient->lastname,$print);
            $print = str_replace("[firstname]",$patient->firstname,$print);
            $print = str_replace("[middleinitial]",$patient->middleinitial,$print);
            $bday = date('F d, Y', strtotime($patient->birthdate));
            $print = str_replace("[birthdate]",$bday,$print);
            //age
            $birthDate = date('m/d/Y', strtotime($patient->birthdate));
            //explode the date to get month, day and year
            $birthDate = explode("/", $birthDate);
            //get age from date or birthdate
            //$age = date("Y") - $birthDate[2];
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
            $print = str_replace("[age]",$age,$print);
            //normal empty box
            $empty_box = Yii::app()->request->baseUrl.'/images/pds_followup/box.jpg';
            $print = str_replace("[empty_box]",$empty_box,$print);
            //sex
            if($patient->gender == 'M'){
                $boxm = Yii::app()->request->baseUrl.'/images/pds_followup/box_x.jpg';
                $boxf = Yii::app()->request->baseUrl.'/images/pds_followup/box.jpg';
            }else{ 
                $boxf = Yii::app()->request->baseUrl.'/images/pds_followup/box_x.jpg';
                $boxm = Yii::app()->request->baseUrl.'/images/pds_followup/box.jpg';
            }
            $print = str_replace("[imgurlm]",$boxm,$print);
            $print = str_replace("[imgurlf]",$boxf,$print);
            //civil status
            $boxsin = Yii::app()->request->baseUrl.'/images/pds_followup/box.jpg';
            $boxmar = Yii::app()->request->baseUrl.'/images/pds_followup/box.jpg';
            $boxwid = Yii::app()->request->baseUrl.'/images/pds_followup/box.jpg';
            $boxsep = Yii::app()->request->baseUrl.'/images/pds_followup/box.jpg';
            switch(trim($patient->civilstatus)){
                case 'Married':
                    $boxmar = Yii::app()->request->baseUrl.'/images/pds_followup/box_x.jpg';
                break;
                case 'Single':
                    $boxsin = Yii::app()->request->baseUrl.'/images/pds_followup/box_x.jpg';
                break;
                case 'Widow':
                    $boxwid= Yii::app()->request->baseUrl.'/images/pds_followup/box_x.jpg';
                break;
                case 'Separated':
                    $boxsep = Yii::app()->request->baseUrl.'/images/pds_followup/box_x.jpg';
                break;
                default:
                    $boxsin = Yii::app()->request->baseUrl.'/images/pds_followup/box_x.jpg';
                break;
            }
            $print = str_replace("[imgurlmar]",$boxmar,$print);
            $print = str_replace("[imgurlsin]",$boxsin,$print);
            $print = str_replace("[imgurlwid]",$boxwid,$print);
            $print = str_replace("[imgurlsep]",$boxsep,$print);
            //pds number
            $pds->id == "" ? $pdsid = '______' : $pdsid = $pds->id;
            $print = str_replace("[pdsid]",$pdsid,$print);
            //pds id            
            $patient->id == "" ? $patid = '______' : $patid = $patient->id;
            $print = str_replace("[patid]",$patid,$print);
            //patient image
            $picture = Yii::app()->request->baseUrl.'/'.$patient->filename;
            $print = str_replace("[filename]",$picture,$print);
			
			$contact_no='';$mob='';$tel='';
            (trim($patient->mobile_no) != '') ? $contact_no .= trim($patient->mobile_no) : $contact_no.='' ;
            (trim($patient->tel_no) != '') ? $tel = trim($patient->tel_no) : $tel = '' ;
            (trim($patient->mobile_no) != '') ? $contact_no .= ' / '.$tel : $contact_no .= $tel ;
            $print = str_replace("[patient_contact]",$contact_no,$print);
			
            //address
            $add1 = '';
            $add2 = '';
            (trim($patient->street1) != '') ? $add1 .= trim($patient->street1).', ' : $add1.='' ;
            (trim($patient->street2) != '') ? $add1 .= trim($patient->street2).', ' : $add1.='' ;
            (trim($patient->barangay) != '') ? $add1 .= trim($patient->barangay).', ' : $add1.='' ;
            (trim($patient->city) != '') ? $add2 .= trim($patient->city).', ' : $add2.='' ;
            (trim($patient->province) != '') ? $add2 .= trim($patient->province) : $add2.='' ;
            $print = str_replace("[patient_address1]",$add1,$print);
            $print = str_replace("[patient_address2]",$add2,$print);
            
            //other informations
            $print = str_replace("[company]",$patient->company,$print);
            $print = str_replace("[occupation]",$patient->occupation,$print);
            $print = str_replace("[spousename]",$patient->spousename,$print);
            $print = str_replace("[spouseoccupation]",$patient->spouseoccupation,$print);
            $print = str_replace("[emergencycontactname]",$patient->emergencycontactname,$print);
            $print = str_replace("[emergencycontactrelation]",$patient->emergencycontactrelation,$print);
            $print = str_replace("[emergencycontactaddress]",$patient->emergencycontactaddress,$print);
            $print = str_replace("[emergencycontactnos]",$patient->emergencycontactnos,$print);
            
            echo $print;
            exit;
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Pds::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pds-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
