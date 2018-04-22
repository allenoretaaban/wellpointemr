<?php

class FormHematologyController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionPrint(){
        $resultid = $_GET["resultid"];
        $model=DiagHematology::model()->findByPk((int)$resultid); 
         $url = Yii::app()->getBasePath() ;
         
        $print = implode("", file(Yii::app()->getBasePath().'\modules\PrintDiagResult\includes\PrintFormHematology.html'));
        $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logopath]",$logo,$print);
        $print = str_replace("[name]",strtoupper($model->name),$print);  
        $print = str_replace("[age]",strtoupper($model->age),$print);  
        $print = str_replace("[sex]",strtoupper($model->sex),$print); 
        $print = str_replace("[requestingphysician]",strtoupper($model->requestingphysician),$print); 
        $print = str_replace("[spno]",strtoupper($model->spno),$print);  
        
        $print = str_replace("[rbc]",strtoupper($model->rbc),$print);  
        $print = str_replace("[hemoglobin]",strtoupper($model->hemoglobin),$print); 
        $print = str_replace("[hematocrit]",strtoupper($model->hematocrit),$print);
        $print = str_replace("[wbc]",strtoupper($model->wbc),$print);
        $print = str_replace("[segmenters]",strtoupper($model->segmenters),$print);
        $print = str_replace("[lymphocytes]",strtoupper($model->lymphocytes),$print);
        $print = str_replace("[monocytes]",strtoupper($model->monocytes),$print);
        $print = str_replace("[eosinophils]",strtoupper($model->eosinophils),$print);
        $print = str_replace("[stabband]",strtoupper($model->stabband),$print);
        $print = str_replace("[basophil]",strtoupper($model->basophil),$print);
        $print = str_replace("[plateletcount]",strtoupper($model->plateletcount),$print);
        
        $print = str_replace("[bloodtype]",strtoupper($model->bloodtype),$print);
        $print = str_replace("[rhtype]",strtoupper($model->rhtype),$print);
        $print = str_replace("[esr]",strtoupper($model->esr),$print);
        $print = str_replace("[bleedingtime]",strtoupper($model->bleedingtime),$print);
        $print = str_replace("[clottingtime]",strtoupper($model->clottingtime),$print);
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