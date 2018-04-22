<?php

class MedicalstatusController extends RController
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
				'actions'=>array('create','update','lookup'),
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
		$model=new Medicalstatus;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Medicalstatus']))
		{
			$model->attributes=$_POST['Medicalstatus'];
			if($model->save())
				$this->redirect(array('admin'));
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

		if(isset($_POST['Medicalstatus']))
		{
			$model->attributes=$_POST['Medicalstatus'];
			if($model->save())
				$this->redirect(array('admin'));
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
		if(!Yii::app()->request->isPostRequest)
                {
                        if(isset($_GET['id']))
                                $id = $_GET['id'];
                        else
                                throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
                }
                
                $model=$this->loadModel($id);

                $model->delete();

                // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                if(!isset($_GET['ajax']))
                        $this->redirect(array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Medicalstatus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Medicalstatus']))
			$model->attributes=$_GET['Medicalstatus'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionLookup()
        {
                if(!Yii::app()->request->isAjaxRequest)
                        throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));

                $term=$_GET['term'];

                $criteria=new CDbCriteria;
                $criteria->compare('name',$term,true);
                $criteria->order='name';
                $criteria->limit=10;

                $models=Medicalstatus::model()->findAll($criteria);
                $returnArray=array();
                foreach($models AS $model)
                {
                        $returnArray[]=array(
                                'label'=>CHtml::encode($model->name),
                                'value'=>CHtml::encode($model->name),
                                'id'=>(int)$model->id,
                        );
                }
                echo CJSON::encode($returnArray);
                Yii::app()->end();
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Medicalstatus::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='medicalstatus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
