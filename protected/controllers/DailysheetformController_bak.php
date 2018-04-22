<?php

class DailysheetformController extends RController
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
		$model=new Dailysheetform;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

        $profile=Yii::app()->getModule('user')->user()->profile;

		if(isset($_POST['Dailysheetform']))
		{
			$model->attributes=$_POST['Dailysheetform'];
            $model->preparedby=$profile->first_name.' '.$profile->last_name;
			if($model->save())
                $this->redirect(array('compute','id'=>$model->id));
		} else
        {
            $model->date=date('Y-m-d');
            $model->preparedby=$profile->first_name.' '.$profile->last_name;
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

		if(isset($_POST['Dailysheetform']))
		{
			$model->attributes=$_POST['Dailysheetform'];
			if($model->save())
                $this->redirect(array('compute','id'=>$model->id));
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
		$model=new Dailysheetform('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Dailysheetform']))
			$model->attributes=$_GET['Dailysheetform'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionCompute()
    {
        $model=Dailysheetform::model()->findByPk($_GET['id']);

        $total=0;
        $total=$total+($model->denomination1000*1000);
        $total=$total+($model->denomination500*500);
        $total=$total+($model->denomination200*200);
        $total=$total+($model->denomination100*100);
        $total=$total+($model->denomination50*50);
        $total=$total+($model->denomination20*20);
        $total=$total+($model->denomination10*10);
        $total=$total+($model->denomination5*5);
        $total=$total+($model->denomination1);
        $total=$total+($model->denomination50c*0.5);
        $total=$total+($model->denomination25c*0.25);
        $total=$total+($model->denomination10c*0.1);
        $total=$total+($model->denomination5c*0.05);

        $model->total=number_format($total, 2, '.', '');;
        $model->save();

        $this->redirect(array('view','id'=>$model->id));
    }

    public function actionPrint()
    {
        $dailysheetform=Dailysheetform::model()->findByPk($_GET['id']);
        $print = implode("", file(Yii::app()->getBasePath().'\views\dailysheetform\include\dailysheet.htm'));
        $logo = Yii::app()->request->baseUrl.'/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logo]",$logo,$print);
        $date = date('F d, Y', strtotime($dailysheetform->date));
        $print =str_replace("{date}",$date,$print);
        $print =str_replace("{beginningcash}",$dailysheetform->beginningcash,$print);
        $print =str_replace("{supervisor}",$dailysheetform->supervisorname,$print);
        $print =str_replace("{preparedby}",$dailysheetform->preparedby,$print);
        $print =str_replace("{1000qty}",$dailysheetform->denomination1000,$print);
        $print =str_replace("{500qty}",$dailysheetform->denomination500,$print);
        $print =str_replace("{200qty}",$dailysheetform->denomination200,$print);
        $print =str_replace("{100qty}",$dailysheetform->denomination100,$print);
        $print =str_replace("{50qty}",$dailysheetform->denomination50,$print);
        $print =str_replace("{20qty}",$dailysheetform->denomination20,$print);
        $print =str_replace("{10qty}",$dailysheetform->denomination10,$print);
        $print =str_replace("{5qty}",$dailysheetform->denomination5,$print);
        $print =str_replace("{1qty}",$dailysheetform->denomination1,$print);
        $print =str_replace("{50cqty}",$dailysheetform->denomination50c,$print);
        $print =str_replace("{25cqty}",$dailysheetform->denomination25c,$print);
        $print =str_replace("{10cqty}",$dailysheetform->denomination10c,$print);
        $print =str_replace("{5cqty}",$dailysheetform->denomination5c,$print);
        $print =str_replace("{1000amt}",number_format($dailysheetform->denomination1000*1000,2),$print);
        $print =str_replace("{500amt}",number_format($dailysheetform->denomination500*500,2),$print);
        $print =str_replace("{200amt}",number_format($dailysheetform->denomination200*200,2),$print);
        $print =str_replace("{100amt}",number_format($dailysheetform->denomination100*100,2),$print);
        $print =str_replace("{50amt}",number_format($dailysheetform->denomination50*50,2),$print);
        $print =str_replace("{20amt}",number_format($dailysheetform->denomination20*20,2),$print);
        $print =str_replace("{10amt}",number_format($dailysheetform->denomination10*10,2),$print);
        $print =str_replace("{5amt}",number_format($dailysheetform->denomination5*5,2),$print);
        $print =str_replace("{1amt}",number_format($dailysheetform->denomination1,2),$print);
        $print =str_replace("{50camt}",number_format($dailysheetform->denomination50c*0.5,2),$print);
        $print =str_replace("{25camt}",number_format($dailysheetform->denomination25c*0.25,2),$print);
        $print =str_replace("{10camt}",number_format($dailysheetform->denomination10c*0.1,2),$print);
        $print =str_replace("{5camt}",number_format($dailysheetform->denomination5c*0.05,2),$print);
        $print =str_replace("{cohtotal}",$dailysheetform->total,$print);
        $print =str_replace("{verifiedby}",$dailysheetform->verifiedby,$print);
        $print =str_replace("{beginningcash}",$dailysheetform->beginningcash,$print);
        $print =str_replace("{beginningcash}",$dailysheetform->beginningcash,$print);
        //init
        $dcashsubtotal=0;
        $pxscensus = array(
            "Laboratory" => 0,
            "Ancillary" => 0,
            "Consultation" => 0,
        );
        $incsummary = array(
            'Laboratory' => 0.0,
            'Ancillary' => 0.0,
            'Consultation' => 0.0,
            'O.R. Use' => 0.0,
            'E.R. Use' => 0.0,
            'Medical Certificate' => 0.0,
            'Annual Package A' => 0.0,
            'Annual Package B' => 0.0,
            'Annual Package C' => 0.0,
            'Gold Card' => 0.0,
            'Silver Card' => 0.0,
            'Bronze Card' => 0.0,
            'Basic Priviledge' => 0.0,
            'Premium Package' => 0.0,
            'Pre-Natal' => 0.0,
            'Medicine/Vaccine' => 0.0,
            'Other' => 0.0,
        );
        //invoice
        $invoices=Invoice::model()->findAllByAttributes(array('date'=>$dailysheetform->date));
        $invsubtotal=0;
        $invtotal=0;
        $invoiceitemsPrint = "";
        foreach ($invoices as $invoice)
        {
            if ($invoice != null)
            {
                if ($invoice->invoiceItems != null)
                {
                    foreach ($invoice->invoiceItems as $invoiceItem)
                    {
                        $invoiceitemsPrint = $invoiceitemsPrint . "<tr>";
                        $invoiceitemsPrint = $invoiceitemsPrint . "<td width=109 valign=top style='width:81.9pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:normal'><span style='font-size:10.0pt'>";
                        $invoiceitemsPrint = $invoiceitemsPrint . $invoice->id;
                        $invoiceitemsPrint = $invoiceitemsPrint . "</span></p></td>";
                        $invoiceitemsPrint = $invoiceitemsPrint . "<td width=396 valign=top style='width:297.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:normal'><span style='font-size:10.0pt'>";
                        $invoiceitemsPrint = $invoiceitemsPrint . $invoiceItem->description;
                        $invoiceitemsPrint = $invoiceitemsPrint . "</span></p></td>";
                        $invoiceitemsPrint = $invoiceitemsPrint . "<td width=132 valign=top style='width:99.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;text-align:right;line-height:normal'><span style='font-size:10.0pt'>";
                        $invoiceitemsPrint = $invoiceitemsPrint . number_format($invoiceItem->total,2);
                        $invoiceitemsPrint = $invoiceitemsPrint . "</span></p></td>";
                        $invoiceitemsPrint = $invoiceitemsPrint . "</tr>";
                        $productservice=Productservice::model()->find('name=:d',array(':d'=>$invoiceItem->description));
                        if($productservice!=null)
                        {
                            if($productservice->provider=="Laboratory")
                            {
                                $pxscensus['Laboratory']++;
                                $incsummary['Laboratory']=$incsummary['Laboratory']+$invoiceItem->total;
                            } else if($productservice->provider=="Ancillary")
                            {
                                $pxscensus['Ancillary']++;
                                $incsummary['Ancillary']=$incsummary['Ancillary']+$invoiceItem->total;
                            } else if($productservice->provider=="Consultation")
                            {
                                $pxscensus['Consultation']++;
                                $incsummary['Consultation']=$incsummary['Consultation']+$invoiceItem->total;
                            } else if($productservice->provider=="O.R. Use")
                                $incsummary['O.R. Use']=$incsummary['O.R. Use']+$invoiceItem->total;
                            else if($productservice->provider=="E.R. Use")
                                $incsummary['E.R. Use']=$incsummary['E.R. Use']+$invoiceItem->total;
                            else if($productservice->provider=="Medical Certificate")
                                $incsummary['Medical Certificate']=$incsummary['Medical Certificate']+$invoiceItem->total;
                            else if($productservice->provider=="Annual Package A")
                                $incsummary['Annual Package A']=$incsummary['Annual Package A']+$invoiceItem->total;
                            else if($productservice->provider=="Annual Package B")
                                $incsummary['Annual Package B']=$incsummary['Annual Package B']+$invoiceItem->total;
                            else if($productservice->provider=="Annual Package C")
                                $incsummary['Annual Package C']=$incsummary['Annual Package C']+$invoiceItem->total;
                            else if($productservice->provider=="Gold Card")
                                $incsummary['Gold Card']=$incsummary['Gold Card']+$invoiceItem->total;
                            else if($productservice->provider=="Silver Card")
                                $incsummary['Silver Card']=$incsummary['Silver Card']+$invoiceItem->total;
                            else if($productservice->provider=="Bronze Card")
                                $incsummary['Bronze Card']=$incsummary['Bronze Card']+$invoiceItem->total;
                            else if($productservice->provider=="Premium Package")
                                $incsummary['Premium Package']=$incsummary['Premium Package']+$invoiceItem->total;
                            else if($productservice->provider=="Basic Priviledge")
                                $incsummary['Basic Priviledge']=$incsummary['Basic Priviledge']+$invoiceItem->total;
                            else if($productservice->provider=="Pre-Natal")
                                $incsummary['Pre-Natal']=$incsummary['Pre-Natal']+$invoiceItem->total;
                            else if($productservice->provider=="Medicine/Vaccine")
                                $incsummary['Medicine/Vaccine']=$incsummary['Medicine/Vaccine']+$invoiceItem->total;
                            else
                                $incsummary['Other']=$incsummary['Other']+$invoiceItem->total;
                        }
                        $invsubtotal = $invsubtotal + $invoiceItem->total;
                    }
                }
                $invtotal = $invtotal + $invoice->total;
            }
        }
        $print = str_replace("{invitems}",$invoiceitemsPrint,$print);
        $print = str_replace("{invsubtotal}",number_format($invsubtotal,2),$print);
        $print = str_replace("{invtotal}",number_format($invtotal,2),$print);
        $dcashsubtotal = $dcashsubtotal + $invtotal;
        //cash voucher
        $cashvouchers=Cashvoucher::model()->findAllByAttributes(array('date'=>$dailysheetform->date));
        $exptotal=0;
        $cashvoucherPrint = "";
        if($cashvouchers!=null)
        {
            foreach ($cashvouchers as $cashvoucherItem)
            {
                $cashvoucherPrint = $cashvoucherPrint . "<tr>";
                $cashvoucherPrint = $cashvoucherPrint . "<td width=505 valign=top style='width:381pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:normal'><span style='font-size:10.0pt'>";
                $cashvoucherPrint = $cashvoucherPrint . $cashvoucherItem->description;
                $cashvoucherPrint = $cashvoucherPrint . "</span></p></td>";
                $cashvoucherPrint = $cashvoucherPrint . "<td width=133 valign=top style='width:110pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;text-align:right;line-height:normal'><span style='font-size:10.0pt'>";
                $cashvoucherPrint = $cashvoucherPrint . number_format($cashvoucherItem->amount,2);
                $cashvoucherPrint = $cashvoucherPrint . "</span></p></td>";
                $cashvoucherPrint = $cashvoucherPrint . "</tr>";
                $exptotal = $exptotal + $cashvoucherItem->amount;
            }
        }
        $print = str_replace("{expitems}",$cashvoucherPrint,$print);
        $print = str_replace("{exptotal}",number_format($exptotal,2),$print);
        $dcashsubtotal = $dcashsubtotal + $exptotal;
        //deposit
        $deposits=Deposit::model()->findAllByAttributes(array('date'=>$dailysheetform->date));
        $depositmf=0.0;
        $depositjf=0.0;
        $deposithmo=0.0;
        $depositother=0.0;
        $depositPrint = "";
        if($deposits!=null)
        {
            foreach ($deposits as $deposit)
            {
                if($deposit->category=="MF")
                    $depositmf = $depositmf + $deposit->amount;
                if($deposit->category=="JF")
                    $depositjf = $depositjf + $deposit->amount;
                if($deposit->category=="HMO")
                    $deposithmo = $deposithmo + $deposit->amount;
                if($deposit->category=="Other")
                    $depositother = $depositother + $deposit->amount;
            }
        }
        $print = str_replace("{dcashsubtotal}",number_format($dcashsubtotal,2),$print);
        $print = str_replace("{dmfsubtotal}",number_format($depositmf,2),$print);
        $print = str_replace("{djfsubtotal}",number_format($depositjf,2),$print);
        $print = str_replace("{dhmosubtotal}",number_format($deposithmo,2),$print);
        $print = str_replace("{dotherstotal}",number_format($depositother,2),$print);
        $print = str_replace("{dtotal}",number_format($dcashsubtotal+$depositmf+$depositjf+$deposithmo+$depositother,2),$print);
        //census
        $print = str_replace("{lcash}",$pxscensus['Laboratory'],$print);
        $print = str_replace("{acash}",$pxscensus['Ancillary'],$print);
        $print = str_replace("{ccash}",$pxscensus['Consultation'],$print);
        $print = str_replace("{pxscashtotal}",$pxscensus['Laboratory']+$pxscensus['Ancillary']+$pxscensus['Consultation'],$print);
        $print = str_replace("{lhmo}",$dailysheetform->hmocensus_laboratory,$print);
        $print = str_replace("{ahmo}",$dailysheetform->hmocensus_ancillary,$print);
        $print = str_replace("{chmo}",$dailysheetform->hmocensus_consultation,$print);
        $print = str_replace("{pxshmototal}",$dailysheetform->hmocensus_laboratory+$dailysheetform->hmocensus_ancillary+$dailysheetform->hmocensus_consultation,$print);
        $print = str_replace("{opxstotal}",$pxscensus['Laboratory']+$pxscensus['Ancillary']+$pxscensus['Consultation']+$dailysheetform->hmocensus_laboratory+$dailysheetform->hmocensus_ancillary+$dailysheetform->hmocensus_consultation,$print);
        //income
        $incsummaryPrint = "";
        foreach ($incsummary as $key => $incdetail)
        {
                $incsummaryPrint = $incsummaryPrint . "<tr>";
                $incsummaryPrint = $incsummaryPrint . "<td width=505 valign=top style='width:381pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:normal'><span style='font-size:10.0pt'>";
                $incsummaryPrint = $incsummaryPrint . $key;
                $incsummaryPrint = $incsummaryPrint . "</span></p></td>";
                $incsummaryPrint = $incsummaryPrint . "<td width=132 valign=top style='width:110pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'><p class=MsoNormal align=right style='margin-bottom:0in;margin-bottom:.0001pt;text-align:right;line-height:normal'><span style='font-size:10.0pt'>";
                $incsummaryPrint = $incsummaryPrint . number_format($incdetail,2);
                $incsummaryPrint = $incsummaryPrint . "</span></p></td>";
                $incsummaryPrint = $incsummaryPrint . "</tr>";
        }
        $print = str_replace("{incsummary}",$incsummaryPrint,$print);
        $print = str_replace("{incsubtotal}",number_format($invsubtotal,2),$print);
        $print = str_replace("{inctotal}",number_format($invtotal,2),$print);
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
		$model=Dailysheetform::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='dailysheetform-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
