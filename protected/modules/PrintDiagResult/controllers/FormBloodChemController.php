<?php

class FormBloodChemController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionPrint(){
        $resultid = $_GET["resultid"];
        $model=DiagResBloodchem::model()->findByPk((int)$resultid); 
         $url = Yii::app()->getBasePath() ;
         
        $print = implode("", file(Yii::app()->getBasePath().'/modules/PrintDiagResult/includes/PrintFormBloodChem.html'));
        $logo = '/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logopath]",$logo,$print);
        $print = str_replace("[name]",strtoupper($model->patient_name),$print);  
        $print = str_replace("[age]",strtoupper($model->age),$print);  
        $print = str_replace("[sex]",strtoupper($model->gender),$print); 
        $print = str_replace("[requesting_physician]",strtoupper($model->req_doctor),$print); 
        $print = str_replace("[spno]",strtoupper($model->sp_no),$print); 
        $print = str_replace("[id]",$model->id,$print); 
        
        $print = str_replace("[glucose]",strtoupper($model->glucose),$print); 
        $print = str_replace("[bun]",strtoupper($model->bun),$print); 
        $print = str_replace("[creatinine]",strtoupper($model->creatinine),$print); 
        $print = str_replace("[uric_acid]",strtoupper($model->uric_acid),$print); 
        $print = str_replace("[cholesterol]",strtoupper($model->cholesterol),$print); 
        $print = str_replace("[triglycerides]",strtoupper($model->triglycerides),$print); 
        $print = str_replace("[hdl_c]",strtoupper($model->hdl_c),$print); 
        $print = str_replace("[ldl_c]",strtoupper($model->ldl_c),$print); 
        $print = str_replace("[vldl_c]",strtoupper($model->vldl_c),$print); 
        $print = str_replace("[sgot_ast]",strtoupper($model->sgot_ast),$print); 
        $print = str_replace("[sgpt_alt]",strtoupper($model->sgpt_alt),$print); 
        $print = str_replace("[hba1c]",strtoupper($model->hba1c),$print); 
        $print = str_replace("[total_bilirubin]",strtoupper($model->total_bilirubin),$print); 
        $print = str_replace("[direct_bilirubin]",strtoupper($model->direct_bilirubin),$print); 
        $print = str_replace("[indirect_bilirubin]",strtoupper($model->indirect_bilirubin),$print); 
        $print = str_replace("[sodium]",strtoupper($model->sodium),$print); 
        $print = str_replace("[potassium]",strtoupper($model->potassium),$print); 
        $print = str_replace("[chloride]",strtoupper($model->chloride),$print); 
        $print = str_replace("[calcium]",strtoupper($model->calcium),$print); 
        //$print = str_replace("[total_protein]",strtoupper($model->total_protein),$print); 
        $print = str_replace("[alkaline_phosphatase]",strtoupper($model->alkaline_phosphatase),$print); 
        $print = str_replace("[other]",$model->other,$print); 
        $print = str_replace("[total_pro]",$model->total_protein,$print); 

        $model->datereceived == '0000-00-00' ? $datereceived = "" : $datereceived = date('m/d/Y',strtotime($model->datereceived));
        $print = str_replace("[datereceived]",$datereceived,$print); 
        $model->datereleased == '0000-00-00' ? $datereleased = "" : $datereleased = date('m/d/Y',strtotime($model->datereleased));
        $print = str_replace("[datereleased]",$datereleased,$print);
        
        $print = str_replace("[medtech]",strtoupper($model->medtech),$print); 
        $print = str_replace("[licenseno]",strtoupper($model->medtech_license),$print);         
                                    
        $print = str_replace("[pathologist]",strtoupper($model->pathologist),$print); 
        $print = str_replace("[patlicenseno]","0076484",$print);  
        $print = str_replace("[patientid]",$model->patient_id,$print);   
        
        
        
        echo $print;
        exit;
    }
}