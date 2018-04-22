<?php

class InvoiceItemController extends RController
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
		$model=new InvoiceItem;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['InvoiceItem']))
		{
			    $model->attributes=$_POST['InvoiceItem'];
                $model->invoice_id=$_GET['id'];                         
                if (is_numeric($model->discountflat) && is_numeric($model->discountpercentage))
                {
                        $discountflat=floatval($model->discountflat);
                        $discountpercentage=floatval($model->discountpercentage);
                        $amount=floatval($model->amount);
                        $total=floatval(0);
                        
                        if ($discountflat > 0 && $discountpercentage > 0)
                                throw new CHttpException(400,'Invalid request. Please specify either one flat or percentage discount.');
                        else
                        {
                                if ($discountflat > 0)
                                        $total=$amount - $discountflat;
                                else
                                {
                                        if ($discountpercentage > 0)
                                            $total=$amount - ($amount * ($discountpercentage/100.00));
                                        else
                                            $total=$amount;
                                }
                        }
                        $model->total=number_format($total, 2, '.', '');
                } else
                        throw new CHttpException(400,'Invalid request. Flat or percentage discount should be a number.');
		        if($model->save())
				        $this->redirect(array('invoice/compute','id'=>$model->invoice_id));
		} else
                {
                        $model->discountflat=number_format(0, 2);
                        $model->discountpercentage=number_format(0, 2);
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

		if(isset($_POST['InvoiceItem']))
		{
			    $model->attributes=$_POST['InvoiceItem'];                     
                if (is_numeric($model->discountflat) && is_numeric($model->discountpercentage))
                {
                    $discountflat=floatval($model->discountflat);
                    $discountpercentage=floatval($model->discountpercentage);
                    $amount=floatval($model->amount);
                    $total=floatval(0);
                    
                    if ($discountflat > 0 && $discountpercentage > 0)
                            throw new CHttpException(400,'Invalid request. Please specify either one flat or percentage discount.');
                    else
                    {
                            if ($discountflat > 0)
                                    $total=$amount - $discountflat;
                            else
                            {
                                    if ($discountpercentage > 0)
                                        $total=$amount - ($amount * ($discountpercentage/100.00));
                                    else
                                        $total=$amount;
                            }
                    }
                    $model->total=number_format($total, 2, '.', '');
                } else
                        throw new CHttpException(400,'Invalid request. Flat or percentage discount should be a number.');
			    if($model->save())                                      
                        $this->redirect(array('invoice/compute','id'=>$model->invoice_id));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
    
    public function actionItemdelete($id)
    {
            $todel = InvoiceItem::model()->findByPk($id);
            $todelete = $todel->invoice_id;
            
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

             $this->redirect(array('invoice/compute','id'=>$todelete));      
        
      
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('InvoiceItem');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new InvoiceItem('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InvoiceItem']))
			$model->attributes=$_GET['InvoiceItem'];

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
		$model=InvoiceItem::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-item-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
