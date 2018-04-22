<?php
  
$socialhistory = ApeMh3Socialhistory::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$socialhistory[0]->ape_id; 
?>
<style type="text/css">   
.socialHistoryTable{
    width:100%;
}           
.socialHistoryTable .socialHistoryTableHead{    
    font-weight:bold;    
}   
.socialHistoryTable tr td{   
    padding-left:3px;
    padding-right:3px;
}
.socialHistoryTable tr td input[type="text"]{  
    width: 100%;
    text-align: center;
    border: none;
    border-bottom:black 1px solid;
}
</style>               
<div class="form">
<?php     
$form=$this->beginWidget('CActiveForm', array(        
    'id'=>'ape-socialhistory-form',
    //'action'=>'/ape/socialHistoryUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); 


?>
<table class="socialHistoryTable">                
    <tr class="socialHistoryTableHead">                                        
        <td>Smoking</td>                        
        <td>Drinking</td>
    </tr>                    
    <tr>                                                         
        <td><?php echo $form->checkBox($socialhistory[0],"smoking_no",  
        array('checked'=>$socialhistory[0]->smoking_no)); ?> No</td>
        <td><?php echo $form->checkBox($socialhistory[0],"drinking_no",  
        array('checked'=>$socialhistory[0]->drinking_no)); ?> No</td>
    </tr>                   
    <tr>                                                                   
        <td><?php echo $form->checkBox($socialhistory[0],"smoking_yes",  
        array('checked'=>$socialhistory[0]->smoking_yes)); ?> Yes    
        <?php echo $form->textField($socialhistory[0],"spd",  
        array("style"=>"width:35px;","maxlength"=>"3")); ?>    (sticks/packs) per day</td> 
        <td><?php echo $form->checkBox($socialhistory[0],"drinking_yes",  
        array('checked'=>$socialhistory[0]->drinking_yes)); ?> Yes </td>
        <td><?php echo $form->checkBox($socialhistory[0],"is_occassional",  
        array('checked'=>$socialhistory[0]->is_occassional)); ?> Occasional </td>
    </tr>                    
    <tr>
        <td><?php echo $form->checkBox($socialhistory[0],"smoking_stopped",  
        array('checked'=>$socialhistory[0]->smoking_stopped)); ?> Stopped since 
        <?php echo $form->textField($socialhistory[0],"n",  
        array("style"=>"width:35px;","maxlength"=>"3")); ?>             
        <?php echo $form->checkBox($socialhistory[0],"is_month",  
        array('checked'=>$socialhistory[0]->is_month)); ?> mons.
        <?php echo $form->checkBox($socialhistory[0],"is_year",  
        array('checked'=>$socialhistory[0]->is_year)); ?> yrs. Ago
        </td>         
        <td>&nbsp;</td>                                                  
        <td><?php echo $form->checkBox($socialhistory[0],"is_weekly",  
        array('checked'=>$socialhistory[0]->is_weekly)); ?> Weekly </td>   
        <td><?php echo $form->checkBox($socialhistory[0],"is_beer",  
        array('checked'=>$socialhistory[0]->is_beer)); ?> Beer </td>        
        <td><?php echo $form->textField($socialhistory[0],"shots_n",  
        array("style"=>"width:35px;","maxlength"=>"3")); ?>
        <?php echo $form->checkBox($socialhistory[0],"is_shots",  
        array('checked'=>$socialhistory[0]->is_shots)); ?> shots/session </td>
        <td>
        <?php echo $form->checkBox($socialhistory[0],"is_intoxication",  
        array('checked'=>$socialhistory[0]->is_intoxication)); ?> Intoxication </td>
    </tr>                 
    <tr>
        <td>&nbsp;</td>         
        <td>&nbsp;</td>                                                  
        <td>&nbsp;</td>   
        <td><?php echo $form->checkBox($socialhistory[0],"is_gin",  
        array('checked'=>$socialhistory[0]->is_gin)); ?> Spirits/Gin </td>        
        <td><?php echo $form->textField($socialhistory[0],"bottles_n",  
        array("style"=>"width:35px;","maxlength"=>"3")); ?>
        <?php echo $form->checkBox($socialhistory[0],"is_bottles",  
        array('checked'=>$socialhistory[0]->is_bottles)); ?> bottles/session </td>
        <td>
        <?php echo $form->checkBox($socialhistory[0],"is_nointoxication",  
        array('checked'=>$socialhistory[0]->is_nointoxication)); ?> No intoxication </td>
    </tr>              
    <tr>
        <td>&nbsp;</td>         
        <td>&nbsp;</td>                                                  
        <td>&nbsp;</td>   
        <td><?php echo $form->checkBox($socialhistory[0],"is_wine",  
        array('checked'=>$socialhistory[0]->is_wine)); ?> Wine </td>        
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>    
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="mh3_submit" value="Save" class="ajaxBtn">  
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">
</p> 

<?php $this->endWidget(); ?>
    
    </div>