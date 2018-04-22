<?php
list($patientname, $patientno) = explode("|",$_POST["patientval"]);
list($dum, $patientid) = explode(":",$patientno);
list($tempid, $temptitle) = explode("|",$_POST["diagtemp"]);


$patient = Yii::app()->db->createCommand()
    ->select('*')
    ->from('patient')    
    ->where('id=:id', array(':id'=>$patientid))
    ->queryRow();
//getage
$birthday_timestamp = strtotime($patient["birthdate"]);  

$age = date('md', $birthday_timestamp) > date('md') ? date('Y') - date('Y', $birthday_timestamp) - 1 : date('Y') - date('Y', $birthday_timestamp);
/*if (date('md', $birthday_timestamp) > date('md') ){
    $age = strtotime(date('Y-m-d')) - $birthday_timestamp;
    $age = date('m', $age) / 10;    
}else{
  $age  = date('Y') - date('Y', $birthday_timestamp); 
} */ 
//gender
($patient["gender"] == "M")? $gender="Male" : $gender = "Female";

?>

<form method="post" action="<?= Yii::app()->createAbsoluteUrl('AddDiagResult/Addresult/SaveDiagResult',array()) ?>" onsubmit="return submitThis();">
<input type="hidden" name="patientid" value="<?= $patientid?>" />
<input type="hidden" name="patientname" value="<?= $patientname?>" />
<input type="hidden" name="age" value="<?= $age ?>" />
<input type="hidden" name="gender" value="<?= $gender?>" />
<input type="hidden" name="diagTempId" value="<?= $tempid ?>" />
<input type="hidden" name="diagTempTitle" value="<?= $temptitle ?>" />

<div style="margin-top:10px;margin-bottom:20px;font-size:16px;">
    <div>Create Result <span style='color:blue;font-weight:bold'>"<?= strtoupper($temptitle) ?>"</span> </div>
    <br/>
    <b>For Patient</b>
    <table>
        <tr>
            <td>Name:</td>
            <td><span style='color:blue;font-weight:bold'><?= strtoupper($patientname) ?></span></td>
        </tr>
        <tr>
            
            <td>Age:</td>            
            <td><span style='color:blue;font-weight:bold'><?= $age ?></span></td>
        </tr>
        <tr>
            <td>Gender:</td>

            <td><span style='color:blue;font-weight:bold'><?= $gender ?></span></td>
        </tr>
    
    </table>
</div>

<?php

$model=DiagTemps::model()->findByPk((int)$tempid);
$content_format = $model->content_format;
$profile=Yii::app()->getModule('user')->user()->profile;  
$user_personalname = $profile->first_name." ".$profile->last_name ;
$profile = Yii::app()->getModule('user')->user()->profile;
$licenseno = $profile->licenseno;
$content_format = str_replace("[user_personalname]",strtoupper($user_personalname),$content_format);;
$content_format = str_replace("[user_joblicenseno]",strtoupper($licenseno),$content_format);;
$content_format = str_replace("[date_released]",date("Y-m-d"),$content_format);;
$model->__set("content_format",$content_format);

//$content_format = str_replace("[user_personname]",$user_personname,$content_format);;

        Yii::import('ext.krichtexteditor.KRichTextEditor');
        $this->widget('KRichTextEditor', array(
            'model' => $model,
            'value' => "",
            'attribute' => 'content_format',            
            'options' => array(
                'width' => '612',
                'height' => '750',                
                'plugins' => 'table',
                'theme_advanced_resizing' => 'true',
                'theme_advanced_statusbar_location' => 'bottom',
                'theme_advanced_buttons1' => "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect,|,hr,table",
            ),
        ));
?>
<br/>
<input type="submit" value="    COMMIT & SAVE THIS RESULT    " />

<script>
submitThis = function(){
    if (confirm("Are you sure you want to save this result? \r\n You will need an Administrator to edit this once saved."))
    {           
        return true;
    }else{
        return false;
    }    
}
</script>