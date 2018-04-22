<?php

class FormUrinalysisController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionPrint(){
        $resultid = $_GET["resultid"];
        $model=DiagUrinalysis::model()->findByPk((int)$resultid); 
         $url = Yii::app()->getBasePath() ;
         
        $print = implode("", file(Yii::app()->getBasePath().'/modules/PrintDiagResult/includes/PrintFormUrinalysis.html'));
        $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logopath]",$logo,$print);
        $print = str_replace("[name]",strtoupper($model->name),$print);  
        $print = str_replace("[age]",strtoupper($model->age),$print);  
        $print = str_replace("[sex]",strtoupper($model->sex),$print); 
        $print = str_replace("[requesting_physician]",strtoupper($model->requesting_physician),$print); 
        $print = str_replace("[spno]",strtoupper($model->sp_no),$print); 
        $print = str_replace("[pccolor]",strtoupper($model->pc_color),$print); 
        $print = str_replace("[pctranparency]",strtoupper($model->pc_tranparency),$print); 
        $print = str_replace("[pcspecificgravity]",strtoupper($model->pc_specific_gravity),$print); 
        $print = str_replace("[ccph]",strtoupper($model->cc_ph),$print); 
        $print = str_replace("[ccsugar]",strtoupper($model->cc_sugar),$print); 
        $print = str_replace("[ccprotein]",strtoupper($model->cc_protein),$print); 
        $print = str_replace("[mpuscell]",strtoupper($model->m_puscell),$print); 
        $print = str_replace("[mrbc]",strtoupper($model->m_rbc),$print); 
        $print = str_replace("[mepitelialcells]",strtoupper($model->m_epitelial_cells),$print); 
        $print = str_replace("[mmucusthreads]",strtoupper($model->m_mucus_threads),$print); 
        $print = str_replace("[camorphurates]",strtoupper($model->c_amorph_urates),$print); 
        $print = str_replace("[camorphphosphates]",strtoupper($model->c_amorph_phosphates),$print); 
        $print = str_replace("[curicacid]",strtoupper($model->c_uric_acid),$print); 
        $print = str_replace("[ctriplephospate]",strtoupper($model->c_triple_phospate),$print); 
        $print = str_replace("[calciumoxalate]",strtoupper($model->c_calcium_oxalate),$print);
        $print = str_replace("[bacteria]",strtoupper($model->bacteria),$print); 
        $print = str_replace("[casts]",strtoupper($model->casts),$print); 
        $print = str_replace("[pregnancy]",strtoupper($model->pregnancy_test),$print); 
        $print = str_replace("[others]",strtoupper($model->others),$print); 
        
        $model->datereceived == '0000-00-00' ? $datereceived = "" : $datereceived = date('m/d/Y',strtotime($model->datereceived));
        $print = str_replace("[datereceived]",$datereceived,$print); 
        $model->datereleased == '0000-00-00' ? $datereleased = "" : $datereleased = date('m/d/Y',strtotime($model->datereleased));
        $print = str_replace("[datereleased]",$datereleased,$print);
        
        $print = str_replace("[medtech]",strtoupper($model->med_tech),$print); 
        $print = str_replace("[licenseno]",strtoupper($model->licenseno),$print); 
        $print = str_replace("[pathologist]",strtoupper($model->pathologist),$print); 
        $print = str_replace("[patlicenseno]","0076484",$print);  
        $print = str_replace("[patientid]",$model->patient_id,$print);   
        
        
        
        echo $print;
        exit;
    }
}