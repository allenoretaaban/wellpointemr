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

        $settings = Settings::model()->findByPk(1);   
        $print = str_replace("[bacoor_address_html]",$settings->bacoor_address_html,$print);
        $print = str_replace("[dasma_address_html]",$settings->dasma_address_html,$print);
        $print = str_replace("[address]",$settings->address,$print);
        
        $print = str_replace("[logopath]",$logo,$print);
        $print = str_replace("[diagtemptitle]",strtoupper($model->result_title),$print);  
        $print = str_replace("[result_content]",$model->content_format,$print);  
        
        echo $print;
        exit;
    }
}