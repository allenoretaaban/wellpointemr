<?php

class FormFecalysisController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionPrint(){
        $resultid = $_GET["resultid"];
        $model=DiagFecalysis::model()->findByPk((int)$resultid); 
         $url = Yii::app()->getBasePath() ;
         
        $print = implode("", file(Yii::app()->getBasePath().'\modules\PrintDiagResult\includes\PrintFormFecalysis.html'));
        $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logopath]",$logo,$print);
        $print = str_replace("[name]",strtoupper($model->name),$print);  
        $print = str_replace("[age]",strtoupper($model->age),$print);  
        $print = str_replace("[sex]",strtoupper($model->sex),$print); 
        $print = str_replace("[requestingphysician]",strtoupper($model->requestingphysician),$print); 
        $print = str_replace("[spno]",strtoupper($model->spno),$print);  
        
        $print = str_replace("[color]",strtoupper($model->color),$print); 
        $print = str_replace("[consistency]",strtoupper($model->consistency),$print); 
        $print = str_replace("[mucus]",strtoupper($model->mucus),$print); 
        $print = str_replace("[undigestedfood]",strtoupper($model->undigestedfood),$print); 
        $print = str_replace("[wbc]",strtoupper($model->wbc),$print); 
        $print = str_replace("[rbc]",strtoupper($model->rbc),$print); 
        $print = str_replace("[fatglobules]",strtoupper($model->fatglobules),$print); 
        $print = str_replace("[yeastcells]",strtoupper($model->yeastcells),$print); 
        $print = str_replace("[bacteria]",strtoupper($model->bacteria),$print); 
        $print = str_replace("[parasites]",strtoupper($model->parasites),$print);
        $print = str_replace("[amoeba]",strtoupper($model->amoeba),$print);
        $print = str_replace("[occultblood]",strtoupper($model->occultblood),$print);
        $print = str_replace("[others]",strtoupper($model->others),$print);
        
        $model->datereceived == '0000-00-00' ? $datereceived = "" : $datereceived = date('m/d/Y',strtotime($model->datereceived));
        $print = str_replace("[datereceived]",$datereceived,$print); 
        $model->datereleased == '0000-00-00' ? $datereleased = "" : $datereleased = date('m/d/Y',strtotime($model->datereleased));
        $print = str_replace("[datereleased]",$datereleased,$print);
        
        $print = str_replace("[medtech]",strtoupper($model->medicaltechnologist),$print); 
        $print = str_replace("[licenseno]",strtoupper($model->licenseno),$print); 
        $print = str_replace("[pathologist]",strtoupper($model->pathologist),$print);  
        $print = str_replace("[patientid]",$model->patient_id,$print);   
        
        
        
        echo $print;
        exit;
    }
}