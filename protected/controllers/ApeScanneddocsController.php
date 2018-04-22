<?php

class ApeScanneddocsController extends RController
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
		$model=new ApeScanneddocs;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model); 
		if(isset($_POST['ApeScanneddocs']))
		{
			$model->attributes=$_POST['ApeScanneddocs'];
            $model->ape_id = $_GET['id'];        
            $model->user_id = Yii::app()->user->id;        
            $model->username = Yii::app()->user->name;   
            $model->update_datetime = date("Y-m-d H:i:s");  
            $model->date_uploaded = date("Y-m-d H:i:s");  
			if($model->save())                                        
                $model->file=CUploadedFile::getInstance($model,'file');
                if ($model->file!=null)
                {
                    $folder_name = 'images/ape_scanned_documents';
                    if(!file_exists($folder_name)){
                        mkdir($folder_name, 0777, true);
                    }
                    $model->filepath=$folder_name.'/scanned_'.$model->id.'.'.$model->file->extensionName;
                    $model->filename='scanned_'.$model->id.'.'.$model->file->extensionName;
                    $model->file->saveAs($model->filepath);
                } else{
                    $model->filepath='images/ape_scanned_documents/noimage.png';
                    $model->filename='noimage.png';
                }
                $_POST['ApeScanneddocs']['file'] = $_FILES['ApeScanneddocs'];
                $this->saveApeLogs($model->ape_id, $model->id, "APE Scanned Docs", "Created", json_encode($_POST['ApeScanneddocs'])); 
                
                $model->save();
                                                                                
				$this->redirect(array('ape/view','id'=>$model->ape_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
      
    public function saveApeLogs($ape_id, $id, $ape_section, $details,$changes){    
        $ape_logs = new ApeLogs();   
        $ape_logs->ape_id = $ape_id;  
        $ape_logs->ape_section = $ape_section;          
        $ape_logs->user_id = Yii::app()->user->id;
        $ape_logs->username = Yii::app()->user->name;
        $ape_logs->update_datetime = date("Y-m-d H:i:s");                                         
        $ape_logs->details = ucwords(Yii::app()->user->name)." had ". $details." ".$ape_section. " ".$id;
        $ape_logs->changes = $changes;
        $ape_logs->save();
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

		if(isset($_POST['ApeScanneddocs']))
		{
			$model->attributes=$_POST['ApeScanneddocs'];         
            $model->user_id = Yii::app()->user->id;        
            $model->username = Yii::app()->user->name;   
            $model->update_datetime = date("Y-m-d H:i:s");            
            $model->file=CUploadedFile::getInstance($model,'file');
            if ($model->file!=null)
            {
                $folder_name = 'images/ape_scanned_documents';
                if(!file_exists($folder_name)){
                    mkdir($folder_name, 0777, true);
                }
                $model->filepath=$folder_name.'/scanned_'.$model->id.'.'.$model->file->extensionName;
                $model->filename='scanned_'.$model->id.'.'.$model->file->extensionName;
                $model->file->saveAs($model->filepath);
            }
        
            $_POST['ApeScanneddocs']['file'] = $_FILES['ApeScanneddocs'];
            $this->saveApeLogs($model->ape_id, $model->id, "APE Scanned Docs", "Updated", json_encode($_POST['ApeScanneddocs']));   
			if($model->save())                                    
                $this->redirect(array('ape/view','id'=>$model->ape_id));
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
        $this->saveApeLogs($this->loadModel($id)->ape_id, $model->id, "APE Scanned Docs", "Deleted", '{"removed":"true"}');   
		$this->loadModel($id)->delete();                                                        
            
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ApeScanneddocs');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ApeScanneddocs('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ApeScanneddocs']))
			$model->attributes=$_GET['ApeScanneddocs'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ApeScanneddocs the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ApeScanneddocs::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ApeScanneddocs $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ape-scanneddocs-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
