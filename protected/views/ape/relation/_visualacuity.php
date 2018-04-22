<?php
  
$visualacuity = ApePe3Visualacuity::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$visualacuity[0]->ape_id; 
?>
<style type="text/css">   
.visualacuityTable{
    width:100%;
}           
.visualacuityTable .visualacuityTableHead{  
    text-align: center;      
    font-weight:bold;    
}   
.visualacuityTable tr td{   
    padding-left:3px;
    padding-right:3px;
}
.visualacuityTable tr td input[type="text"]{       
    text-align: center;
    border: none;
    border-bottom:black 1px solid;
}
</style>               
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(        
    'id'=>'ape-visualacuity-form',
    //'action'=>'/ape/visualacuityUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<table class="visualacuityTable">     
    <tr>                                         
        <td ><b>Visual Acuity</b></td> 
        <td></td>     
        <td></td>     
        <td></td>     
    </tr>      
    <tr>                                         
        <td ></td>           
        <td ><b>Far Vision (Snellen)</b></td>           
        <td ><b>Near Vision (Jaeger)</b></td>          
        <td ><b>Color Blind Test</b></td>      
    </tr>     
    <tr>                                         
        <td ><?php echo $form->checkBox($visualacuity[0],"is_uncorrected",  
        array('checked'=>$visualacuity[0]->is_uncorrected)); ?> Uncorrected</td>           
        <td >OD 20/<?php echo $form->textField($visualacuity[0],"farvision_1_od20",  
        array('style'=>"width: 50px;")); ?> OS 20/<?php echo $form->textField($visualacuity[0],"farvision_1_os20",  
        array('style'=>"width: 50px;")); ?></td>           
        <td >ODJ <?php echo $form->textField($visualacuity[0],"nearvision_1_odj",  
        array('style'=>"width: 50px;")); ?> OSJ <?php echo $form->textField($visualacuity[0],"nearvision_1_osj",  
        array('style'=>"width: 50px;")); ?></td>          
        <td ><?php echo $form->checkBox($visualacuity[0],"is_normal",  
        array('checked'=>$visualacuity[0]->is_normal)); ?> Normal</td>      
    </tr>     
    <tr>                                         
        <td ><?php echo $form->checkBox($visualacuity[0],"is_corrected",  
        array('checked'=>$visualacuity[0]->is_corrected)); ?> Corrected</td>           
        <td >OD 20/<?php echo $form->textField($visualacuity[0],"farvision_2_od20",  
        array('style'=>"width: 50px;")); ?> OS 20/<?php echo $form->textField($visualacuity[0],"farvision_2_os20",  
        array('style'=>"width: 50px;")); ?></td>           
        <td >ODJ <?php echo $form->textField($visualacuity[0],"nearvision_2_odj",  
        array('style'=>"width: 50px;")); ?> OSJ <?php echo $form->textField($visualacuity[0],"nearvision_2_osj",  
        array('style'=>"width: 50px;")); ?></td>          
        <td ><?php echo $form->checkBox($visualacuity[0],"is_abnormal",  
        array('checked'=>$visualacuity[0]->is_abnormal)); ?> Abnormal</td>      
    </tr>  
    <tr>                                         
        <td colspan="2">&nbsp;&nbsp;&nbsp;<?php echo $form->checkBox($visualacuity[0],"is_glasses",  
        array('checked'=>$visualacuity[0]->is_glasses)); ?> Glasses&nbsp;&nbsp;&nbsp;
        <?php echo $form->checkBox($visualacuity[0],"is_contactlens",  
        array('checked'=>$visualacuity[0]->is_contactlens)); ?> Contact Lens</td>           
              
    </tr>  
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="pe3_submit" value="Save" class="ajaxBtn">  
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">
</p> 

<?php $this->endWidget(); ?>
    
    </div>