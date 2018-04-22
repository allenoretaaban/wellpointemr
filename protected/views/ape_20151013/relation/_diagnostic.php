<?php
  
$diagnostic = ApeDiagnostic::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$diagnostic[0]->ape_id; 
?>
<style type="text/css">   
.diagnosticTable{
    width:100%;
    border-collapse:collapse;
    border:1px solid black;
}           
.diagnosticTable .diagnosticTableHead{  
    text-align: center;      
    font-weight:bold;    
}   
.diagnosticTable tr td{   
    padding-left:5px;
    padding-right:5px; 
    border:1px solid black;
}
.diagnosticTable tr td input[type="text"]{       
    text-align: center;
    border: none;
    border-bottom:black 1px solid;
} 
    
.center{         
    text-align:center;      
} 
.left{         
    text-align:left;      
}  
.bold{               
    font-weight: bold;      
}
</style>               
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(              
    'id'=>'ape-diagnostic-form',       
    //'action'=>'/ape/diagnosticUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<table class="diagnosticTable">     
    <tr class="center bold">                                         
        <td colspan="5"><h2>Diagnostic Results / Interpretation</h2></td>
    </tr>       
    <tr class="center bold">                                                                 
        <td ></td>  
        <td>Normal</td>                                 
        <td >Clinically Insignificant Findings</td>  
        <td >Abnormal</td>          
        <td >Details</td>          
    </tr>        
    <tr class="center bold">                                                                 
        <td class="left">1. CBC</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"cbc_n",  
        array('checked'=>$diagnostic[0]->cbc_n)); ?></td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"cbc_cif",  
        array('checked'=>$diagnostic[0]->cbc_cif)); ?></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"cbc_ab",  
        array('checked'=>$diagnostic[0]->cbc_ab)); ?></td>    
        <td ><?php echo $form->textField($diagnostic[0],"cbc_details",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>      
    <tr class="center bold">                                                                 
        <td class="left">2. Urinalysis</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"u_n",  
        array('checked'=>$diagnostic[0]->u_n)); ?></td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"u_cif",  
        array('checked'=>$diagnostic[0]->u_cif)); ?></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"u_ab",  
        array('checked'=>$diagnostic[0]->u_ab)); ?></td>    
        <td ><?php echo $form->textField($diagnostic[0],"u_details",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>     
    <tr class="center bold">                                                                 
        <td class="left">3. Stool Exam</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"se_n",  
        array('checked'=>$diagnostic[0]->se_n)); ?></td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"se_cif",  
        array('checked'=>$diagnostic[0]->se_cif)); ?></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"se_ab",  
        array('checked'=>$diagnostic[0]->se_ab)); ?></td>    
        <td ><?php echo $form->textField($diagnostic[0],"se_details",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>     
    <tr class="center bold">                                                                 
        <td class="left">4. Chest X-ray</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"cx_n",  
        array('checked'=>$diagnostic[0]->cx_n)); ?></td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"cx_cif",  
        array('checked'=>$diagnostic[0]->cx_cif)); ?></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"cx_ab",  
        array('checked'=>$diagnostic[0]->cx_ab)); ?></td>    
        <td ><?php echo $form->textField($diagnostic[0],"cx_details",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>  
    <tr class="center bold">                                                                 
        <td class="left">5. HbsAg</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"hbsag_nr",  
        array('checked'=>$diagnostic[0]->hbsag_nr)); ?> Non reactive</td> 
        <td ></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"hbsag_r",  
        array('checked'=>$diagnostic[0]->hbsag_r)); ?> Reactive</td>    
        <td ></td>          
    </tr> 
    <tr class="center bold">                                                                 
        <td class="left">&nbsp;&nbsp;&nbsp;Anti-HBs</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"antihbs_n",  
        array('checked'=>$diagnostic[0]->antihbs_n)); ?> Negative</td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"antihbs_p",  
        array('checked'=>$diagnostic[0]->antihbs_p)); ?> Positive</td>   
        <td ></td>    
        <td ></td>          
    </tr> 
    <tr class="center bold">                                                                 
        <td class="left">6. Drug Test</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"dt_n",  
        array('checked'=>$diagnostic[0]->dt_n)); ?> Negative</td> 
        <td ></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"dt_p",  
        array('checked'=>$diagnostic[0]->dt_p)); ?> Positive</td>    
        <td class="left" ><?php echo $form->checkBox($diagnostic[0],"dt_marijuana",  
        array('checked'=>$diagnostic[0]->dt_marijuana)); ?> Marijuana (Cannabis)</td>          
    </tr> 
    <tr class="center bold">           
        <td ></td>    
        <td ></td>          
        <td ></td>          
        <td ></td>          
        <td class="left"><?php echo $form->checkBox($diagnostic[0],"dt_shabu",  
        array('checked'=>$diagnostic[0]->dt_shabu)); ?> Shabu (Amphetamine)</td>          
    </tr>  
    <tr class="center bold">                                                                 
        <td class="left">7. Pregnancy Test</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"pt_n",  
        array('checked'=>$diagnostic[0]->pt_n)); ?> Negative</td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"pt_p",  
        array('checked'=>$diagnostic[0]->pt_p)); ?> Positive</td>   
        <td ></td>    
        <td ></td>          
    </tr>     
    <tr class="center bold">                                                                 
        <td class="left">8. Audiometry</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"am_n",  
        array('checked'=>$diagnostic[0]->am_n)); ?></td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"am_cif",  
        array('checked'=>$diagnostic[0]->am_cif)); ?></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"am_ab",  
        array('checked'=>$diagnostic[0]->am_ab)); ?></td>    
        <td class="left"><?php echo $form->checkBox($diagnostic[0],"am_chl",  
        array('checked'=>$diagnostic[0]->am_chl)); ?> Conductive Hearing Loss
        <?php echo $form->textField($diagnostic[0],"chl",  
        array('style'=>"width:224px;")); ?></td>          
    </tr> 
    <tr class="center bold">                                                                 
        <td ></td>                       
        <td ></td>                       
        <td ></td>                       
        <td ></td>                       
        <td class="left"><?php echo $form->checkBox($diagnostic[0],"am_shl",  
        array('checked'=>$diagnostic[0]->am_shl)); ?> Sensorineural Hearing Loss
        <?php echo $form->textField($diagnostic[0],"shl",  
        array('style'=>"width:199px;")); ?></td>          
    </tr>       
    <tr class="center bold">                                                                 
        <td class="left">9. 12 Lead ECG</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"lecg_n",  
        array('checked'=>$diagnostic[0]->lecg_n)); ?></td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"lecg_cif",  
        array('checked'=>$diagnostic[0]->lecg_cif)); ?></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"lecg_ab",  
        array('checked'=>$diagnostic[0]->lecg_ab)); ?></td>    
        <td ><?php echo $form->textField($diagnostic[0],"lecg_details",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>   
    <tr class="center bold">                                                                 
        <td class="left">10. Ultrasound</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"us_n",  
        array('checked'=>$diagnostic[0]->us_n)); ?></td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"us_cif",  
        array('checked'=>$diagnostic[0]->us_cif)); ?></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"us_ab",  
        array('checked'=>$diagnostic[0]->us_ab)); ?></td>    
        <td class="left"><?php echo $form->checkBox($diagnostic[0],"us_so",  
        array('checked'=>$diagnostic[0]->us_so)); ?> Specify organs:
        <?php echo $form->textField($diagnostic[0],"so1",  
        array('style'=>"width:299px;")); ?></td>          
    </tr>   
    <tr class="center bold"> 
        <td></td>                                                                
        <td></td>                                                                
        <td></td>                                                                
        <td></td>         
        <td ><?php echo $form->textField($diagnostic[0],"so2",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>  
    <tr class="center bold">                                                                 
        <td class="left">11. Blood Chemistry</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"bc_n",  
        array('checked'=>$diagnostic[0]->bc_n)); ?></td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"bc_cif",  
        array('checked'=>$diagnostic[0]->bc_cif)); ?></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"bc_ab",  
        array('checked'=>$diagnostic[0]->bc_ab)); ?></td>    
        <td class="left"><?php echo $form->checkBox($diagnostic[0],"bc_st",  
        array('checked'=>$diagnostic[0]->bc_st)); ?> Specify test(s):
        <?php echo $form->textField($diagnostic[0],"st1",  
        array('style'=>"width:294px;")); ?></td>          
    </tr>    
    <tr class="center bold"> 
        <td></td>                                                                
        <td></td>                                                                
        <td></td>                                                                
        <td></td>         
        <td ><?php echo $form->textField($diagnostic[0],"st2",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>  
    <tr class="center bold">                                                                 
        <td class="left">12. Others</td>                                 
        <td ><?php echo $form->checkBox($diagnostic[0],"others_n",  
        array('checked'=>$diagnostic[0]->others_n)); ?></td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"others_cif",  
        array('checked'=>$diagnostic[0]->others_cif)); ?></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"others_ab",  
        array('checked'=>$diagnostic[0]->others_ab)); ?></td>    
        <td ><?php echo $form->textField($diagnostic[0],"others_details1",  
        array('style'=>"width:100%;")); ?></td>          
    </tr> 
    <tr class="center bold"> 
        <td></td>                                                                
        <td></td>                                                                
        <td></td>                                                                
        <td></td>         
        <td ><?php echo $form->textField($diagnostic[0],"others_details2",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>  
    <tr class="center bold"> 
        <td></td>                                                                
        <td></td>                                                                
        <td></td>                                                                
        <td></td>         
        <td ><?php echo $form->textField($diagnostic[0],"others_details3",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>
    <tr class="center bold">                                                     
        <td class="left">13. Papsmear</td>                                
        <td ><?php echo $form->checkBox($diagnostic[0],"papsmear_n",  
        array('checked'=>$diagnostic[0]->papsmear_n)); ?></td> 
        <td ><?php echo $form->checkBox($diagnostic[0],"papsmear_cif",  
        array('checked'=>$diagnostic[0]->papsmear_cif)); ?></td>   
        <td ><?php echo $form->checkBox($diagnostic[0],"papsmear_ab",  
        array('checked'=>$diagnostic[0]->papsmear_ab)); ?></td>  
        <td ><?php echo $form->textArea($diagnostic[0],"papsmear",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>             
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="diag_submit" value="Save" class="ajaxBtn">  
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">
</p> 

<?php $this->endWidget(); ?>
    
    </div>