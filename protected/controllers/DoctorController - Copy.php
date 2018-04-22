<?php

class DoctorController extends RController
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
				'actions'=>array('view', 'lookup', 'lookupSpecialization'),
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
    
     public function actionLookup()
     {
                if(!Yii::app()->request->isAjaxRequest)
                        throw new CHttpException(400,Yii::t('app','Invalid request. Please do not repeat this request again.'));

                $term=$_GET['term'];

                $criteria=new CDbCriteria;
                $criteria->compare('firstname',$term,true);                  
                $criteria->compare('lastname',$term,true,'or');
                $criteria->compare('id',$term,true,'or');
                $criteria->order='id';
                $criteria->limit=20;

                $models=Doctor::model()->findAll($criteria);
                $returnArray=array();
                foreach($models AS $model)
                {
                        $returnArray[]=array(                                
                                'label'=>CHtml::encode($model->id.': '.$model->firstname." ".$model->lastname),
                                'value'=>CHtml::encode($model->id.': '.$model->firstname." ".$model->lastname.': '.$model->isresident),
                                'id'=>(int)$model->id,                                                                    
                        );
                }
                echo CJSON::encode($returnArray);
                Yii::app()->end();
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
		$model=new Doctor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Doctor']))
		{
			$model->attributes=$_POST['Doctor'];
                        $model->image=CUploadedFile::getInstance($model,'image');
                        if ($model->image!=null)
                        {
                            $model->filename='images/doctor_'.$model->id.'.'.$model->image->extensionName;
                            $model->image->saveAs($model->filename);
                        } else
                            $model->filename='images/noimage.png';
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

		if(isset($_POST['Doctor']))
		{
			$model->attributes=$_POST['Doctor'];
                        $model->image=CUploadedFile::getInstance($model,'image');
                        if ($model->image!=null)
                        {
                            $model->filename='images/doctor_'.$model->id.'.'.$model->image->extensionName;
                            $model->image->saveAs($model->filename);
                        }
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
		$model=new Doctor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Doctor']))
			$model->attributes=$_GET['Doctor'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionLookupSpecialization()
        {
                $model=$this->loadModel($_GET['id']);
                echo $model->specialization;
                exit;
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Doctor::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='doctor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
