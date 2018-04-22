<?php

class HmoFormItemsController extends RController
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
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
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
        $model = new HmoFormItems;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if(isset($_POST['HmoFormItems']))
        {               
            //$model->attributes=$_POST['HmoFormItems'];
            $post = $_POST['HmoFormItems'];
            $model->hmo_form_id = $post['hmo_form_id'];   
            $model->isapplied = 0; 
            $model->item_entry_date = date('Y-m-d G:i:s');
            $model->payto = $post['payto']; 
            $model->claim_doctor_id = $post['claim_doctor_id']; 
            $model->claim_doctor_name = $post['claim_doctor_name'];
            $model->diagnosis = $post['diagnosis'];
            $model->med_service = $post['med_service'];
            $model->service_type = $post['service_type'];
            $model->req_doctor = $post['req_doctor'];
            $model->charge_type = $post['charge_type'];
            $model->charge_fee = $post['charge_fee'];
            if(isset($post['double_transaction_tag'])) {
                $model->double_transaction_tag = $post['double_transaction_tag'];
            }
            $model->item_update_date = date("Y-m-d G:i:s");   
             
            if($model->save()){
                //compute hmo form total
                $this->computeFormTotal($model->hmo_form_id);

                //save categories
                if(isset($post['med_service_category'])){

                    $hf = HmoForm::model()->findByPk((int)$model->hmo_form_id);

                    foreach($post['med_service_category'] as $message){
                        //var_dump($message);
                        $modelcat = new HmoFormItemsCategory();
                        $medical_val = explode(":",$message);
                        $modelcat->med_service = $medical_val[0];
                        $modelcat->amount = $medical_val[1];
                        $modelcat->hmo_form_item_id = $model->itemid;
                        $modelcat->hmo_billing_id = $hf->hmo_billing_id;
                        $modelcat->category = $medical_val[2] ? $medical_val[2] : 'Others';
                        $modelcat->payto = $post['payto'];
                        $med_service[] = $medical_val[0];
                        $modelcat->insert();
                    } 

                    $model->is_categorized = 1;
                    $model->save();  

                }else{
                    //var_dump($post);
                }
                
                //$this->redirect(array('view','id'=>$model->itemid));
                $this->redirect(array('hmoForm/View','id'=>$model->hmo_form_id));      
            }
                
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }
    
    public function computeFormTotal($hmo_form_id){
        $connection=Yii::app()->db;                                           
        $query ="select sum(charge_fee) as form_total
                    from hmo_form_items
                    where hmo_form_id = ".$hmo_form_id;
        $command=$connection->createCommand($query);
        $dataReader=$command->query();                    
        $rowcount = $dataReader->getRowCount();                    
        if ($rowcount > 0){                    
                foreach($dataReader as $row) { 
                    $form_total = $row["form_total"];
                }
        }
        //save
        $hmoform = HmoForm::model()->findByPk($hmo_form_id);
        $hmoform->form_total = $form_total;
        $hmoform->save();        
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

        if(isset($_POST['HmoFormItems']))
        {
            //var_dump($_POST);
            $post = $_POST['HmoFormItems'];
            $model->isapplied = 0; 
            $model->item_entry_date = date('Y-m-d G:i:s');
            $model->payto = $post['payto']; 
            $model->claim_doctor_id = $post['claim_doctor_id']; 
            $model->claim_doctor_name = $post['claim_doctor_name'];
            $model->diagnosis = $post['diagnosis'];
            $model->med_service = $post['med_service'];
            $model->service_type = $post['service_type'];
            $model->req_doctor = $post['req_doctor'];
            $model->charge_type = $post['charge_type'];
            $model->charge_fee = $post['charge_fee'];
            if(isset($post['double_transaction_tag'])) {
                $model->double_transaction_tag = $post['double_transaction_tag'];
            }
            $model->item_update_date = date("Y-m-d G:i:s"); 

            //$model->attributes=$_POST['HmoFormItems'];
            if($model->save()){
                $this->computeFormTotal($model->hmo_form_id);

                //save categories
                if(isset($post['med_service_category'])){

                    $command = Yii::app()->db->createCommand();
                    $command->delete('hmo_form_items_category', 'hmo_form_item_id='.$model->itemid);

                    $hf = HmoForm::model()->findByPk((int)$model->hmo_form_id);

                    //var_dump($model->attributes);
                    //var_dump($hf->attributes);

                    foreach($post['med_service_category'] as $message){
                        //var_dump($message);
                        $modelcat = new HmoFormItemsCategory();
                        $medical_val = explode(":",$message);
                        $modelcat->med_service = $medical_val[0];
                        $modelcat->amount = $medical_val[1];
                        $modelcat->hmo_form_item_id = $model->itemid;
                        $modelcat->hmo_billing_id = $hf->hmo_billing_id;
                        $modelcat->category = $medical_val[2] ? $medical_val[2] : 'Others';
                        $modelcat->payto = $post['payto'];
                        $med_service[] = $medical_val[0];
                        $modelcat->insert();
                    }

                    $model->is_categorized = 1;
                    $model->save();  
                }else{
                    //var_dump($post);
                }

                //$this->redirect(array('view','id'=>$model->itemid));
                $this->redirect(array('hmoForm/View','id'=>$model->hmo_form_id));      
            }
                
        }

        //var_dump($model->hmo_form_id);
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
        $tmp = HmoFormItems::model()->findByPk($id);
        $hmoFormId = $tmp->hmo_form_id;
        
        $this->redirect(array('hmoForm/view','id'=>$hmoFormId));   
        /*if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();
            

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        */
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('HmoFormItems');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new HmoFormItems('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['HmoFormItems']))
            $model->attributes=$_GET['HmoFormItems'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=HmoFormItems::model()->findByPk($id);
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='hmo-form-items-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }



    public function actionCreatewithcategory()
    {
        $model = new HmoFormItemsCategorySupport;
        $hf = HmoForm::model()->findByPk((int)$_GET['id']);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['HmoFormItemsCategorySupport']))
        {
            $postObj = $_POST['HmoFormItemsCategorySupport'];
            if($postObj['service_type'] == 'CONSULTATION'){
                $postObj['charge_type'] = "PROF_FEE";
            }else{
                $postObj['charge_type'] = "CCHARGE";
            }

            if($postObj['hmo_items_savetype'] == 1){
                $errmsg = null;
                if($postObj['medical_service'] == "" || $postObj['medical_service'] == null){
                    $errmsg[] = 'Please enter medical service.';
                }
                if($postObj['diagnosis'] == ""){
                    $errmsg[] = 'Please enter diagnosis.';
                }
                if($postObj['charge_fee'] == "" || $postObj['charge_fee'] == 0){
                    $errmsg[] = 'Wrong value for charge fee.';
                }

                if($errmsg){
                    Yii::app()->user->setFlash('cv',$postObj);
                    Yii::app()->user->setFlash('error',$errmsg);
                    $this->redirect(array('hmoFormItems/createwithcategory','id'=>$postObj['hmo_form_id']));
                }

                $postObj['payto'] = 'WPCLINIC';
                $doctorArr = explode(":",$postObj['req_doctor']);
                if(count($doctorArr) > 1){
                    $postObj['claim_doctor_id'] = $doctorArr[0];
                    $postObj['claim_doctor_name'] = $doctorArr[1];
                }else{
                    $postObj['claim_doctor_id'] = 0;
                    $postObj['claim_doctor_name'] = strtoupper($doctorArr[0]);
                }
                $postObj['med_service'] = '';
            }

            if($postObj['hmo_items_savetype'] == 2){
                if($postObj['service_type'] == 'CONSULTATION'){
                    $postObj['charge_type'] = "PROF_FEE";
                }else{
                    $postObj['charge_type'] = "PROCEDURE";
                }
                
                $errmsg = null;
                if($postObj['medical_service'] == "" || $postObj['medical_service'] == null){
                    $errmsg[] = 'Please add procedure type.';
                }
                if($postObj['diagnosis'] == ""){
                    $errmsg[] = 'Please enter diagnosis.';
                }
                if($postObj['charge_fee'] == "" || $postObj['charge_fee'] == 0){
                    $errmsg[] = 'Wrong value for charge fee.';
                }

                if($errmsg){
                    Yii::app()->user->setFlash('cv',$postObj);
                    Yii::app()->user->setFlash('error_doctor',$errmsg);
                    $this->redirect(array('hmoFormItems/createwithcategory','id'=>$postObj['hmo_form_id']));
                }

                $doctorArr = explode(":",$postObj['claim_doctor_name']);
                if(count($doctorArr) > 1){
                    $postObj['claim_doctor_id'] = $doctorArr[0];
                    $postObj['claim_doctor_name'] = $doctorArr[1];
                }else{
                    $postObj['claim_doctor_id'] = 0;
                    $postObj['claim_doctor_name'] = strtoupper($doctorArr[0]);
                }
                $postObj['payto'] = 'DOCTOR';
                $postObj['med_service'] = '';
            }

            $model->attributes=$postObj;
            $model->hmo_form_id =$_GET['id'];

            if($model->save()){
                $med_service = null;
                //add item categorized
                if($postObj['medical_service']){
                    foreach($postObj['medical_service'] as $message){
                        $modelcat = new HmoFormItemsCategory();
                        $medical_val = explode(":",$message);
                        $modelcat->med_service = $medical_val[0];
                        $modelcat->amount = $medical_val[1];
                        $modelcat->hmo_form_item_id = $model->itemid;
                        $modelcat->hmo_billing_id = $hf->hmo_billing_id;
                        $modelcat->category = $medical_val[2] ? $medical_val[2] : 'Others';
                        $med_service[] = $medical_val[0];
                        $modelcat->insert();
                    }
                }
                /*$modelcat = new HmoFormItemsCategory();
                if($postObj['medical_service_others']){
                    foreach($postObj['medical_service_others'] as $message){
                        $modelcat = new HmoFormItemsCategory();
                        $medical_val = explode(":",$message);
                        $modelcat->med_service = $medical_val[0];
                        $modelcat->amount = $medical_val[1];
                        $modelcat->hmo_form_item_id = $model->itemid;
                        $modelcat->category = 'Others';
                        $med_service[] = $medical_val[0];
                        $modelcat->insert();
                    }
                }*/
                //update medical services
                $model->med_service =implode(",",$med_service);
                $model->save();
                //compute hmo form total
                $this->computeFormTotal($model->hmo_form_id);
                $this->redirect(array('hmoForm/View','id'=>$model->hmo_form_id));
            }
        }

        $this->render('createwithcategory',array(
            'model'=>$model,
        ));
    }

    public function actionUpdatewithcategory($id)
    {
        $model = HmoFormItemsCategorySupport::model()->findByPk((int)$id);
        $hfic = HmoFormItemsCategory::model()->findAllBySql("select * from hmo_form_items_category where hmo_form_item_id = ".$model->itemid);
        $hf = HmoForm::model()->findByPk((int)$model->hmo_form_id);
        $hb = HmoBilling::model()->findByPk((int)$hf->hmo_billing_id);
        
        $hficarr = null;
        foreach($hfic as $value){
            $hficarr[] = $value->attributes['med_service'].':'.$value->attributes['amount'].':'.$value->attributes['category'];
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['HmoFormItemsCategorySupport']))
        {
            $postObj = $_POST['HmoFormItemsCategorySupport'];
            /*if($postObj['service_type'] == 'CONSULTATION'){
                $postObj['charge_type'] = "PROF_FEE";
            }else{
                $postObj['charge_type'] = "CCHARGE";
            }*/

            if($postObj['hmo_items_savetype'] == 1){
                $postObj['charge_type'] = "CCHARGE";

                $errmsg = null;
                if($postObj['medical_service'] == "" || $postObj['medical_service'] == null){
                    $errmsg[] = 'Please enter medical service.';
                }
                if($postObj['diagnosis'] == ""){
                    $errmsg[] = 'Please enter diagnosis.';
                }
                if($postObj['charge_fee'] == "" || $postObj['charge_fee'] == 0){
                    $errmsg[] = 'Wrong value for charge fee.';
                }

                if($errmsg){
                    Yii::app()->user->setFlash('cv',$postObj);
                    Yii::app()->user->setFlash('error',$errmsg);
                    $this->redirect(array('hmoFormItems/createwithcategory','id'=>$postObj['hmo_form_id']));
                }

                $postObj['payto'] = 'WPCLINIC';
                $doctorArr = explode(":",$postObj['req_doctor']);
                if(count($doctorArr) > 1){
                    $postObj['claim_doctor_id'] = $doctorArr[0];
                    $postObj['claim_doctor_name'] = $doctorArr[1];
                }else{
                    $postObj['claim_doctor_id'] = 0;
                    $postObj['claim_doctor_name'] = strtoupper($doctorArr[0]);
                }
                $postObj['med_service'] = '';
            }

            if($postObj['hmo_items_savetype'] == 2){
                if($postObj['service_type'] == 'CONSULTATION'){
                    $postObj['charge_type'] = "PROF_FEE";
                }else{
                    $postObj['charge_type'] = "PROCEDURE";
                }

                $errmsg = null;
                if($postObj['medical_service'] == "" || $postObj['medical_service'] == null){
                    $errmsg[] = 'Please add procedure type.';
                }
                if($postObj['diagnosis'] == ""){
                    $errmsg[] = 'Please enter diagnosis.';
                }
                if($postObj['charge_fee'] == "" || $postObj['charge_fee'] == 0){
                    $errmsg[] = 'Wrong value for charge fee.';
                }

                if($errmsg){
                    Yii::app()->user->setFlash('cv',$postObj);
                    Yii::app()->user->setFlash('error_doctor',$errmsg);
                    $this->redirect(array('hmoFormItems/createwithcategory','id'=>$postObj['hmo_form_id']));
                }

                $doctorArr = explode(":",$postObj['claim_doctor_name']);
                if(count($doctorArr) > 1){
                    $postObj['claim_doctor_id'] = $doctorArr[0];
                    $postObj['claim_doctor_name'] = $doctorArr[1];
                }else{
                    $postObj['claim_doctor_id'] = 0;
                    $postObj['claim_doctor_name'] = strtoupper($doctorArr[0]);
                }
                $postObj['payto'] = 'DOCTOR';
                $postObj['med_service'] = '';
            }

            $model->attributes = $postObj;
            //$model->hmo_form_id = $_POST['hmo_form_id'];

            if($model->save()){
                $med_service = null;
                //delete first
                $command = Yii::app()->db->createCommand();
                $command->delete('hmo_form_items_category', 'hmo_form_item_id='.$model->itemid);
                //add item categorized
                if($postObj['medical_service']){
                    foreach($postObj['medical_service'] as $message){
                        $modelcat = new HmoFormItemsCategory();
                        $medical_val = explode(":",$message);
                        $modelcat->med_service = $medical_val[0];
                        $modelcat->amount = $medical_val[1];
                        $modelcat->hmo_form_item_id = $model->itemid;
                        $modelcat->hmo_billing_id = $hf->hmo_billing_id;
                        $modelcat->category = $medical_val[2] ? $medical_val[2] : 'Others';
                        $med_service[] = $medical_val[0];
                        $modelcat->insert();
                    }
                }
                //update medical services
                $model->med_service =implode(",",$med_service);
                $model->save();
                //compute hmo form total
                $this->computeFormTotal($model->hmo_form_id);
                $this->redirect(array('/hmoForm/View','id'=>$model->hmo_form_id));
            }

        }

        $postObj = $model->attributes;
        $postObj['medical_service'] = $hficarr;
        Yii::app()->user->setFlash('cv',$postObj);
        $this->render('updatewithcategory',array('model'=>$model));
    }

    public function computeFormTotalCategory($hmo_form_id,$hmo_form_item_id){
        $connection=Yii::app()->db;
        $query ="select sum(amount) as form_total
                                from hmo_form_items_category
                                where hmo_form_item_id = ".$hmo_form_item_id;
        $command=$connection->createCommand($query);
        $dataReader=$command->query();
        $rowcount = $dataReader->getRowCount();
        if ($rowcount > 0){
            foreach($dataReader as $row) {
                $form_total = $row["form_total"];
            }
        }
        //save
        $hmoform = HmoForm::model()->findByPk($hmo_form_id);
        $hmoform->form_total = $form_total;
        $hmoform->save();
    }
    
    public function actionPrintchargeslipsingle($to_excel = false)
    {
        if($_GET){

            $print = $this->printChargeslipItem($_GET['id']);

            if ($to_excel == true){
                $filename = "Charge_Slip_$item_id.xls";
                header("Content-Disposition: attachment; filename=\"$filename\"");
                header("Content-Type: application/vnd.ms-excel");
                echo $print;
            }else{
                echo $print;
            }

        }
    }

    public function actionPrintchargeslip($to_excel = false)
    {
        if($_GET){
            $connection=Yii::app()->db;
            $form_id =  $_GET["id"];
            $hf = HmoForm::model()->findByPk((int)$form_id);
            $hb = HmoBilling::model()->findByPk((int)$hf->hmo_billing_id);

            $query = "select * from hmo_form_items where hmo_form_id = ".(int)$form_id." order by itemid desc";
            $command = $connection->createCommand($query);
            $hfi = $command->query();

            $url = Yii::app()->getBasePath() ;
            $print = implode("", file(Yii::app()->getBasePath().'\html\chargeslip.html'));
            $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';

            $cs_content = "";
            foreach ($hfi as $row) {
                $date = date("F d, Y");
                $patient_name = strtoupper($hf->patient_name);
                $claim_doctor_name = strtoupper($row['claim_doctor_name']);
                $hmo_name = strtoupper($hf->hmo_name);
                $total_amount = number_format($row['charge_fee'],2);

                // contents
                $charge_content = '';
                $queryx = "select * from hmo_form_items_category where hmo_form_item_id = ".$row['itemid']." order by category asc";
                $commandx = $connection->createCommand($queryx);
                $hmo_form_items = $commandx->query();

                $curr_cat = "";
                $charge_content = "";
                $charge_category = null;
                $cat_index = 0;
                $category_items = null;
                $category_amount = null;
                foreach($hmo_form_items as $row) { 
                    if($curr_cat != $row['category']){
                        $charge_category[] = $row['category'];
                        $cat_index++;
                    }
                    $category_items[$cat_index-1][] = $row['med_service'];
                    $category_amount[$cat_index-1][] = $row['amount'];
                    $curr_cat = $row['category'];
                }

                if($charge_category){
                    foreach ($charge_category as $key => $value) {
                        $charge_content = $charge_content."<tr><td>".strtoupper($value).":</td><td></td></tr>";
                        $charge_content = $charge_content."<tr><td>".implode(" + ",$category_items[$key]).
                            "</td><td align=\"right\">".implode("+",$category_amount[$key])."</td></tr>";
                    }
                }

                $cs_content = $cs_content.'<div style="width:320px;height:452px;text-align:left;float:left;margin:0px 20px 0px 0px;position:relative;"><table style="width:100%">
                            <tr>
                                <td colspan="2" style="text-align:center;" valign=top >
                                    <img src="[logopath]" />
                                    <div>Medical Clinic and Diagnostic Center, Inc.</div>
                                </td>
                            </tr>
                            <tr >
                                <td colspan="2"  style="padding:0px 0px 10px 0px;">
                                    <div class="branch">
                                    31 - 32 LGF SM City Bacoor,<br/>
                                    Tirona Cor. Aguinaldo Highway, Bacoor, Cavite<br/>
                                    Tel. No. (046) 970-1850 / Fax # (046) 970-1851
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:left;font-size:15px;font-weight:700;" valign=top >CHARGE SLIP</td>
                                <td style="text-align:right;" valign=top >Date: '.$date.'</td>
                            </tr>
                            <tr><td colspan="2" style="border-bottom:1px solid #dedede">Name: '.$patient_name.'</td></tr>
                            <tr><td colspan="2" style="border-bottom:1px solid #dedede">Doctor: '.$claim_doctor_name.'</td></tr>
                            <tr><td colspan="2" style="border-bottom:1px solid #dedede">Patient Type: '.$hmo_name.'</td></tr>

                            <tr>
                                <td colspan="2" style="padding:10px 0px;">
                                    <table cellspacing="0" cellspacing="0" border="1" width="100%" id="charge_tbl">
                                        <tr><td align="center" >SERVICE</td><td align="center" width="30%">PRICE</td></tr>
                                        '.$charge_content.'
                                        <tr><td align="left" >TOTAL:</td><td align="right" width="30%">'.$total_amount.'</td></tr>
                                    </table>
                                </td>
                            </tr>    
                        </table>
                        <table style="width:100%;position:absolute;bottom:15px;">
                            <tr><td></td><td width="50%" style="border-bottom:1px solid #000;padding:20px 0px 0px 0px;text-align:center">'.$hb->prepared_by.'</td></tr>
                            <tr><td></td><td align="center" valign="top" style="padding:0px 0px 0px 0px;font-size:10px;">HMO Billing Officer</td></tr>
                        </table>
                        </div>';

                $cs_content_adder = '<div style="width:320px;height:452px;text-align:left;float:left;margin:0px 20px 0px 0px;position:relative;"></div>';

                $cs_content = $cs_content.$cs_content_adder.$cs_content_adder.$cs_content_adder;
            }

            $print = str_replace("[charge_slips]",$cs_content,$print);




            $print = str_replace("[logopath]",$logo,$print);

            if ($to_excel == true){
                $filename = "Charge_Slips_$item_id.xls";
                header("Content-Disposition: attachment; filename=\"$filename\"");
                header("Content-Type: application/vnd.ms-excel");
                echo $print;
            }else{
                //echo "<button class='noprint' onclick=\"window.location = '../exporttoexcelsingle/$item_id'\" value='' >Export to Excel</button>";
                echo $print;
            }
        }

    }

    public function printChargeslipItem($id)
    {
        $connection=Yii::app()->db;
        $item_id =  $id;
        $hfi = HmoFormItems::model()->findByPk((int)$item_id);
        $svctyp = $hfi['service_type'];
        $chrgf = number_format($hfi['charge_fee'],2);
        $hf = HmoForm::model()->findByPk($hfi->hmo_form_id);
        $hb = HmoBilling::model()->findByPk((int)$hf->hmo_billing_id);

        $query = "select * from hmo_form_items_category where hmo_form_item_id = ".(int)$item_id." order by category asc";
        $command = $connection->createCommand($query);
        $dataReader = $command->query();
        
        $url = Yii::app()->getBasePath() ;
        $print = implode("", file(Yii::app()->getBasePath().'/html/chargeslipsingle.html'));
        $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logopath]",$logo,$print);

        //$print = str_replace("[date]",date("M d, Y"),$print);
        //var_dump($hf->avail_date);
        //$xdatex = date_create($hf->avail_date);
        //var_dump(date("M d, Y"));
        $print = str_replace("[date]", date('M d, Y', strtotime( $hf->avail_date )), $print);
        $print = str_replace("[patient_name]",strtoupper($hf->patient_name),$print);
        if($hfi->claim_doctor_name){
            $print = str_replace("[doctor_name]",$hfi->claim_doctor_name,$print);
        }else{
            $print = str_replace("[doctor_name]",$hfi->req_doctor,$print);
        }

        $hmo_name_ref = trim($hf->hmo_name);
        $hmo = Hmo::model()->find(array("condition"=>"name = '$hmo_name_ref'"));       
        if($hmo->abbreviation != null && $hmo->abbreviation != "") { $patient_type = trim($hmo->abbreviation); }else{ $patient_type = $hmo_name_ref; }
        /*$patient_type = "";
        switch($hmo_name_ref){
            case "Health Maintenance, Inc.": $patient_type = "HMI"; break;
            default: $patient_type = $hmo_name_ref; break;
        }*/
        $print = str_replace("[patient_type]", $patient_type, $print);

        // contents            
        $curr_cat = "";
        $charge_content = "";
        $charge_category = null;
        $cat_index = 0;
        $category_items = null;
        $category_amount = null;
        $catcnt = 1;
        $consamount = "";
        $procedure_box = "";
        $procedure_sub_box = "none";
        $laboratory_box = "none";
        $laboratory_sub_box = "none";
        $procedure_content = "";
        //if($svctyp == "CONSULTATION") {


        if($dataReader){
            foreach($dataReader as $row) { 
                //var_dump($row['med_service']);
                switch(trim($row['category'])){
                    case "Doctors and Procedures":
                        if($row['med_service'] != "Consultation"){
                            $charge_category[] = "SUB_CONSULTATION";
                            $charge_category_sub_procedure_med_service[] =  $row['med_service'];
                            $charge_category_sub_procedure_amount[] =  number_format($row['amount'],0);
                        }else{
                            $charge_category[] = "CONSULTATION";
                        }
                        break;
                    case "Clinic Procedure":
                        if($row['med_service'] != "Consultation"){
                            $charge_category[] = "SUB_CONSULTATION";
                            $charge_category_sub_procedure_med_service[] =  $row['med_service'];
                            $charge_category_sub_procedure_amount[] =  number_format($row['amount'],0);
                        }
                        break;
                    case "Medical": 
                    case "Medical Clinic": 
                    case "Consultation": 
                        $charge_category[] = "CONSULTATION";
                        break;
                    case "Doctors and Procedures":
                        if($row['med_service'] == "Consultation"){
                            $charge_category[] = "CONSULTATION";
                        }else{
                            $charge_category[] = "SUB_CONSULTATION";
                            $charge_category_sub_procedure_med_service[] =  $row['med_service'];
                            $charge_category_sub_procedure_amount[] =  number_format($row['amount'],0);
                        }
                        break;
                    case "Annual Physical Exam":
                        $charge_category[] = "APE";
                        $charge_category_sub_procedure_med_service[] =  $row['med_service'];
                        $charge_category_sub_procedure_amount[] =  number_format($row['amount'],0);
                        break;
                    case "Radiology and Ancillary": 
                        $charge_category[] = "ANCILLARY";
                        $charge_category_sub_ansi_med_service[] =  $row['med_service'];
                        $charge_category_sub_ansi_amount[] =  number_format($row['amount'],0);
                        break;
                    case "Laboratory": 
                        $charge_category[] = "LABORATORY";
                        $charge_category_sub_lab_med_service[] =  $row['med_service'];
                        $charge_category_sub_lab_amount[] =  number_format($row['amount'],0);
                        break;
                    case "Rehabilitation Medicine And Physical Therapy":
                        $charge_category[] = "REHAB MEDICINE & PT";
                        $charge_category_sub_rehab_med_service[] =  $row['med_service'];
                        $charge_category_sub_rehab_amount[] =  number_format($row['amount'],0);
                        break;
                    default:
                        //if($row['category'] != "Doctors")
                        $charge_category[] = $row['category'];
                        break;
                }
                $cat_index++;
                $category_items[$cat_index-1][] = $row['med_service'];
                $category_amount[$cat_index-1][] = number_format($row['amount'],0);
            }    

            if($hfi->double_transaction_tag != 0){
                $query = "select * from hmo_form_items_category where hmo_form_item_id = ".(int)$hfi->double_transaction_tag." order by category asc";
                $command = $connection->createCommand($query);
                $dataReaderDouble = $command->query();

                foreach($dataReaderDouble as $row) { 
                    switch(trim($row['category'])){
                        case "Doctors and Procedures":
                            if($row['med_service'] != "Consultation"){
                                $charge_category[] = "SUB_CONSULTATION";
                                $charge_category_sub_procedure_med_service[] =  $row['med_service'];
                                $charge_category_sub_procedure_amount[] =  number_format($row['amount'],0);
                            }else{
                                $charge_category[] = "CONSULTATION";
                            }
                            break;
                        case "Clinic Procedure":
                            if($row['med_service'] != "Consultation"){
                                $charge_category[] = "SUB_CONSULTATION";
                                $charge_category_sub_procedure_med_service[] =  $row['med_service'];
                                $charge_category_sub_procedure_amount[] =  number_format($row['amount'],0);
                            }
                            break;
                        case "Medical": 
                        case "Medical Clinic": 
                        case "Consultation": 
                            $charge_category[] = "CONSULTATION";
                            break;
                        case "Annual Physical Exam":
                            $charge_category[] = "APE";
                            $charge_category_sub_procedure_med_service[] =  $row['med_service'];
                            $charge_category_sub_procedure_amount[] =  number_format($row['amount'],0);
                            break;
                        case "Radiology and Ancillary": 
                            $charge_category[] = "ANCILLARY";
                            $charge_category_sub_ansi_med_service[] =  $row['med_service'];
                            $charge_category_sub_ansi_amount[] =  number_format($row['amount'],0);
                            break;
                        case "Laboratory": 
                            $charge_category[] = "LABORATORY";
                            $charge_category_sub_lab_med_service[] =  $row['med_service'];
                            $charge_category_sub_lab_amount[] =  number_format($row['amount'],0);
                            break;
                        case "Rehabilitation Medicine And Physical Therapy":
                            $charge_category[] = "REHAB MEDICINE & PT";
                            $charge_category_sub_rehab_med_service[] =  $row['med_service'];
                            $charge_category_sub_rehab_amount[] =  number_format($row['amount'],0);
                            break;
                        default:
                            //if($row['category'] != "Doctors")
                            $charge_category[] = $row['category'];
                            break;
                    }
                    $cat_index++;
                    $category_items[$cat_index-1][] = $row['med_service'];
                    $category_amount[$cat_index-1][] = number_format($row['amount'],0);
                }   

            }

        }

        if($charge_category){
            $flag_with_laboratory = 0;
            $flag_with_procedure = 0;
            $flag_with_ancillary = 0;
            $flag_with_rehab = 0;
            
            //var_dump($charge_category);

            foreach ($charge_category as $key => $value) {
                switch($value){
                    case "CONSULTATION": 
                        $consamount = implode(" +",$category_amount[$key]) == "" ? "" : implode(" +",$category_amount[$key]) ;
                        if(isset($charge_category_sub_procedure_med_service)){
                            $flag_with_procedure = 1;
                        }
                        break;
                    case "SUB_CONSULTATION": 
                        if(isset($charge_category_sub_procedure_med_service)){
                            $flag_with_procedure = 1;
                        }
                        break;
                    case "APE":
                        $flag_with_procedure = 1;
                        break; 
                    case "ANCILLARY": 
                        $flag_with_ancillary = 1;
                        break;
                    case "LABORATORY":
                        $flag_with_laboratory = 1;
                        break; 
                    case "REHAB MEDICINE & PT":
                        $flag_with_rehab = 1;
                        break; 
                    default:
                        if($value != "SUB_CONSULTATION"){ 
                            $catcnt++;
                            $charge_content = $charge_content."<tr><td style='color:green;'><b>".strtoupper($value).":</b></td><td>&nbsp;</td></tr>";
                            $catcnt++;
                            $charge_content = $charge_content."<tr><td>".implode(" +",$category_items[$key]).
                                "</td><td align=\"right\">".implode(" +",$category_amount[$key])."</td></tr>";
                        }
                        break;
                }

            }

            if($flag_with_procedure == 1){ 
                //$procArr = [];
                if(count($charge_category_sub_procedure_med_service) == 1) {
                    $procArr = explode("+",$charge_category_sub_procedure_med_service[0]);
                }
                if(count($procArr) > 1) {
                    $l=0;
                    while( $l < count($procArr) ){
                        $ms_str = isset($procArr[$l]) ? trim($procArr[$l]) : "&nbsp;" ;
                        $msa_str = isset($charge_category_sub_procedure_amount[$l]) ? $charge_category_sub_procedure_amount[$l] : "&nbsp;" ;
                        $l++;
                        $ms_str = isset($procArr[$l]) ? $ms_str."+".$procArr[$l]."+" : $ms_str."&nbsp;" ;
                        $procedure_content = $procedure_content."<tr><td><div id='item_svc'><span>$ms_str</span></div></td><td align='right' id='item_amount'>$msa_str</td></tr>";
                        $l++;
                        $catcnt++;
                    }
                }else{
                    $l=0;
                    while( $l < count($charge_category_sub_procedure_med_service) ){
                        $ms_str = isset($charge_category_sub_procedure_med_service[$l]) ? $charge_category_sub_procedure_med_service[$l] : "&nbsp;" ;
                        $msa_str = isset($charge_category_sub_procedure_amount[$l]) ? $charge_category_sub_procedure_amount[$l] : "&nbsp;" ;
                        $l++;
                        $ms_str = isset($charge_category_sub_procedure_med_service[$l]) ? $ms_str."+".$charge_category_sub_procedure_med_service[$l]."+" : $ms_str."&nbsp;" ;
                        $msa_str = isset($charge_category_sub_procedure_amount[$l]) ? $msa_str."+".$charge_category_sub_procedure_amount[$l]."+" : $msa_str."" ;
                        $procedure_content = $procedure_content."<tr><td><div id='item_svc'><span>$ms_str</span></div></td><td align='right' id='item_amount'>$msa_str</td></tr>";
                        $l++;
                        $catcnt++;
                    }
                }
            }

            if($procedure_content == "") {
                $procedure_box = "none"; $procedure_sub_box = "none";
            }

            if($flag_with_laboratory == 1){
                $laboratory_box = ""; $catcnt++;
                if($flag_with_procedure == 0) {
                    $catcnt--;
                    $procedure_box = "none"; $procedure_sub_box = "none";
                }
                $l=0;
                while( $l <= count($charge_category_sub_lab_med_service) ){
                    $ms_str = isset($charge_category_sub_lab_med_service[$l]) ? $charge_category_sub_lab_med_service[$l] : "&nbsp;" ;
                    $msa_str = isset($charge_category_sub_lab_amount[$l]) ? $charge_category_sub_lab_amount[$l] : "&nbsp;" ;
                    $l++;
                    $ms_str = isset($charge_category_sub_lab_med_service[$l]) ? $ms_str." + ".$charge_category_sub_lab_med_service[$l]." + " : $ms_str."&nbsp;" ;
                    $msa_str = isset($charge_category_sub_lab_amount[$l]) ? $msa_str."+".$charge_category_sub_lab_amount[$l]."+" : $msa_str."" ;
                    $charge_content = $charge_content."<tr><td id='item_svc'>$ms_str</td><td align='right' id='item_amount'>$msa_str</td></tr>";
                    $l++;
                    $catcnt++;
                }
                $charge_content = $charge_content."<tr><td ><b style='color:green;'>&nbsp;</td><td align='right'>&nbsp;</td></tr>"; $catcnt++;
                $charge_content = $charge_content."<tr><td ><b style='color:green;'>&nbsp;</td><td align='right'>&nbsp;</td></tr>"; $catcnt++;
                $charge_content = $charge_content."<tr><td ><b style='color:green;'>&nbsp;</td><td align='right'>&nbsp;</td></tr>"; $catcnt++;
                $charge_content = $charge_content."<tr><td ><b style='color:green;'>&nbsp;</td><td align='right'>&nbsp;</td></tr>"; $catcnt++;
            }

            if($flag_with_ancillary == 1){
                // ancillary header
                $charge_content = $charge_content."<tr><td ><b style='color:green;'>ANCILLARY:</td><td align='right'>&nbsp;</td></tr>"; $catcnt++;
                // get contents
                $l=0;
                while( $l < count($charge_category_sub_ansi_med_service) ){
                    $ms_str = isset($charge_category_sub_ansi_med_service[$l]) ? $charge_category_sub_ansi_med_service[$l] : "&nbsp;" ;
                    $msa_str = isset($charge_category_sub_ansi_amount[$l]) ? $charge_category_sub_ansi_amount[$l] : "&nbsp;" ;
                    $l++;
                    $ms_str = isset($charge_category_sub_ansi_med_service[$l]) ? $ms_str." + ".$charge_category_sub_ansi_med_service[$l]." + " : $ms_str."&nbsp;" ;
                    $msa_str = isset($charge_category_sub_ansi_amount[$l]) ? $msa_str."+".$charge_category_sub_ansi_amount[$l]."+" : $msa_str."" ;
                    $charge_content = $charge_content."<tr><td id='item_svc'>$ms_str</td><td align='right' id='item_amount'>$msa_str</td></tr>";
                    $l++;
                    $catcnt++;
                }
            }

            if($flag_with_rehab == 1){
                // ancillary header
                $charge_content = $charge_content."<tr><td ><b style='color:green;'>REHABILITATION & PT:</td><td align='right'>&nbsp;</td></tr>"; $catcnt++;
                // get contents
                $l=0;
                while( $l < count($charge_category_sub_rehab_med_service) ){
                    $ms_str = isset($charge_category_sub_rehab_med_service[$l]) ? $charge_category_sub_rehab_med_service[$l] : "&nbsp;" ;
                    $msa_str = isset($charge_category_sub_rehab_amount[$l]) ? $charge_category_sub_rehab_amount[$l] : "&nbsp;" ;
                    $l++;
                    $ms_str = isset($charge_category_sub_rehab_med_service[$l]) ? $ms_str." + ".$charge_category_sub_rehab_med_service[$l]." + " : $ms_str."&nbsp;" ;
                    $msa_str = isset($charge_category_sub_rehab_amount[$l]) ? $msa_str."+".$charge_category_sub_rehab_amount[$l]."+" : $msa_str."" ;
                    $charge_content = $charge_content."<tr><td id='item_svc'>$ms_str</td><td align='right' id='item_amount'>$msa_str</td></tr>";
                    $l++;
                    $catcnt++;
                }
            }
        }

        $listleftcnt = 14 - $catcnt; 
        for($llc=0;$llc<=$listleftcnt;$llc++){
            $charge_content = $charge_content."<tr><td ><b style='color:green;'>&nbsp;</td><td align='right'>&nbsp;</td></tr>";
        }

        //$charge_content = $charge_content."<tr><td ><b style='color:green;'>UTZ:</td><td align='right'>$utz_value</td></tr>";
        //$charge_content = $charge_content."<tr><td ><b style='color:green;'>XRAY:</td><td align='right'>$xray_value</td></tr>";
        //$charge_content = $charge_content."<tr><td ><b style='color:green;'>ANCILLARY:</td><td align='right'>$ancillary_value</td></tr>";

        //echo $hb->prepared_by;
        $print = str_replace("[procedure_box]",$procedure_box,$print);
        $print = str_replace("[procedure_sub_box]",$procedure_sub_box,$print);
        $print = str_replace("[laboratory_box]",$laboratory_box,$print);
        $print = str_replace("[laboratory_sub_box]",$laboratory_sub_box,$print);

        $profile=Yii::app()->getModule('user')->user()->profile; 
        $prepared_by = $hb->prepared_by;
        if( $prepared_by == "" || $prepared_by == null) {               
            $prepared_by = $profile->first_name.' '.$profile->last_name;
        }
        $print = str_replace("[prepared_by]",$prepared_by,$print);

        $print = str_replace("[charge_content]",$charge_content,$print);
        if($consamount == "") { $consamount = "&nbsp;"; }
        $print = str_replace("[consultation]",$consamount,$print);
        $print = str_replace("[procedure_content]",$procedure_content,$print);

        //var_dump($hf->hmo_billing_id);
        //var_dump($hb->by_userid);
        $string_image = "";
        $reference_id = 0;
        if($hb->by_userid != null && $hb->by_userid != ""){
            $rfid = $hb->by_userid;
        }else{
            $rfid = $profile->user_id;
        }
        //var_dump($reference_id);
        switch($rfid){
            case 5: $string_image = "theena"; break;
            case 13: $string_image = "joy"; break;
            case 41: $string_image = "dianne"; break;
            case 67: $string_image = "ruth"; break;
            case 33: $string_image = "love"; break;
            case 72: $string_image = "erica"; break;
            case 1: 
            default: $string_image = "love"; break;
        }

        if(trim($string_image) != "") {
            $signature = 'http://'.$_SERVER["HTTP_HOST"]."/images/billing_officer/".$string_image.".png";
            $print = str_replace("[signature]",$signature,$print);
            $print = str_replace("[display_signature]","",$print);
        }else{
            $print = str_replace("[display_signature]","display:none;",$print);
        }

        if($hfi->double_transaction_tag != 0){
            $hfid = HmoFormItems::model()->findByPk((int)$hfi->double_transaction_tag);
            $charge_fee_final = (int)$hfi->charge_fee + (int)$hfid->charge_fee;
            $print = str_replace("[total_amount]",number_format($charge_fee_final,2),$print);
        }else{
            $print = str_replace("[total_amount]",number_format($hfi->charge_fee,2),$print);
        }

        if($svctyp == "APE") {
            $print = str_replace("[procedure_or_ape]",$svctyp ,$print);
        }else{
            $print = str_replace("[procedure_or_ape]","PROCEDURE",$print);
        }
        $print = str_replace("[elementid]",$id,$print);

        return $print;

    }
}
