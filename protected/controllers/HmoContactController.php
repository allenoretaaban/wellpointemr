<?php

class HmoContactController extends RController
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
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
                $model=$this->loadModel($id);
		$this->render('view',array(
			'model'=>$model,
                        'parent_model'=>$this->loadParentModel($model->hmo_id)
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new HmoContact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HmoContact']))
		{
			$model->attributes=$_POST['HmoContact'];
                        $model->hmo_id = $_GET['id'];
			if($model->save())
                                $this->redirect(array('hmo/view','id'=>$model->hmo_id));
		}

		$this->render('create',array(
			'model'=>$model,
                        'parent_model'=>$this->loadParentModel($_GET['id'])
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

		if(isset($_POST['HmoContact']))
		{
			$model->attributes=$_POST['HmoContact'];
			if($model->save())
                                $this->redirect(array('hmo/view','id'=>$model->hmo_id));
		}

		$this->render('update',array(
			'model'=>$model,
                        'parent_model'=>$this->loadParentModel($model->hmo_id)
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(!Yii::app()->request->isPostRequest)
                {
                        if(isset($_GET['id']))
                                $id = $_GET['id'];
                        else
                                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }
                
                $model=$this->loadModel($id);
                $hmo_id=$model->hmo_id;

                $model->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                        $this->redirect(array('hmo/view','id'=>$hmo_id));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=HmoContact::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
	public function loadParentModel($id)
	{
		$model=Hmo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='hmo-contact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
