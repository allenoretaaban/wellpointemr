<?php
  
$bodymassindex = ApePe1Bodymassindex::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$bodymassindex[0]->ape_id; 
?>
<style type="text/css">   
.bodymassindexTable{
    width:100%;
}           
.bodymassindexTable .bodymassindexTableHead{       
    font-weight:bold;    
}   
.bodymassindexTable tr td{   
    padding-left:3px;
    padding-right:3px;     
}
.bodymassindexTable tr td input[type="text"]{  
    border: none;
    border-bottom:black 1px solid;
}
</style>               
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(             
    'id'=>'ape-bodymassindex-form',       
    //'action'=>'/ape/bodymassindexUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<table class="bodymassindexTable">     
    <tr>                                         
        <td >     
              <table>  
                <tr>
                    <td>Height: <?php echo $form->textField($bodymassindex[0],"height_ft",
                    array("style"=>"width:100px !important;")); ?>ft. <?php echo $form->textField($bodymassindex[0],"height_in",
                    array("style"=>"width:100px !important;")); ?>in. (<?php echo $form->textField($bodymassindex[0],"height_cm",
                    array("style"=>"width:100px !important;")); ?>cm)</td>
                </tr>   
                <tr>
                    <td>Weight: <?php echo $form->textField($bodymassindex[0],"weight_lbs",
                    array("style"=>"width:100px !important;")); ?>lbs. (<?php echo $form->textField($bodymassindex[0],"weight_kg",
                    array("style"=>"width:100px !important;")); ?>kg.)
                    </td>
                </tr>
                <tr>
                    <td>
                    Body Mass Index (kg./m2): <?php echo $form->textField($bodymassindex[0],"bmi",
                    array("style"=>"width:100px !important;")); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                    Body Built: <?php echo $form->textField($bodymassindex[0],"body_built",
                    array("style"=>"width:300px !important;")); ?>
                    </td>
                </tr>
              </table>
        </td> 
        <td>
            <table>   
                <tr>
                    <td><strong>BMI Classification</strong></td>
                    <td><?php echo $form->checkBox($bodymassindex[0],"bmi_uw", array('checked'=>$bodymassindex[0]->bmi_uw)); ?> Underweight(BMI: < 18.5)</td>
                </tr> 
                <tr>
                    <td></td>
                    <td><?php echo $form->checkBox($bodymassindex[0],"bmi_n", array('checked'=>$bodymassindex[0]->bmi_n)); ?> Normal (BMI: &le; 18.5-22.9)</td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo $form->checkBox($bodymassindex[0],"bmi_ow", array('checked'=>$bodymassindex[0]->bmi_ow)); ?> Overweight(BMI: &ge; 23-24.9)</td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo $form->checkBox($bodymassindex[0],"bmi_oc1", array('checked'=>$bodymassindex[0]->bmi_oc1)); ?> ObeseClass 1 (BMI: 25 - 29.9)</td>
                </tr>
                <tr>
                    <td></td>
                    <td><?php echo $form->checkBox($bodymassindex[0],"bmi_oc2", array('checked'=>$bodymassindex[0]->bmi_oc2)); ?> ObeseClass 2(BMI: &le; 30)</td>
                </tr>
              </table>
        </td>
        </tr>  
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="pe1_submit" value="Save"  class="ajaxBtn">
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">  
</p> 

<?php $this->endWidget(); ?>
    
    </div>