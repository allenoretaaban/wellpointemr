<?php

class ApeController extends RController
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
    public function actionUpdate_status($id)
    {
        $model=$this->loadModel($id);    
        $_GET;        
        if(isset($_POST['Ape']))
        {                                                             
            $model->status = 2;
            $model->date_completed = $_POST['Ape']['date_completed'];
            $model->remarks = $_POST['Ape']['remarks']; 
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }  
        $this->render('update_status',array(
            'model'=>$this->loadModel($id),
        ));                                                               
    }
          
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model=$this->loadModel($id);                                                                  
                       
        if(isset($_POST['mh1_submit']))
        {
            $ape_mh1= ApeMh1Pastdisease::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_mh1->attributes=$_POST['ApeMh1Pastdisease']; 
            $ape_mh1->ape_id = $model->id;
            $ape_mh1->user_id = Yii::app()->user->id;        
            $ape_mh1->username = Yii::app()->user->name;   
            $ape_mh1->update_datetime = date("Y-m-d H:i:s");   
            $ape_mh1->update();
            $this->saveApeLogs($model->id, $ape_mh1->id, "ape_mh1_pastdisease", "Updated", json_encode($_POST['ApeMh1Pastdisease']));   
            $ape_reports= ApeReports::model()->find(array("condition"=>"ape_id = $model->id"));  
            
            $past_history = "";
            if($ape_mh1->is_fhm){            
                $past_history = $past_history."Frequent Headache/Migraine, ";
            }
            if($ape_mh1->is_cd){
                $past_history = $past_history."Constipation/diarrhea, ";
            }
            if($ape_mh1->is_bt){
                $past_history = $past_history."Bleeding tendency, ";
            }
            if($ape_mh1->is_lc){
                $past_history = $past_history."Loss of Consciousness, ";
            }
            if($ape_mh1->is_ap){
                $past_history = $past_history."Abdominal pains, ";
            }
            if($ape_mh1->is_spcl){
                $past_history = $past_history."Skin problem/cysts/lumps, ";
            }
            if($ape_mh1->is_dbp){
                $past_history = $past_history."Dizziness/Balance Problem, ";
            }
            if($ape_mh1->is_gopd){
                $past_history = $past_history."Genital organ problems/discharges, ";
            }
            if($ape_mh1->is_etb){
                $past_history = $past_history."Exposure to tuberculosis, ";
            }    
            if($ape_mh1->is_wpnt){
                $past_history = $past_history."Weakness/paralysis/numbness/tremors, ";
            }    
            if($ape_mh1->is_a){
                $past_history = $past_history."Accidents, ";
            }
            if($ape_mh1->is_la){
                $past_history = $past_history."Loss of appetite, ";
            }   
            if($ape_mh1->is_bvep){
                $past_history = $past_history."Blurring of vision/Eye problem, ";
            }
            if($ape_mh1->is_etoaw){
                $past_history = $past_history."Easily tires on ordinary activity/walking, ";
            }
            if($ape_mh1->is_wlwg){
                $past_history = $past_history."Weight loss/weight gain, ";
            }
            if($ape_mh1->is_hdep){
                $past_history = $past_history."Hearing defect/Ear problem, ";
            }
            if($ape_mh1->is_cphp){
                $past_history = $past_history."Chest pain/heaviness/palpitations, ";
            }
            if($ape_mh1->is_sp){
                $past_history = $past_history."Sleeping problems, ";
            }
            if($ape_mh1->is_fstcs){
                $past_history = $past_history."Frequent sore throat/colds/sneezing, ";
            }
            if($ape_mh1->is_yes){
                $past_history = $past_history."Yellowing of eyes/skin, ";
            }
            if($ape_mh1->is_nd){
                $past_history = $past_history."Nervousness/depression, ";
            }
            if($ape_mh1->is_pcsb){
                $past_history = $past_history."Persistent cough/shortness of breath, ";
            }
            if($ape_mh1->is_hbbs){
                $past_history = $past_history."Hemorrhoids/bloody or black stool, ";
            }
            if($ape_mh1->is_hbbs){
                $past_history = $past_history."Hemorrhoids/bloody or black stool, ";
            }
            if($ape_mh1->is_fbpr){     
                $past_history = $past_history."Frequent blood pressure reading at 140/90 or higher, ";
            }
            if($ape_mh1->is_fsjs){     
                $past_history = $past_history."Feet swelling/joint swelling, ";
            }
            if($ape_mh1->is_up){     
                $past_history = $past_history."Urination problem, ";
            }
            if($ape_mh1->is_al){     
                $past_history = $past_history."Allergy: ".$ape_mh1->al.", ";
            }   
            if($ape_mh1->is_oc){     
                $past_history = $past_history."Others complaints: ".$ape_mh1->oc.", ";
            }   
            $ape_reports->past_history = $past_history;
            $ape_reports->update();
        }    
        if(isset($_POST['mh2_submit']))
        {
            $ape_mh2= ApeMh2Familyhistory::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_mh2->attributes=$_POST['ApeMh2Familyhistory']; 
            $ape_mh2->ape_id = $model->id;
            $ape_mh2->user_id = Yii::app()->user->id;        
            $ape_mh2->username = Yii::app()->user->name;   
            $ape_mh2->update_datetime = date("Y-m-d H:i:s");   
            if($ape_mh2->update());
            $this->saveApeLogs($model->id, $ape_mh2->id, "ape_mh2_familyhistory", "Updated", json_encode($_POST['ApeMh2Familyhistory']));
        }      
        if(isset($_POST['mh3_submit']))
        {
            $ape_mh3= ApeMh3Socialhistory::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_mh3->attributes=$_POST['ApeMh3Socialhistory']; 
            $ape_mh3->ape_id = $model->id;
            $ape_mh3->user_id = Yii::app()->user->id;        
            $ape_mh3->username = Yii::app()->user->name;   
            $ape_mh3->update_datetime = date("Y-m-d H:i:s");   
            if($ape_mh3->update());
            $this->saveApeLogs($model->id, $ape_mh3->id, "ape_mh3_socialhistory", "Updated", json_encode($_POST['ApeMh3Socialhistory']));
        }   
        if(isset($_POST['mh4_submit']))
        {
            $ape_mh4= ApeMh4Medicationhistory::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_mh4->attributes=$_POST['ApeMh4Medicationhistory']; 
            $ape_mh4->ape_id = $model->id;
            $ape_mh4->user_id = Yii::app()->user->id;        
            $ape_mh4->username = Yii::app()->user->name;   
            $ape_mh4->update_datetime = date("Y-m-d H:i:s");   
            if($ape_mh4->update());
            $this->saveApeLogs($model->id, $ape_mh4->id, "ape_mh4_medicationhistory", "Updated", json_encode($_POST['ApeMh4Medicationhistory']));
        }     
        if(isset($_POST['mh5_submit']))
        {
            $ape_mh5= ApeMh5Obgynehistory::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_mh5->attributes=$_POST['ApeMh5Obgynehistory']; 
            $ape_mh5->ape_id = $model->id;
            $ape_mh5->user_id = Yii::app()->user->id;        
            $ape_mh5->username = Yii::app()->user->name;   
            $ape_mh5->update_datetime = date("Y-m-d H:i:s");   
            if($ape_mh5->update());
            $this->saveApeLogs($model->id, $ape_mh5->id, "ape_mh5_obgynehistory", "Updated", json_encode($_POST['ApeMh5Obgynehistory']));
        }    
        if(isset($_POST['pe1_submit']))
        {
            $ape_pe1= ApePe1Bodymassindex::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_pe1->attributes=$_POST['ApePe1Bodymassindex']; 
            $ape_pe1->ape_id = $model->id;
            $ape_pe1->user_id = Yii::app()->user->id;        
            $ape_pe1->username = Yii::app()->user->name;   
            $ape_pe1->update_datetime = date("Y-m-d H:i:s");   
            if($ape_pe1->update());
            $this->saveApeLogs($model->id, $ape_pe1->id, "ape_pe1_bodymassindex", "Updated", json_encode($_POST['ApePe1Bodymassindex']));
            $ape_reports= ApeReports::model()->find(array("condition"=>"ape_id = $model->id"));  
            $ape_reports->ht = $ape_pe1->height_ft." ft. ". $ape_pe1->height_in ." in. (".$ape_pe1->height_cm." cm)";
            $ape_reports->wt = $ape_pe1->weight_lbs." lbs. (".$ape_pe1->weight_kg." kg)";
            $ape_reports->bmi = $ape_pe1->bmi;                               
            $ape_reports->body_built = $ape_pe1->body_built;    
            $ape_reports->update();
            $this->UpdatePhysicalExam($model->id);
        } 
        if(isset($_POST['pe2_submit']))
        {
            $ape_pe2= ApePe2Bloodpressure::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_pe2->attributes=$_POST['ApePe2Bloodpressure']; 
            $ape_pe2->ape_id = $model->id;
            $ape_pe2->user_id = Yii::app()->user->id;        
            $ape_pe2->username = Yii::app()->user->name;   
            $ape_pe2->update_datetime = date("Y-m-d H:i:s");   
            if($ape_pe2->update());
            $this->saveApeLogs($model->id, $ape_pe2->id, "ape_pe2_bloodpressure", "Updated", json_encode($_POST['ApePe2Bloodpressure']));
            $ape_reports= ApeReports::model()->find(array("condition"=>"ape_id = $model->id"));  
            $ape_reports->bp = " (Seated/rested: ".$ape_pe2->is_q1.", Repeat BP: ".$ape_pe2->repeat_bp.", PR: ".$ape_pe2->pr.", RR: ".$ape_pe2->rr.", T: ". $ape_pe2->t ." )";
            $ape_reports->update();
            $this->UpdatePhysicalExam($model->id);
        }   
        if(isset($_POST['pe3_submit']))
        {                                                                                            
            $ape_pe3= ApePe3Visualacuity::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_pe3->attributes=$_POST['ApePe3Visualacuity']; 
            $ape_pe3->ape_id = $model->id;
            $ape_pe3->user_id = Yii::app()->user->id;        
            $ape_pe3->username = Yii::app()->user->name;   
            $ape_pe3->update_datetime = date("Y-m-d H:i:s");   
            if($ape_pe3->update());
            $this->saveApeLogs($model->id, $ape_pe3->id, "ape_pe3_visualacuity", "Updated", json_encode($_POST['ApePe3Visualacuity']));
            $ape_reports= ApeReports::model()->find(array("condition"=>"ape_id = $model->id"));  
            $corrected = "";
            $others = "";
            $color_blind = "";
            if($ape_pe3->is_abnormal){ 
                $color_blind = ", Color Blind Test: Abnormal";
            }else if($ape_pe3->is_normal){
                $color_blind = ", Color Blind Test: Normal";
            }
            if($ape_pe3->is_uncorrected){            
                $corrected = "Uncorrected ";
                $others = "(OD: 20/".$ape_pe3->farvision_1_od20.", OS: 20/".$ape_pe3->farvision_1_os20.", ODJ".$ape_pe3->nearvision_1_odj.", OSJ".$ape_pe3->nearvision_1_osj.$color_blind.")";
            }else if($ape_pe3->is_corrected){
                $corrected = "Corrected ";
                $glasses = "";
                if($ape_pe3->is_glasses){
                    $glasses ="Glasses : Yes";    
                }else if($ape_pe3->is_contactlens){  
                    $glasses ="Contact Lens : Yes";  
                }
                $others = "(".$glasses.", OD: 20/".$ape_pe3->farvision_2_od20.", OS: 20/".$ape_pe3->farvision_2_os20.", ODJ".$ape_pe3->nearvision_2_odj.", OSJ".$ape_pe3->nearvision_2_osj.$color_blind.")";
            }                          
            $visual_acuity =$corrected.$others;
            $ape_reports->visual_acuity = $visual_acuity;
            $ape_reports->update();
            $this->UpdatePhysicalExam($model->id);
        }   
        if(isset($_POST['pe4_submit']))
        {
            $ape_pe4= ApePe4Findings::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_pe4->attributes=$_POST['ApePe4Findings']; 
            $ape_pe4->ape_id = $model->id;
            $ape_pe4->user_id = Yii::app()->user->id;        
            $ape_pe4->username = Yii::app()->user->name;   
            $ape_pe4->update_datetime = date("Y-m-d H:i:s");   
            if($ape_pe4->update());
            $this->saveApeLogs($model->id, $ape_pe4->id, "ape_pe4_findings", "Updated", json_encode($_POST['ApePe4Findings']));
            $ape_reports= ApeReports::model()->find(array("condition"=>"ape_id = $model->id"));
            $ape_reports->update();
            $this->UpdatePhysicalExam($model->id);
        }  
        if(isset($_POST['diag_submit']))
        {
            $ape_diag= ApeDiagnostic::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_diag->attributes=$_POST['ApeDiagnostic']; 
            $ape_diag->ape_id = $model->id;
            $ape_diag->user_id = Yii::app()->user->id;        
            $ape_diag->username = Yii::app()->user->name;   
            $ape_diag->update_datetime = date("Y-m-d H:i:s");   
            if($ape_diag->update());
            $this->saveApeLogs($model->id, $ape_diag->id, "ape_diagnostic", "Updated", json_encode($_POST['ApeDiagnostic']));
            $ape_reports= ApeReports::model()->find(array("condition"=>"ape_id = $model->id"));  
            $cxr = "";
            if($ape_diag->cx_n){            
                $cxr = "Normal";
            }else if($ape_diag->cx_cif){
                $cxr = "Clinically Insignificant Findings";
            }else if($ape_diag->cx_ab){
                $cxr = "Abnormal";
            }                                    
            $ape_reports->cxr = $cxr;       
            $cbc = "";
            if($ape_diag->cbc_n){            
                $cbc = "Normal";
            }else if($ape_diag->cbc_cif){
                $cbc = "Clinically Insignificant Findings";
            }else if($ape_diag->cbc_ab){
                $cbc = "Abnormal";
            }                                    
            $ape_reports->cbc = $cbc;
            $fecalysis = "";
            if($ape_diag->se_n){            
                $fecalysis = "Normal";
            }else if($ape_diag->se_cif){
                $fecalysis = "Clinically Insignificant Findings";
            }else if($ape_diag->se_ab){
                $fecalysis = "Abnormal";
            }                                    
            $ape_reports->fecalysis = $fecalysis;     
            $urinalysis = "";
            if($ape_diag->u_n){            
                $urinalysis = "Normal";
            }else if($ape_diag->u_cif){
                $urinalysis = "Clinically Insignificant Findings";
            }else if($ape_diag->u_ab){
                $urinalysis = "Abnormal";
            }                                    
            $ape_reports->urinalysis = $urinalysis;     
            $drugtest = "";
            if($ape_diag->dt_p){            
                $drugtest = "Positive";
            }else if($ape_diag->dt_n){
                $drugtest = "Negative";
            } 
            $drugtest = implode(", ",array(($ape_diag->dt_marijuana)?"Marijuana":"", ($ape_diag->dt_shabu)?"Shabu":""))." : ". $drugtest ;                                
            $ape_reports->drugtest = $drugtest;         
            $ecg = "";
            if($ape_diag->lecg_n){            
                $ecg = "Normal";
            }else if($ape_diag->lecg_cif){
                $ecg = "Clinically Insignificant Findings";
            }else if($ape_diag->lecg_ab){
                $ecg = "Abnormal";
            }                                    
            $ape_reports->ecg = $ecg;           
            $papsmear = "";
            if($ape_diag->papsmear_n){            
                $papsmear = "Normal";
            }else if($ape_diag->papsmear_cif){
                $papsmear = "Clinically Insignificant Findings";
            }else if($ape_diag->papsmear_ab){
                $papsmear = "Abnormal";
            }                                    
            $ape_reports->papsmear = $papsmear; 
            $audiometry = "";
            if($ape_diag->am_n){            
                $audiometry = "Normal";
            }else if($ape_diag->am_cif){
                $audiometry = "Clinically Insignificant Findings";
            }else if($ape_diag->am_ab){
                $audiometry = "Abnormal";
            }                                    
            $ape_reports->audiometry = $audiometry;
            $ape_reports->update();
        }      
        if(isset($_POST['rec_submit']))
        {
            $ape_rec= ApeRecommendation::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_rec->attributes=$_POST['ApeRecommendation']; 
            $ape_rec->ape_id = $model->id;
            $ape_rec->user_id = Yii::app()->user->id;        
            $ape_rec->username = Yii::app()->user->name;   
            $ape_rec->update_datetime = date("Y-m-d H:i:s");   
            if($ape_rec->update());
            $this->saveApeLogs($model->id, $ape_rec->id, "ape_recommendation", "Updated", json_encode($_POST['ApeRecommendation']));
            $ape_reports= ApeReports::model()->find(array("condition"=>"ape_id = $model->id"));  
            $ape_reports->recommendations=implode(",",$_POST['ApeRecommendation']); 
            $ape_reports->update();
        }
        if(isset($_POST['others_submit']))
        {
            $ape_others= ApeOthers::model()->find(array("condition"=>"ape_id = $model->id"));   
            $ape_others->attributes=$_POST['ApeOthers']; 
            $ape_others->ape_id = $model->id;
            $ape_others->user_id = Yii::app()->user->id;        
            $ape_others->username = Yii::app()->user->name;   
            $ape_others->update_datetime = date("Y-m-d H:i:s");   
            if($ape_others->update());
            $this->saveApeLogs($model->id, $ape_others->id, "ape_others", "Updated", json_encode($_POST['ApeOthers']));
            $ape_reports= ApeReports::model()->find(array("condition"=>"ape_id = $model->id"));  
            $ape_reports->attributes=$_POST['ApeOthers']; 
            $ape_reports->update();
             
        }
        
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }          
    
    private function UpdatePhysicalExam($ape_id){   
            $array = array();     
        //BodyMassIndex
            $BodyMassIndex = "";              
            $ape_pe1= ApePe1Bodymassindex::model()->find(array("condition"=>"ape_id = $ape_id")); 
            $BodyMassIndexEmpty = true; 
            $BodyMassIndex = "BodyMassIndex(";
            if($ape_pe1->height_ft != ""){
                $BodyMassIndex .= "HeightInFeet:".$ape_pe1->height_ft."|";
                $BodyMassIndexEmpty = false;
            }   
            if($ape_pe1->height_in != ""){
                $BodyMassIndex .= "HeightInInch:".$ape_pe1->height_in."|";
                $BodyMassIndexEmpty = false;
            }                
            if($ape_pe1->height_cm != ""){
                $BodyMassIndex .= "HeightInCM:".$ape_pe1->height_cm."|";
                $BodyMassIndexEmpty = false;
            }    
            if($ape_pe1->weight_lbs != ""){
                $BodyMassIndex .= "WeightInLBS:".$ape_pe1->weight_lbs."|";
                $BodyMassIndexEmpty = false;
            }    
            if($ape_pe1->weight_kg != ""){
                $BodyMassIndex .= "WeightInKG:".$ape_pe1->weight_kg."|";
                $BodyMassIndexEmpty = false;
            }    
            if($ape_pe1->body_built != ""){
                $BodyMassIndex .= "BodyBuilt:".$ape_pe1->body_built."|";
                $BodyMassIndexEmpty = false;
            }    
            if($ape_pe1->bmi != ""){
                $BodyMassIndex .= "BMI:".$ape_pe1->bmi."|";
                $BodyMassIndexEmpty = false;
            }                
            if($ape_pe1->bmi_uw){                                                                
                $BodyMassIndex .= "BMIClassification:Underweight|";
                $BodyMassIndexEmpty = false;
            }else if($ape_pe1->bmi_n){                                                           
                $BodyMassIndex .= "BMIClassification:Normal|";
                $BodyMassIndexEmpty = false;
            }else if($ape_pe1->bmi_ow){                                                          
                $BodyMassIndex .= "BMIClassification:Overweight|";
                $BodyMassIndexEmpty = false;
            }else if($ape_pe1->bmi_oc1){                                                          
                $BodyMassIndex .= "BMIClassification:ObeseClass1|";
                $BodyMassIndexEmpty = false;
            }else if($ape_pe1->bmi_oc2){                                                         
                $BodyMassIndex .= "BMIClassification:ObeseClass2|";
                $BodyMassIndexEmpty = false;
            }
            $BodyMassIndex .=")"; 
            if($BodyMassIndexEmpty){
                 $BodyMassIndex = "";
            }else{
                 $array[] = $BodyMassIndex;
            }                                                                                 
        //BloodPressure
            $BloodPressureEmpty = true;
            $BloodPressure .= "BloodPressure(";
            $ape_pe2= ApePe2Bloodpressure::model()->find(array("condition"=>"ape_id = $ape_id"));     
            if($ape_pe2->is_q1 != ""){
                $BloodPressure .= "Seated/Rested:".$ape_pe2->is_q1."|";
                $BloodPressureEmpty = false;
            }         
            if($ape_pe2->repeat_bp != ""){
                $BloodPressure .= "RepeatBP:".$ape_pe2->repeat_bp."|";
                $BloodPressureEmpty = false;
            }       
            if($ape_pe2->pr != ""){
                $BloodPressure .= "PR:".$ape_pe2->pr."|";
                $BloodPressureEmpty = false;
            }       
            if($ape_pe2->rr != ""){
                $BloodPressure .= "RR:".$ape_pe2->rr."|";
                $BloodPressureEmpty = false;
            }       
            if($ape_pe2->t != ""){
                $BloodPressure .= "T:".$ape_pe2->t."|";
                $BloodPressureEmpty = false;
            }        
            $BloodPressure .=")|";  
            if($BloodPressureEmpty){ 
                $BloodPressure = "";
            }else{
                 $array[] = $BloodPressure;
            }        
        //VisualAcuity  
            $VisualAcuityEmpty = true;  
            $VisualAcuity .= "VisualAcuity(";                                                                  
            $ape_pe3= ApePe3Visualacuity::model()->find(array("condition"=>"ape_id = $ape_id"));    
            if($ape_pe3->is_uncorrected){   
                $VisualAcuity .= "Uncorrected:true|";      
                $VisualAcuityEmpty = false;  
                if($ape_pe3->farvision_1_od20 != ""){
                    $VisualAcuity .= "FarVisionOD20:".$ape_pe3->farvision_1_od20."|";   
                }       
                if($ape_pe3->farvision_1_os20 != ""){
                    $VisualAcuity .= "FarVisionOS20:".$ape_pe3->farvision_1_os20."|";
                }     
                if($ape_pe3->nearvision_1_odj != ""){
                    $VisualAcuity .= "NearVisionODJ:".$ape_pe3->nearvision_1_odj."|";
                }        
                if($ape_pe3->nearvision_1_osj != ""){
                    $VisualAcuity .= "NearVisionOSJ:".$ape_pe3->nearvision_1_osj."|";
                } 
            }    
            if($ape_pe3->is_corrected){   
                $VisualAcuity .= "Corrected:true|";       
                $VisualAcuityEmpty = false;      
                if($ape_pe3->farvision_2_od20 != ""){
                    $VisualAcuity .= "FarVisionOD20:".$ape_pe3->farvision_2_od20."|";
                }       
                if($ape_pe3->farvision_2_os20 != ""){
                    $VisualAcuity .= "FarVisionOS20:".$ape_pe3->farvision_2_os20."|";
                }     
                if($ape_pe3->nearvision_2_odj != ""){
                    $VisualAcuity .= "NearVisionODJ:".$ape_pe3->nearvision_2_odj."|";
                }        
                if($ape_pe3->nearvision_2_osj != ""){
                    $VisualAcuity .= "NearVisionOSJ:".$ape_pe3->nearvision_2_osj."|";
                }          
                if($ape_pe3->is_glasses){
                    $VisualAcuity .= "Glasses:true|";
                } 
                if($ape_pe3->is_contactlens){
                    $VisualAcuity .= "ContactLens:true|";
                } 
            }          
            if($ape_pe3->is_normal){                           
                $VisualAcuityEmpty = false;  
                $VisualAcuity .= "ColorBlindTest:Normal|";
            }
            if($ape_pe3->is_abnormal){                        
                $VisualAcuityEmpty = false;  
                $VisualAcuity .= "ColorBlindTest:Abnormal|";
            } 
                                 
            $VisualAcuity .=")";
            
            if($VisualAcuityEmpty){   
                $VisualAcuity = "";
            }else{
                 $array[] = $VisualAcuity;
            } 
        //Findings
            $ape_pe4= ApePe4Findings::model()->find(array("condition"=>"ape_id = $ape_id"));  
            $Findings .= "Findings(";
            $FindingsEmpty = true;         
                if($ape_pe4->is_ga=="/"){
                    $FindingsEmpty = false;      
                    $Findings .= "GeneralAppearance:Normal(".$ape_pe4->ga.")|";
                }else if($ape_pe4->is_ga=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "GeneralAppearance:Abnormal(".$ape_pe4->ga.")|";
                }          
                if($ape_pe4->is_eyes=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Eyes:Normal(".$ape_pe4->eyes.")|";
                }else if($ape_pe4->is_eyes=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Eyes:Abnormal(".$ape_pe4->eyes.")|";
                }         
                if($ape_pe4->is_ears=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Ears:Normal(".$ape_pe4->ears.")|";
                }else if($ape_pe4->is_ears=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Ears:Abnormal(".$ape_pe4->ears.")|";
                }        
                if($ape_pe4->is_nose=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Nose:Normal(".$ape_pe4->nose.")|";
                }else if($ape_pe4->is_nose=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Nose:Abnormal(".$ape_pe4->nose.")|";
                }         
                if($ape_pe4->is_throat=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Throat:Normal(".$ape_pe4->throat.")|";
                }else if($ape_pe4->is_throat=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Throat:Abnormal(".$ape_pe4->throat.")|";
                }        
                if($ape_pe4->is_mtg=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "MouthTeethGums:Normal(".$ape_pe4->mtg.")|";
                }else if($ape_pe4->is_mtg=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "MouthTeethGums:Abnormal(".$ape_pe4->mtg.")|";
                }         
                if($ape_pe4->is_dc=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "DentalCaries:Normal(".$ape_pe4->dc.")|";
                }else if($ape_pe4->is_dc=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "DentalCaries:Abnormal(".$ape_pe4->dc.")|";
                }           
                if($ape_pe4->is_dentures=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Dentures:Normal(".$ape_pe4->dentures.")|";
                }else if($ape_pe4->is_dentures=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Dentures:Abnormal(".$ape_pe4->dentures.")|";
                }            
                if($ape_pe4->is_neck=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Neck:Normal(".$ape_pe4->neck.")|";
                }else if($ape_pe4->is_neck=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Neck:Abnormal(".$ape_pe4->neck.")|";
                }             
                if($ape_pe4->is_heart=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Heart:Normal(".$ape_pe4->heart.")|";
                }else if($ape_pe4->is_heart=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Heart:Abnormal(".$ape_pe4->heart.")|";
                }            
                if($ape_pe4->is_cl=="/"){
                    $FindingsEmpty = false;    
                    $a .= "Chest/Lungs:Normal(".$ape_pe4->cl.")|";
                }else if($ape_pe4->is_cl=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Chest/Lungs:Abnormal(".$ape_pe4->cl.")|";
                }            
                if($ape_pe4->is_breasts=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Breasts:Normal(".$ape_pe4->breasts.")|";
                }else if($ape_pe4->is_breasts=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Breasts:Abnormal(".$ape_pe4->breasts.")|";
                }             
                if($ape_pe4->is_abdomen=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Abdomen:Normal(".$ape_pe4->abdomen.")|";
                }else if($ape_pe4->is_abdomen=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Abdomen:Abnormal(".$ape_pe4->abdomen.")|";
                }              
                if($ape_pe4->is_genital=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Genital:Normal(".$ape_pe4->genital.")|";
                }else if($ape_pe4->is_genital=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Genital:Abnormal(".$ape_pe4->genital.")|";
                }               
                if($ape_pe4->is_rectal=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Rectal:Normal(".$ape_pe4->rectal.")|";
                }else if($ape_pe4->is_rectal=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Rectal:Abnormal(".$ape_pe4->rectal.")|";
                }               
                if($ape_pe4->is_extr=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Extremities:Normal(".$ape_pe4->extr.")|";
                }else if($ape_pe4->is_extr=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Extremities:Abnormal(".$ape_pe4->extr.")|";
                }               
                if($ape_pe4->is_skin=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Skin:Normal(".$ape_pe4->skin.")|";
                }else if($ape_pe4->is_skin=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Skin:Abnormal(".$ape_pe4->skin.")|";
                }                  
                if($ape_pe4->is_neu=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Neurologic:Normal(".$ape_pe4->neu.")|";
                }else if($ape_pe4->is_neu=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Neurologic:Abnormal(".$ape_pe4->neu.")|";
                }                
                if($ape_pe4->is_deform=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Deformity:Normal(".$ape_pe4->deform.")|";
                }else if($ape_pe4->is_deform=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Deformity:Abnormal(".$ape_pe4->deform.")|";
                }                  
                if($ape_pe4->is_others=="/"){
                    $FindingsEmpty = false;    
                    $Findings .= "Others:Normal(".$ape_pe4->others.")|";
                }else if($ape_pe4->is_others=="X"){
                    $FindingsEmpty = false;    
                    $Findings .= "Others:Abnormal(".$ape_pe4->others.")|";
                }    
            $Findings .=")"; 
            if($FindingsEmpty){
                $Findings = "";
            }else{
                 $array[] = $Findings;
            } 
            $physical_exam = implode("|", $array);

            $ape_reports= ApeReports::model()->find(array("condition"=>"ape_id = $ape_id")); 
            $ape_reports->physical_exam = $physical_exam;
            $ape_reports->update();   
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Ape;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Ape']))
        {
            $model->attributes=$_POST['Ape'];
            if($model->save())
                $ape_report = new ApeReports;
                $ape_report->ape_id = $model->id;
                $ape_report->datevisited = $model->datevisited;
                $ape_report->hmo = $model->hmo;
                $ape_report->store = "SM Bacoor";
                $ape_report->patient_id = $model->patient_id;
                $ape_report->save();
                $this->redirect(array('view','id'=>$model->id));
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

        if(isset($_POST['Ape']))
        {
            $model->attributes=$_POST['Ape'];
            if($model->save()){
                ApeReports::model()->updateAll(array('ape_type'=>$model->ape_type),'ape_id ='.$model->id);
                $this->redirect(array('view','id'=>$model->id));
            }
            //$model=ApeReports::model()->updateByPk($model->ape_id,array("ape_type"=>'tae'));
            //$ape_report= new ApeReports();
            //$ape_report->ape_id = $model->id;
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
        $this->loadModel($id)->delete();      
        $ape_reports= ApeReports::model()->find(array("condition"=>"ape_id = $id"));    

        $this->saveApeLogs($id, $id, "ape ", "Deleted", "");
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Ape');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }     

    /**
     * Manages all models.
     */      
    public function actionAdmin()
    {
        $model=new Ape('search');
        $model->unsetAttributes();  // clear any default values

        $default_type = 'In-house';
        if(isset($_GET['Ape'])){
            $model->attributes=$_GET['Ape'];
            $model->from_date = $_GET['from_date'];
            $model->to_date = $_GET['to_date'];
        }
        //if(isset($_GET['ape_type'])){
        //    $model->ape_type = $_GET['ape_type'];
        //}

        $this->render('admin',array(
            'model'=>$model,
        ));
    }
    
    public function actionReports()
    {                                   
        $model=new ApeReports('search');      
        $model->unsetAttributes();  // clear any default values  
        $model->id = 0;
        if(isset($_GET['ApeReports'])){  
            $model->id = "";               
            $model->attributes=$_GET['ApeReports'];
            $model->from_date = $_GET['from_date'];   
            $model->to_date = $_GET['to_date'];                                                  
        }         
        $this->render('reports',array(
            'model'=>$model, 
            'get'=> $get
        ));
    }

    public function actionLookupape()
        {
                if(!Yii::app()->request->isAjaxRequest)
                        throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));

                $term=$_GET['term'];

                $criteria=new CDbCriteria;                  
                $criteria->condition = " id = :id OR CONCAT_WS(' ',firstname,lastname) like :term ";
                $criteria->params=(array(':term'=>"%$term%",':id'=>"$term"));  
                $criteria->order='id';
                $criteria->limit=20;

                $models=Patient::model()->findAll($criteria);
                $returnArray=array();
                foreach($models AS $model)
                {
                        $returnArray[]=array(
                                'label'=>CHtml::encode($model->id.': '.$model->firstname." ".$model->lastname),
                                'value'=>CHtml::encode($model->id.': '.$model->firstname." ".$model->lastname),
                                'id'=>(int)$model->id,
                        );
                }
                echo CJSON::encode($returnArray);
                Yii::app()->end();
        }

    /**
     * Manages all models.
     */          
//    public function actionReport()
//    {
//        $model=new ApeReports('search');
//        $model->unsetAttributes();  // clear any default values
//        if(isset($_GET['ApeReports']))
//            $model->attributes=$_GET['ApeReports'];
//
//        $this->render('report',array(
//            'model'=>$model,
//        ));
//    }
    public function actionExportToExcel()
    {
        $model=new ApeReports('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['ApeReports']))
            $model->attributes=$_GET['ApeReports'];

        $this->renderPartial('exporttoexcel',array(
            'model'=>$model,
        ));
    }
        
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateWithDoctor()
    {
                $model=new Ape;

                // Uncomment the following line if AJAX validation is needed
                // $this->performAjaxValidation($model);
                                                        

                if(isset($_POST['Ape']))
                {
                    $model->attributes=$_POST['Ape'];
                    $model->patient_id=$_GET['id'];
                    $model->user_id = Yii::app()->user->id;
                    $model->username = Yii::app()->user->name;
                    $model->is_annual = 1;
                    $model->status = 1;
                    if($model->save()){
                        $this->saveApeLogs($model->id, $model->id, "ape ", "Created", json_encode($_POST['Ape']));
                        $ape_dia= new ApeDiagnostic();
                        $ape_dia->ape_id = $model->id;
                        $ape_dia->save();
                        $ape_mh1= new ApeMh1Pastdisease();
                        $ape_mh1->ape_id = $model->id;
                        $ape_mh1->save();
                        $ape_mh2= new ApeMh2Familyhistory();
                        $ape_mh2->ape_id = $model->id;
                        $ape_mh2->save();
                        $ape_mh3= new ApeMh3Socialhistory();
                        $ape_mh3->ape_id = $model->id;
                        $ape_mh3->save();
                        $ape_mh4= new ApeMh4Medicationhistory();
                        $ape_mh4->ape_id = $model->id;
                        $ape_mh4->save();
                        $ape_mh5= new ApeMh5Obgynehistory();
                        $ape_mh5->ape_id = $model->id;
                        $ape_mh5->save();
                        $ape_pe1= new ApePe1Bodymassindex();
                        $ape_pe1->ape_id = $model->id;
                        $ape_pe1->save();
                        $ape_pe2= new ApePe2Bloodpressure();
                        $ape_pe2->ape_id = $model->id;
                        $ape_pe2->save();
                        $ape_pe3= new ApePe3Visualacuity();
                        $ape_pe3->ape_id = $model->id;
                        $ape_pe3->save();
                        $ape_pe4= new ApePe4Findings();
                        $ape_pe4->ape_id = $model->id;
                        $ape_pe4->save();
                        $ape_rec= new ApeRecommendation();
                        $ape_rec->ape_id = $model->id;
                        $ape_rec->save();
                        $ape_others= new ApeOthers();
                        $ape_others->ape_id = $model->id;
                        $ape_others->save();
                        $ape_report= new ApeReports();
                        $ape_report->ape_id = $model->id;
                        $ape_report->datevisited = $model->datevisited;
                        $ape_report->client_id = $model->client_id;
                        $client = Clients::model()->find(array("condition"=>"client_id = $model->client_id"));
                        $ape_report->client_name = $client->client_name;
                        $ape_report->hmo_id = $model->hmo_id;
                        $hmo = Hmo::model()->find(array("condition"=>"id = $model->hmo_id"));
                        $ape_report->hmo_name = $hmo->name;
                        $ape_report->hmo_member_id = $model->hmo_member_id;
                        $ape_report->medilink_no = $model->medilink_no;
                        $ape_report->patient_id = $model->patient_id;
                        $patient = Patient::model()->find(array("condition"=>"id = $model->patient_id"));
                        $ape_report->patient_name = ucwords($patient->lastname.", ".$patient->firstname." ".$patient->middleinitial.".");
                        $ape_report->employee_id = $model->employee_id;
                        //for Rosario
                        $cm = date('Y', strtotime($patient->birthdate));
                        $cd = date('Y', strtotime('now'));
                        $res = $cd - $cm;
                        if (date('m', strtotime($birthday)) > date('m', strtotime('now'))){
                            $res--;
                        }else if ((date('m', strtotime($birthday)) == date('m', strtotime('now'))) &&
                            (date('d', strtotime($birthday)) > date('d', strtotime('now')))){
                            $res--;
                        }
                        //for Bacoor
                        //$ape_report->age = date_diff(date_create($patient->birthdate),date_create('today'))->y;
                        $ape_report->age = $res;
                        $ape_report->gender = $patient->gender;
                        $ape_report->ape_type = $model->ape_type;
                        $ape_report->save();
                        $this->redirect(array('view','id'=>$model->id));
                    }
                } else
                {
                   
                    
                        if (!$_GET){
                            
                            $this->redirect(array('selectWithDoctor'));
                            
                        }
                }
                
                

                $this->render('createWithDoctor',array(
                        'model'=>$model,
                ));
    }            
    
    public function actionApeAgingReport(){      
        $model=new Ape('search');
        $model->unsetAttributes();  // clear any default values
        $model->status = 1;
        if(isset($_GET['Ape'])){         
            $model->attributes=$_GET['Ape'];
            $model->from_date = $_GET['from_date'];   
            $model->to_date = $_GET['to_date'];   
        }                  
        $this->render('apeagingreport',array(
            'model'=>$model,
        ));
        
    }     
    
    public function actionExporttoexcelapeagingreport(){      
        $model=new Ape('search');
        $model->unsetAttributes();  // clear any default values
        $model->status = 1;
        if(isset($_GET['Ape'])){         
            $model->attributes=$_GET['Ape'];    
        }                  
        $this->renderPartial('exporttoexcelapeagingreport',array(
            'model'=>$model,
        ));
        
    }      
    
    public function actionSelectWithDoctor()
    {
            $this->render('selectWithDoctor',array());
    }       
        
    public function actionPrint(){
        
        $ape = Ape::model()->findByPk($_GET['id']);
        $model=$this->loadModel($_GET['id']); 
        
        //patient
        
        $patient = $ape->patient;      
        $print = implode("", file(Yii::app()->getBasePath().'/views/ape/include/ape_form_frontpage.html'));
        $imgurl = Yii::app()->request->baseUrl.'/images/ape_folder';
        $print = str_replace("[imgurl]",$imgurl,$print);    
        $logo = Yii::app()->request->baseUrl.'/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logopath]",$logo,$print);
        $visit = date('F d, Y', strtotime($ape->datevisited));
        $print = str_replace("[datevisited]",$visit,$print);            
        $print = str_replace("[lastname]",$patient->lastname,$print);
        $print = str_replace("[firstname]",$patient->firstname,$print);
        $print = str_replace("[middleinitial]",$patient->middleinitial,$print);
        $print = str_replace("[patient_email]",$patient->email,$print);
        $bday = date('F d, Y', strtotime($patient->birthdate));
        $print = str_replace("[patient_birthday]",$bday,$print);
        //get age
        $birthDate = date('m/d/Y', strtotime($patient->birthdate));
        $birthDate = explode("/", $birthDate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
        $print = str_replace("[age]",$age,$print);
        //sex
        if($patient->gender == 'M'){
            $boxm = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
            $boxf = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
        }else{ 
            $boxf = Yii::app()->request->baseUrl.'/images/pds_folder/box_x.jpg';
            $boxm = Yii::app()->request->baseUrl.'/images/pds_folder/box.jpg';
        }
        $print = str_replace("[imgurlm]",$boxm,$print);
        $print = str_replace("[imgurlf]",$boxf,$print);   
        //civil status
            $boxsin = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
            $boxmar = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
            $boxwid = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
            $boxsep = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
            switch(trim($patient->civilstatus)){
                case 'Married':
                    $boxmar = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                break;
                case 'Single':
                    $boxsin = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                break;
                case 'Widowed':
                    $boxwid= Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                break;
                case 'Separated':
                    $boxsep = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                break;
                default:
                    $boxsin = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                break;
            }
            
            $print = str_replace("[imgurlmar]",$boxmar,$print);
            $print = str_replace("[imgurlsin]",$boxsin,$print);
            $print = str_replace("[imgurlwid]",$boxwid,$print);
            $print = str_replace("[imgurlsep]",$boxsep,$print); 
            //pds number
            $ape->id == "" ? $apeid = '______' : $apeid = $ape->id;
            $print = str_replace("[apeid]",$apeid,$print);
            //availmentdate
            $ape->datevisited == "" ? $datevisited = '______' : $datevisited = date('M d, Y',time($ape->datevisited));
            $print = str_replace("[availment_date]",$datevisited,$print);
            //pds id                                 
            $patient->id == "" ? $patid = '______' : $patid = $patient->id;
            $print = str_replace("[patid]",$patid,$print);
            //company name
            $client = Clients::model()->find(array("condition"=>"client_id = $ape->client_id"));
            $print = str_replace("[company]",$client->client_name,$print);
            //patient image
            $picture = Yii::app()->request->baseUrl.'/'.$patient->filename;
            $print = str_replace("[filename]",$picture,$print);   
            
            if($ape->is_preemployment == 1){
            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
            }
            else{
                $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
            }
            $print = str_replace("[is_preemployment]",$value,$print);
            
            if($ape->is_executive == 1){
            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
            }
            else{
                $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
            }
            $print = str_replace("[is_executive]",$value,$print);
            
            if($ape->is_annual == 1){
            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
            }
            else{
                $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
            }
            $print = str_replace("[is_annual]",$value,$print);
            
            if($ape->is_card == 1){
            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
            }
            else{
                $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
            }
            $print = str_replace("[is_card]",$value,$print);
            
            if($ape->is_promo == 1){
            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
            }
            else{
                $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
            }
            $print = str_replace("[is_promo]",$value,$print);
            
            if($ape->is_others == 1){
            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
            }
            else{
                $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
            }
            $print = str_replace("[is_others]",$value,$print);
            
            $print = str_replace("[card_number]",$ape->card_number,$print);
            
            $print = str_replace("[promo]",$ape->promo,$print);
            
            $print = str_replace("[others]",$ape->others,$print);
            
            
            //present occupation
            ($patient->occupation == NULL || $patient->occupation == "") ? $val = '' : $val = $patient->occupation;
            $print = str_replace("[patient_present_occupation]",$val,$print);   
            
            //position applying for
            $position_applying_for = "";
            ($patient->positionapplyingfor == NULL || $patient->positionapplyingfor == "") ? $val = '' : $val = $patient->positionapplyingfor;
            $print = str_replace("[position_applying_for]",$val,$print);




            //patient contact no
            ($patient->mobile_no == NULL || $patient->mobile_no == "") ? $mobile_no = '' : $mobile_no = $patient->mobile_no;
            ($patient->tel_no == NULL || $patient->tel_no == "") ? $tel_no = '' : $tel_no = $patient->tel_no;
            if($mobile_no == ""){
                $contacno = $tel_no;
            }
            elseif($tel_no == ""){
                $contacno = $mobile_no;
            }
            else{
                $contacno = $mobile_no." / ".$tel_no;
            }
            $print = str_replace("[patient_contact_no]",$contacno,$print);    
            
            //patient address
            $patient_address = $patient->street1." ".$patient->street2." "." ".$patient->barangay." ".$patient->city;
            $print = str_replace("[patient_address]",$patient_address,$print);   
            
            //person to be noticed
            ($patient->emergencycontactname == NULL || $patient->emergencycontactname == "") ? $val = '' : $val = $patient->emergencycontactname;
            $print = str_replace("[person_to_be_notified]",$val,$print);   
            
            //relationship
            ($patient->emergencycontactrelation == NULL || $patient->emergencycontactrelation == "") ? $val = '' : $val = $patient->emergencycontactrelation;
            $print = str_replace("[patient_relationship]",$val,$print);   
            
            //relationship address
            ($patient->emergencycontactaddress == NULL || $patient->emergencycontactaddress == "") ? $val = '' : $val = $patient->emergencycontactaddress;
            $print = str_replace("[patient_relationship_address]",$val,$print);   
            
            //relationship address
            ($patient->emergencycontactnos == NULL || $patient->emergencycontactnos == "") ? $val = '' : $val = $patient->emergencycontactnos;
            $print = str_replace("[patient_relationship_telno]",$val,$print);   
            
            
           //past disease
            $ape_mh1 = ApeMh1Pastdisease::model()->find(array("condition"=>"ape_id = $model->id"));   
            $array_mh1 = $ape_mh1->attributes;
            $checkbox_array1 = array('is_fhm','is_lc','is_dbp','is_wpnt','is_bvep','is_hdep','is_fstcs','is_pcsb','is_fbpr','is_up','is_cd','is_ap','is_gopd','is_a','is_etoaw','is_cphp','is_yes','is_hbbs','is_fsjs','is_bt','is_spcl','is_etb','is_la','is_wlwg','is_sp','is_nd','is_al','is_oc','is_hpidhs');
            foreach($array_mh1 as $key => $val){
                $$key = $val;
                $value = "";
                    if(in_array($key,$checkbox_array1)){
                        if($val == '1'){
                            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                        }
                        elseif($val == '0'){
                            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
                        }
                    }
                    else{
                        if($val){
                            $value = $val;    
                        }
                    }
                    $print = str_replace("[pastdisease_".$key."]",$value,$print);
                 
            } 
            
           //family history
            $ape_mh2= ApeMh2Familyhistory::model()->find(array("condition"=>"ape_id = $model->id")); 
            $array_mh2 = $ape_mh2->attributes;
            $checkbox_array2 = array('is_ha','is_ht','is_dm','is_ptb','is_cancer','is_kd','is_others',);
            foreach($array_mh2 as $key => $val){
                $$key = $val;
                $value = "";
                    if(in_array($key,$checkbox_array2)){
                        if($val == '1'){
                        $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                        }
                        elseif($val == '0'){
                            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
                        }
                    }
                    else{
                        if($val){
                            $value = $val;    
                        }
                    }
                    $print = str_replace("[familyhistory_".$key."]",$value,$print);
                 
            }
            //social history
            $ape_mh3= ApeMh3Socialhistory::model()->find(array("condition"=>"ape_id = $model->id"));   
            $array_mh3 = $ape_mh3->attributes;
            $checkbox_array3 = array('spd','n','shots_n','bottles_n');
            foreach($array_mh3 as $key => $val){
                $$key = $val;
                $value = "";
                    if(!in_array($key,$checkbox_array3)){
                        if($val == '1'){
                            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                        }
                        elseif($val == '0'){
                            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
                        }
                    }
                    else{
                        if($val){
                            $value = $val;    
                        }
                    }
                    $print = str_replace("[socialhistory_".$key."]",$value,$print);
                 
            } 
            
            //medication history
            $ape_mh4= ApeMh4Medicationhistory::model()->find(array("condition"=>"ape_id = $model->id"));  
            $array_mh4 = $ape_mh4->attributes;
            $checkbox_array4 = array('pmt_no','pmt_yes','fdase');
            foreach($array_mh4 as $key => $val){
                $$key = $val;
                $value = "";
                    if(in_array($key,$checkbox_array4)){
                        if($val == '1'){
                            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                        }
                        elseif($val == '0'){
                            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
                        }
                    }
                    else{
                        if($val){
                            $value = $val;    
                        }
                    }
                    $print = str_replace("[medicationhistory_".$key."]",$value,$print);
                 
            } 
            
            //ob-gyne history
            $ape_mh5= ApeMh5Obgynehistory::model()->find(array("condition"=>"ape_id = $model->id"));
            $array_mh5 = $ape_mh5->attributes;
            $checkbox_array5 = array('lmp','miscarriage','caesarian');
            foreach($array_mh5 as $key => $val){
                $$key = $val;
                $value = "";
                    if(!in_array($key,$checkbox_array5)){
                        if($val == '1'){
                            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                        }
                        elseif($val == '0'){
                            $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
                        }
                    }
                    else{
                        if($val){
                            $value = $val;    
                        }
                    }
                    $print = str_replace("[obgynehistory_".$key."]",$value,$print);
                 
            } 
            
        echo $print;
        exit;
    }
    
    public function actionPrintBack(){
        $ape = Ape::model()->findByPk($_GET['id']);
        $model=$this->loadModel($_GET['id']); 
        
        $patient = $ape->patient;      
        $print = implode("", file(Yii::app()->getBasePath().'/views/ape/include/ape_form_backpage.html'));
        $imgurl = Yii::app()->request->baseUrl.'/images/ape_folder';
        $print = str_replace("[imgurl]",$imgurl,$print);    
        $logo = Yii::app()->request->baseUrl.'/images/printdiagresult/wpprintlogo.png';
        //patient
        $boxf = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
        $print = str_replace("[samplebox]",$boxf,$print);    
        
        
        $ape_pe1= ApePe1Bodymassindex::model()->find(array("condition"=>"ape_id = $model->id"));   
        $array_pe1 = $ape_pe1->attributes;
        $checkbox_array1 = array('bmi','bmi_uw','bmi_n','bmi_ow','bmi_oc1','bmi_oc2');
        foreach($array_pe1 as $key => $val){
            $$key = $val;
            $value = "";
                if(in_array($key,$checkbox_array1)){
                    if($val == '1'){
                        $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                    }
                    elseif($val == '0'){
                        $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
                    }
                }
                else{
                    if($val){
                        $value = $val;    
                    }
                }
                $print = str_replace("[bodymassindex_".$key."]",$value,$print);
             
        }
        
        $ape_pe2= ApePe2Bloodpressure::model()->find(array("condition"=>"ape_id = $model->id"));   
        $array_pe2 = $ape_pe2->attributes;
        foreach($array_pe2 as $key => $val){
            $$key = $val;
            $value = "";
            if($val){
                $value = $val;    
            }
        
            $print = str_replace("[bloodpressure_".$key."]",$value,$print);
             
        }
        
        $ape_pe3= ApePe3Visualacuity::model()->find(array("condition"=>"ape_id = $model->id"));   
        $array_pe3 = $ape_pe3->attributes;
        $checkbox_array3 = array('is_uncorrected','is_corrected','is_normal','is_abnormal','is_glasses','is_contactlens');
        foreach($array_pe3 as $key => $val){
            $$key = $val;
            $value = "";
                if(in_array($key,$checkbox_array3)){
                    if($val == '1'){
                        $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                    }
                    elseif($val == '0'){
                        $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
                    }
                }
                else{
                    if($val){
                        $value = $val;    
                    }
                }
                $print = str_replace("[visualacuity_".$key."]",$value,$print);
             
        }
         
        $ape_pe4= ApePe4Findings::model()->find(array("condition"=>"ape_id = $model->id"));   
        $array_pe4 = $ape_pe4->attributes;
        $checkbox_array4 = array('is_ga','is_eyes','is_ears','is_nose','is_throat','is_mtg','is_dc','is_dentures','is_neck','is_heart','is_cl','is_breasts','is_abdomen','is_genital','is_rectal','is_extr','is_skin','is_neu','is_deform','is_others');
        foreach($array_pe4 as $key => $val){
            $$key = $val;
            $value = "";
            if(in_array($key,$checkbox_array4)){
                if($val == '/'){
                    $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_check.jpg';
                }
                elseif($val == 'X'){
                    $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                }
                elseif($val == ''){
                    $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
                }
            }       
            else{
                if($val){
                    $value = $val;    
                }
            }
            $print = str_replace("[findings_".$key."]",$value,$print); 
        }
        
        $ape_diag= ApeDiagnostic::model()->find(array("condition"=>"ape_id = $model->id"));   
        $array_diag = $ape_diag->attributes;  
        $checkbox_array = array('hbsag_nr','hbsag_r','antihbs_n','antihbs_p','dt_n','dt_p','dt_shabu','dt_marijuana','pt_n','pt_p','am_chl','am_shl','us_so','bc_st');
        $slash_array = array('cbc_n','cbc_cif','cbc_ab','u_n','u_cif','u_ab','se_n','se_cif','se_ab','cx_n','cx_cif','cx_ab','am_n','am_cif','am_ab','lecg_n','lecg_cif','lecg_ab','us_n','us_cif','us_ab','bc_n','bc_cif','bc_ab','others_n','others_cif','others_ab');
        foreach($array_diag as $key => $val){
            $$key = $val;
            $value = "";   
            if(in_array($key,$checkbox_array)){
                if($val == '1'){
                    $value = Yii::app()->request->baseUrl.'/images/ape_folder/box_x.jpg';
                }
                elseif($val == '0'){
                    $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
                } 
                else{
                    $value = Yii::app()->request->baseUrl.'/images/ape_folder/box.jpg';
                }
            }
            elseif(in_array($key,$slash_array)){
                if($val == '1'){
                    $value = '/';
                }
                elseif($val == '0'){
                    $value = '';
                }
                else{
                    $value = '';
                }
            }
            else{
                if($val){
                    $value = $val;    
                }
            }
            $print = str_replace("[diagnostic_".$key."]",$value,$print);   
        }
        
        $ape_recom = ApeRecommendation::model()->find(array("condition"=>"ape_id = $model->id"));
        $print = str_replace("[overall_recommendation_1]",$ape_recom->recommendation1,$print);  
        $print = str_replace("[overall_recommendation_2]",$ape_recom->recommendation2,$print);   
        $print = str_replace("[overall_recommendation_3]",$ape_recom->recommendation3,$print);   
        $print = str_replace("[overall_recommendation_4]",$ape_recom->recommendation4,$print);   
        $print = str_replace("[overall_recommendation_5]",$ape_recom->recommendation5,$print);    
        
        echo $print;
        exit;
    }
        
        
    public function saveApeLogs($ape_id, $id,$ape_section, $details,$changes){    
        $ape_logs = new ApeLogs();   
        $ape_logs->ape_id = $ape_id;  
        $ape_logs->ape_section = $ape_section;          
        $ape_logs->user_id = Yii::app()->user->id;
        $ape_logs->username = Yii::app()->user->name;
        $ape_logs->update_datetime = date("Y-m-d H:i:s");                                         
        $ape_logs->details = ucwords(Yii::app()->user->name)." had ". $details." ".$ape_section." ".$id;
        $ape_logs->changes = $changes;
        $ape_logs->save();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Ape the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Ape::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Ape $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='ape-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}