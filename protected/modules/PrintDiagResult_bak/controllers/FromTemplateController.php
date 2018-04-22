<?php

class FromTemplateController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionPrint(){
        $resultid = $_GET["resultid"];
        $model = DiagTempsResults::model()->findByPk((int)$resultid); 
        $temp_model = DiagTemps::model()->findByPk((int)$model->diagtempid);
         $url = Yii::app()->getBasePath() ;
         
        $print = implode("", file(Yii::app()->getBasePath().'\modules\PrintDiagResult\includes\PrintForm.html'));
        $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logopath]",$logo,$print);
        $print = str_replace("[patientid]",$model->patient_id,$print);  
        $print = str_replace("[patientname]",strtoupper($model->patient_name),$print);  
        $print = str_replace("[age]",strtoupper($model->age),$print);  
        $print = str_replace("[gender]",strtoupper($model->gender),$print);  
        $print = str_replace("[diagtemptitle]",strtoupper($temp_model->result_title),$print);  
        $print = str_replace("[result_content]",$model->result_content,$print);  
        $print = str_replace("[resultno]",$model->resultno,$print);  
        
        
        
        echo $print;
        exit;
    }
}