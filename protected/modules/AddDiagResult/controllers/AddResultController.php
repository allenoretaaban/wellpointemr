<?php

class AddresultController extends Controller
{
	public function actionIndex()
	{
        if (intval($_POST['tempid']) <= 0){
            session_start();
            $_SESSION["errmsg"][] = "Please select a diagnostic result template first";
             $url = $_SERVER["HTTP_HOST"].Yii::app()->getHomeUrl() ;
             $this->redirect('http://'.$url.'/AddDiagResult');
        }
		$this->render('selectpatetient');
	}       
    
    public function actionLoadTemplate(){
        $this->render('loadtemplate');
    } 
                       
    
    public function actionBloodChemAdd(){
        $this->render('selectpatient_bloodchem');
    }        
    
    public function actionSaveDiagResult(){
        $patientid = $_POST["patientid"];
        $patientname = $_POST["patientname"];
        $age = $_POST["age"];
        $gender = $_POST["gender"];
        $diagTempId = $_POST["diagTempId"];
        $diagTempTitle = $_POST["diagTempTitle"];
        $result_content = $_POST["DiagTemps"]["content_format"];

        $result = new DiagTempsResults();
        $result->patient_id = $patientid;
        $result->patient_name = $patientname;
        $result->age = $age;
        $result->gender = $gender;        
        $result->diagtempid = $diagTempId;
        $result->diagtemptitle = $diagTempTitle;
        $result->result_content = $result_content;
        $result->getNextResultNo();
        $result->status = 'active';
        $result->createdate = date('Y-m-d');
        $result->createby = Yii::app()->user->id;
        $res = $result->save();
        $recdid = $result->id;
        $url = $_SERVER["HTTP_HOST"].Yii::app()->getHomeUrl() ;
        $this->redirect('http://'.$url.'/diagTempsResults/'.$recdid);
           
        
    }
    
   
    
    
    
    
}