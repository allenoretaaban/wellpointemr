<?php

class TemplatePreviewController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionPrint(){
        $tempid = $_GET["tempid"];
        $model = DiagTemps::model()->findByPk((int)$tempid); 
         $url = Yii::app()->getBasePath() ;
         
        $print = implode("", file(Yii::app()->getBasePath().'/modules/PrintDiagResult/includes/PrintForm.html'));
        $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';
        $print = str_replace("[logopath]",$logo,$print);
        $print = str_replace("[diagtemptitle]",strtoupper($model->result_title),$print);  
        $print = str_replace("[result_content]",$model->content_format,$print);  
        
        echo $print;
        exit;
    }
}