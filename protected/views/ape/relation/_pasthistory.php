<?php
  
$pasthistory = ApeMh1Pastdisease::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$pasthistory[0]->ape_id; 
?>
<style type="text/css">   
.pastHistoryTable{
    width:100%;       
}    
.pastHistoryTable tr td{   
    padding-left:3%;
    padding-right:3px;   
    width:33.33%;
    vertical-align:top;
}
.pastHistoryTable tr td input[type="text"]{  
    width:100%;
    text-align: center;
    border: none;
    border-bottom:black 1px solid;
}  
.onethird{
    width:33.33% !important;
}
.onefifth{
    width:10% !important;
}
</style>               
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(        
    'id'=>'ape-pasthistory-form',
    //'action'=>'/ape/pastHistoryUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<table class="pastHistoryTable">     
    <tr>
        <td colspan="5"><b>Do you have or had in the past any of the following(Please Check)?</b></td>     
    </tr>          
    <tr><td>&nbsp;</td></tr>     
    <tr>
        <td><?php echo $form->checkBox($pasthistory[0],"is_fhm",  
        array('checked'=>$pasthistory[0]->is_fhm)); ?> Frequent Headache/Migraine</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_cd",  
        array('checked'=>$pasthistory[0]->is_cd)); ?> Constipation/diarrhea</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_bt",  
        array('checked'=>$pasthistory[0]->is_bt)); ?> Bleeding tendency</td>    
    </tr>      
    <tr>
        <td><?php echo $form->checkBox($pasthistory[0],"is_lc",  
        array('checked'=>$pasthistory[0]->is_lc)); ?> Loss of Consciousness</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_ap",  
        array('checked'=>$pasthistory[0]->is_ap)); ?> Abdominal pains</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_spcl",  
        array('checked'=>$pasthistory[0]->is_spcl)); ?> Skin problem/cysts/lumps</td>    
    </tr>    
    <tr>
        <td><?php echo $form->checkBox($pasthistory[0],"is_dbp",  
        array('checked'=>$pasthistory[0]->is_dbp)); ?> Dizziness/Balance Problem</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_gopd",  
        array('checked'=>$pasthistory[0]->is_gopd)); ?> Genital organ problems/discharges</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_etb",  
        array('checked'=>$pasthistory[0]->is_etb)); ?> Exposure to tuberculosis</td>    
    </tr>      
    <tr>
        <td><?php echo $form->checkBox($pasthistory[0],"is_wpnt",  
        array('checked'=>$pasthistory[0]->is_wpnt)); ?> Weakness/paralysis/numbness/tremors</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_a",  
        array('checked'=>$pasthistory[0]->is_a)); ?> Accidents</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_la",  
        array('checked'=>$pasthistory[0]->is_la)); ?> Loss of appetite</td>    
    </tr>    
    <tr>
        <td><?php echo $form->checkBox($pasthistory[0],"is_bvep",  
        array('checked'=>$pasthistory[0]->is_bvep)); ?> Blurring of vision/Eye problem</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_etoaw",  
        array('checked'=>$pasthistory[0]->is_etoaw)); ?> Easily tires on ordinary activity/walking</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_wlwg",  
        array('checked'=>$pasthistory[0]->is_wlwg)); ?> Weight loss/weight gain</td>    
    </tr>      
    <tr>
        <td><?php echo $form->checkBox($pasthistory[0],"is_hdep",  
        array('checked'=>$pasthistory[0]->is_hdep)); ?> Hearing defect/Ear problem</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_cphp",  
        array('checked'=>$pasthistory[0]->is_cphp)); ?> Chest pain/heaviness/palpitations</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_sp",  
        array('checked'=>$pasthistory[0]->is_sp)); ?> Sleeping problems</td>    
    </tr>    
    <tr>
        <td><?php echo $form->checkBox($pasthistory[0],"is_fstcs",  
        array('checked'=>$pasthistory[0]->is_fstcs)); ?> Frequent sore throat/colds/sneezing</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_yes",  
        array('checked'=>$pasthistory[0]->is_yes)); ?> Yellowing of eyes/skin</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_nd",  
        array('checked'=>$pasthistory[0]->is_nd)); ?> Nervousness/depression</td>    
    </tr>      
    <tr>
        <td><?php echo $form->checkBox($pasthistory[0],"is_pcsb",  
        array('checked'=>$pasthistory[0]->is_pcsb)); ?> Persistent cough/shortness of breath</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_hbbs",  
        array('checked'=>$pasthistory[0]->is_hbbs)); ?> Hemorrhoids/bloody or black stool</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_al",  
        array('checked'=>$pasthistory[0]->is_al)); ?> Allergy:<br>
        <?php echo $form->textArea($pasthistory[0],"al",array('style'=>'width:100%;')); ?></td>    
    </tr>    
    <tr>
        <td><?php echo $form->checkBox($pasthistory[0],"is_fbpr",  
        array('checked'=>$pasthistory[0]->is_fbpr)); ?> Frequent blood pressure reading at 140/90 or higher</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_fsjs",  
        array('checked'=>$pasthistory[0]->is_fsjs)); ?> Feet swelling/joint swelling</td>
        <td><?php echo $form->checkBox($pasthistory[0],"is_oc",  
        array('checked'=>$pasthistory[0]->is_oc)); ?> Others complaints<br>
        <?php echo $form->textArea($pasthistory[0],"oc",array('style'=>'width:100%;')); ?></td>    
    </tr>      
    <tr>
        <td><?php echo $form->checkBox($pasthistory[0],"is_up",  
        array('checked'=>$pasthistory[0]->is_up)); ?> Urination problem</td>          
    </tr>   
</table>
<hr/>
<table class="pastHistoryTable">    
    <tr>     
        <td></td>
        <td></td>
        <td></td>
    </tr>      
    <tr>     
        <td colspan="2">
        <?php echo $form->checkBox($pasthistory[0],"is_hpidhs",  
        array('checked'=>$pasthistory[0]->is_hpidhs)); ?> History of past illness/diagnosis/hospitalization/surgery
        </td>
        <td colspan="1">&nbsp;</td>
    </tr>        
    <tr style="text-align: center; font-weight: bold;">             
        <td colspan="1" class="onefifth">Year</td>               
        <td colspan="2">Reason/Diagnosis</td>  
    </tr>
    <tr>             
        <td colspan="1" class="onefifth"><?php echo $form->textField($pasthistory[0],"year1"); ?></td>               
        <td colspan="2"><?php echo $form->textField($pasthistory[0],"year1_rd"); ?></td>
    </tr>
    <tr>             
        <td colspan="1" class="onefifth"><?php echo $form->textField($pasthistory[0],"year2"); ?></td>               
        <td colspan="2"><?php echo $form->textField($pasthistory[0],"year2_rd"); ?></td>    
    </tr>
</table>
    
<br/>         
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="mh1_submit" value="Save" class="ajaxBtn"> 
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">
</p> 

<?php   


$this->endWidget(); ?>

</div>