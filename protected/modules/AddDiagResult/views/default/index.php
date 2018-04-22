<?php
session_start();
if (isset($_SESSION['errmg']))
{
    if (count($_SESSION['errmsg']) > 0){
        foreach ($_SESSION["errmsg"] as $errmsg){
            echo '<div class="error">'.$errmsg.'</div>';

        }
        $_SESSION["errmsg"] = null;
    }
}
?>

<style>
#tempid{
    padding:10px;font-size:14px;
}
.error{
    border:1px solid red;padding:10px;    width:650px;    margin-top:3px;color:red;font-weight: bold;
}
.results li{
    padding:5px;
}
</style>


<h1>Create New Diagnostic Result</h1>
<span>Choose from available Diagnostic Result Forms</span>
<br/>

<ul class="results">
    <li>
        <a href="<?= Yii::app()->createAbsoluteUrl('AddDiagResult/Addresult/BloodChemAdd',array()) ?>" >Blood Chemistry Result</a>
    </li>
    <li>
        <a href="<?= Yii::app()->createAbsoluteUrl('DiagUrinalysis',array()) ?>" >Urinalysis</a>
    </li>
    <li>
        <a href="<?= Yii::app()->createAbsoluteUrl('diagFecalysis',array()) ?>" >Fecalysis</a>
    </li>
    <li>
        <a href="<?= Yii::app()->createAbsoluteUrl('diagHematology',array()) ?>" >Hematology</a>
    </li>
    
</ul>



<br/>
<hr/>
    <b>- OR -</b>
<br/>
<br/>                


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'createresult-form',
    'action'=>'AddDiagResult/Addresult',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>                                
<span>Choose from available Diagnostic Result Templates</span>
<br/>

<div class="row">
        
        <?php 
        
        $list=CHtml::listData(DiagTemps::model()->findAll(array('order'=>'temp_title')), 'id', 'temp_title'); 
        echo CHtml::dropDownList('tempid', 'id', $list, array('empty' => '(Select a result template'));
        
        /*$model = new DiagTemps();        
        echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                            array(
                                    'model'=>$model,
                                    'attribute'=>'temp_title',
                                    'htmlOptions' => array("size"=>'50','style'=>'padding:10px;'),
                                    'sourceUrl'=>Yii::app()->createAbsoluteUrl('DiagTemps/lookup',array())
                                     
                            ),
                            true
                        );
        */
                ?>
        <input type="submit" value="  Next Step  " />
        



</div>



<?php $this->endWidget(); ?>


