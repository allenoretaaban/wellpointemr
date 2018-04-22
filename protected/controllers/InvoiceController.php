<?php

class InvoiceController extends RController
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
		$model=new Invoice;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                $profile=Yii::app()->getModule('user')->user()->profile;

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
            $model->subtotal=number_format(0, 2);
            $model->vatexemptsale=number_format(0, 2);
            $model->total=number_format(0, 2);
            $model->preparedby=$profile->first_name.' '.$profile->last_name;
            $model->patient_id=$_GET['id'];
            $patient = Patient::model()->findByPk($model->patient_id);
                        $model->patientname=$patient->firstname.' '.$patient->lastname;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		} else
                {
                        if (!$_GET)
                            $this->redirect(array('select'));
                        else
                            $model->date=date('Y-m-d');
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

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$model=new Invoice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice']))
			$model->attributes=$_GET['Invoice'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionSelect()
    {
        $this->render('select',array());
    }

    public function actionCompute()
    {
        $model=Invoice::model()->findByPk($_GET['id']);

        $subtotal=floatval(0);
        $vatexemptsale=floatval(0);
        foreach ($model->invoiceItems as $invoiceItem)
        {
            if ($invoiceItem->isvatable)
                $subtotal=$subtotal+floatval($invoiceItem->total);
            else
                $vatexemptsale=$vatexemptsale+floatval($invoiceItem->total);
        }

        $temp_subtotal=$subtotal;
        $temp_vatexemptsale=$vatexemptsale;

        $subtotal_discount =0;
        $subtotal_vat = 0;
        
        $vatexemptsale_discount = 0;
        
        foreach ($model->invoiceDiscounts as $invoiceDiscount)
        {
            $flat=floatval($invoiceDiscount->flat);
            $percentage=floatval($invoiceDiscount->percentage);
            /*var_dump($flat);
            var_dump($percentage);
            return;         */
            
            if ($flat > 0 && $percentage > 0)
                throw new CHttpException(400,'Invalid request. Please specify either one flat or percentage discount.');
            else
            {
                if ($flat > 0)
                {
                    if ($subtotal > 0){
                            $subtotal_discount =  $subtotal_discount + $flat;
                            $temp_subtotal = $temp_subtotal - $flat;
                    }
                    
                    if ($temp_vatexemptsale > 0){  
                        $vatexemptsale_discount = $vatexemptsale_discount + $flat;
                        $temp_vatexemptsale=$temp_vatexemptsale - $flat;
                    }
                }else{
                    if ($percentage > 0)
                    {
                         if ($subtotal > 0){
                              $subtotal_discount =  $subtotal_discount + ($temp_subtotal * ($percentage/100.00)); 
                              $temp_subtotal = $temp_subtotal - ($temp_subtotal * ($percentage/100.00));
                         }    
                         if ($temp_vatexemptsale > 0){  
                            $vatexemptsale_discount = $vatexemptsale_discount + ($temp_vatexemptsale * ($percentage/100.00));
                            $temp_vatexemptsale=$temp_vatexemptsale - ($temp_vatexemptsale * ($percentage/100.00));
                         }
                    }
                }
            }
        }

        $subtotal_vat = $temp_subtotal * 0.12;
        $total=($temp_subtotal * 1.12) + $temp_vatexemptsale;

        $model->subtotal_discount = number_format($subtotal_discount, 2, '.', '');
        $model->vatexemptsale_discount = number_format($vatexemptsale_discount, 2, '.', '');
        $model->subtotal_vat = number_format($subtotal_vat, 2, '.', '');
        
        $model->subtotal=number_format($subtotal, 2, '.', '');
        $model->vatexemptsale=number_format($vatexemptsale, 2, '.', '');
        $model->total=number_format($total, 2, '.', '');
        $model->save();

        $this->redirect(array('invoice/view','id'=>$_GET['id']));
    }

    public function actionPrint()
    {
        $invoice = Invoice::model()->findByPk($_GET['id']);
        $print = implode("", file(Yii::app()->getBasePath().'/views/invoice/include/invoice.htm'));
        $logo = Yii::app()->request->baseUrl.'/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logo]",$logo,$print);
        $print = str_replace("[id]",$invoice->id,$print);
        $date = date('F d, Y', strtotime($invoice->date));
        $print = str_replace("[date]",$date,$print);
        $print = str_replace("[orno]",$invoice->orno,$print);
        $print = str_replace("[patientname]",$invoice->patientname,$print);
        $print = str_replace("[subtotal]",number_format($invoice->subtotal,2),$print);
        $print = str_replace("[subtotal_discount]",$invoice->subtotal_discount,$print);
        
        $print = str_replace("[vatexemptsale]",$invoice->vatexemptsale,$print);
        $print = str_replace("[total]",$invoice->total,$print);
        $print = str_replace("[preparedby]",$invoice->preparedby,$print);
        // invoice items
        $description = "";
        $isvatable = "";
        $amount = "";
        foreach ($invoice->invoiceItems as $invoiceItem)
        {
            if ($description != "")
                $description = $description . "<br/>";
            $description = $description . $invoiceItem->description;

            if ($isvatable != "")
                $isvatable = $isvatable . "<br/>";
            if ($invoiceItem->isvatable == "0")
                $isvatable = $isvatable . "No";
            else
                $isvatable = $isvatable . "Yes";

            if ($amount != "")
                $amount = $amount . "<br/>";
            $amount = $amount . number_format($invoiceItem->total,2);
        }
        $print = str_replace("[description]",$description,$print);
        $print = str_replace("[isvatable]",$isvatable,$print);
        $print = str_replace("[amount]",$amount,$print);
        // discount
        $discount = "";
        $discountvalue = "";
        foreach ($invoice->invoiceDiscounts as $invoiceDiscount)
        {
            if ($discount != "")
                $discount = $discount . "<br/>";
            $discount = $discount . $invoiceDiscount->description;
            if ($discountvalue != "")
                $discountvalue = $discountvalue . "<br/>";
            if ($invoiceDiscount->flat == "0")
                $discountvalue = $discountvalue . $invoiceDiscount->percentage . "%";
            else
                $discountvalue = $discountvalue . "-" . $invoiceDiscount->flat;
        }
        if ($discount != "" && $discountValue != "")
        {
            $print = str_replace("[discount]","Discount:",$print);
            $print = str_replace("[discountvalue]","None",$print);
        } else
        {
            $print = str_replace("[discount]",$discount,$print);
            $print = str_replace("[discountvalue]",$discountvalue,$print);
        }
        echo $print;
        exit;
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Invoice::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
