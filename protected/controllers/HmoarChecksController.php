<?php

class HmoarChecksController extends RController
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
		$model=new HmoarChecks;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HmoarChecks']))
		{   
            
             $model->attributes=$_POST['HmoarChecks'];
                 
             if($model->save())
                $this->redirect(array('view','id'=>$model->checkid));
            
            //validate if tally
            
            /*$tot = floatval($_POST['HmoarChecks']['check_amnt']) + floatval($_POST['HmoarChecks']['wtax_amnt']);
            if (floatval($_POST['HmoarChecks']['billed_amnt']) == $tot){          
                $_SESSION["errmsg"][] = "Amounts submitted are not equal."; $error_flag = true;   
                
            }else{
                 $model->attributes=$_POST['HmoarChecks'];
                 
                 if($model->save())
                    $this->redirect(array('view','id'=>$model->checkid));
            }                                                                                                   */
            
			
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
        
        if ($_POST){
                $model->attributes=$_POST['HmoarChecks'];
                 
                 if($model->save())
                    $this->redirect(array('view','id'=>$model->checkid));
        }
        
        //validate if tally
       /* if ($_POST){
            $tot = floatval($_POST['HmoarChecks']['check_amnt']) + floatval($_POST['HmoarChecks']['wtax_amnt']);
            if (floatval($_POST['HmoarChecks']['billed_amnt']) != $tot){          
                 $_SESSION["errmsg"][] = "Amounts submitted are not equal."; $error_flag = true;   
                
            }else{
                 $model->attributes=$_POST['HmoarChecks'];
                 
                 if($model->save())
                    $this->redirect(array('view','id'=>$model->checkid));
            }
        }               */
            

		/*if(isset($_POST['HmoarChecks']))
		{
			$model->attributes=$_POST['HmoarChecks'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->checkid));
		}             */

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
            
            //delete trnxs in chkapply
            $connection=Yii::app()->db; 
            $query = "delete from hmoar_chkapply
                        where check_id = $id";
            $command=$connection->createCommand($query);
            $res=$command->query();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    
    public function actionApply($id)
    {
            $model=$this->loadModel($id);
           $this->render('apply',array(
            'model'=>$model,
           ));
    }
    
    public function actionAppliedtrnxs($id)
    {
            $model=$this->loadModel($id);
            $this->render('applied_trnxs',array(
                        'model'=>$model,
                    ));
                
    }
    
    public function actionApplysoaselect($id)
    {                                    
		$model=$this->loadModel($id);

		if($_GET["billid"]){
			$this->render('apply_soa_selected',array(
				'model'=>$model,
			));
		}  else{
			$this->render('apply_soa_select',array(
				'model'=>$model,
			));
		}    
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('HmoarChecks');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HmoarChecks('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HmoarChecks']))
			$model->attributes=$_GET['HmoarChecks'];

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
		$model=HmoarChecks::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='hmoar-checks-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function getAppliedTotal($data,$row){
            
            $connection=Yii::app()->db;  
            $query ="select sum(paid_amnt) as totpaid
                        FROM hmoar_chkapply
                        where check_id = ".$data->checkid;
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    echo number_format($recd["totpaid"], 2);
                }
            }
    }
    
    public function customLinks($data,$row){
        echo "<div style='margin:0 0 3px 0'><a href='http://".$_SERVER["HTTP_HOST"]."/hmoarChecks/apply/".$data->checkid."'>Apply Trnxs (old)</a></div>";
        echo "<div><a href='http://".$_SERVER["HTTP_HOST"]."/hmoarChecks/Applysoaselect/".$data->checkid."'>Apply Trnxs</a></div>";
    }
    
    public function getWtaxTotal ($data,$row){
            $connection=Yii::app()->db;  
            $query ="select sum(wtax) as totwtax,
                        sum(loss) as totloss
                        FROM hmoar_chkapply
                        where check_id = ".$data->checkid;
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    echo number_format($recd["totwtax"], 2);
                }
            } 
    }
    
    public function getPatientName($data,$row){
            $hmoform = HmoForm::model()->findByPk($data->hmo_form_id);
            $patient = Patient::model()->findByPk($hmoform->patient_id);
            echo $patient->lastname. ", ".$patient->firstname.' '.$patient->middleinitial;
             
    }
    
}
