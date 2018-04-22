<?php
  
$findings = ApePe4Findings::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$findings[0]->ape_id; 
?>
<style type="text/css">   
.findingsTable{
    width:100%;
}           
.findingsTable .findingsTableHead{  
    text-align: center;      
    font-weight:bold;    
}   
.findingsTable tr td{   
    padding-left:5px;
    padding-right:5px;      
}
.findingsTable tr td input[type="text"]{       
    text-align: center;
    border: none;
    border-bottom:black 1px solid;
}

.cb{
    border:1px solid black !important;
    padding: 1px;
    width: 20px;
    height: 20px;       
}
</style>  
<script>
$(document).ready(function(){      
    $('.cb').on("click",function(){
        var a = $(this).val(); 
        if(a ==""){
            $(this).val("/");
        }else if(a =="/"){
            $(this).val("X");
        } else if(a =="X"){
            $(this).val("");
        } 
    });
    
    
    $("#ape-findings-form").on("submit", function(){
        var err_flag = false;
        $('#ape-findings-form .cb').each(function(i, obj) {  
            var a = $(this).val();
            a = a.toUpperCase();
            if(a !="" && a !="X" && a !="/"){
                $(this).parent().css("color","red");     
                err_flag = true;
            }else{         
                $(this).parent().css("color","black");     
            }
            $(this).val(a);
        });         
      
        if(err_flag){
            alert("Error invalid character. use (/) for normal and (X) for abnormal findings or just leave it blank.");
        }
        return !err_flag; 
    });
});     
</script>             
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(           
    'id'=>'ape-findings-form',
    //'action'=>'/ape/findingsUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<table class="findingsTable">     
    <tr>                                         
        <td colspan="4"><b>Please indicate (/) for normal findings, (X) for abnormal findings</b></td>
    </tr>       
    <tr>                                                                 
        <td ><?php echo $form->textField($findings[0],"is_ga",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> General Appearance</td>  
        <td ><?php echo $form->textField($findings[0],"ga",  
        array('style'=>"width:100%;")); ?></td>                                 
        <td ><?php echo $form->textField($findings[0],"is_cl",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Chest / Lungs</td>  
        <td ><?php echo $form->textField($findings[0],"cl",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>  
    <tr>                                                                 
        <td ><?php echo $form->textField($findings[0],"is_eyes",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Eyes</td>  
        <td ><?php echo $form->textField($findings[0],"eyes",  
        array('style'=>"width:100%;")); ?></td>                                 
        <td ><?php echo $form->textField($findings[0],"is_breasts",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Breasts</td>  
        <td ><?php echo $form->textField($findings[0],"breasts",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>      
    <tr>                                                                 
        <td ><?php echo $form->textField($findings[0],"is_ears",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Ears</td>  
        <td ><?php echo $form->textField($findings[0],"ears",  
        array('style'=>"width:100%;")); ?></td>                                 
        <td ><?php echo $form->textField($findings[0],"is_abdomen",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Abdomen</td>  
        <td ><?php echo $form->textField($findings[0],"abdomen",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>  
    <tr>                                                                 
        <td ><?php echo $form->textField($findings[0],"is_nose",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Nose</td>  
        <td ><?php echo $form->textField($findings[0],"nose",  
        array('style'=>"width:100%;")); ?></td>                                 
        <td ><?php echo $form->textField($findings[0],"is_genital",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Genital</td>  
        <td ><?php echo $form->textField($findings[0],"genital",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>  
    <tr>                            
        <td ><?php echo $form->textField($findings[0],"is_throat",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Throat</td>  
        <td ><?php echo $form->textField($findings[0],"throat",  
        array('style'=>"width:100%;")); ?></td>                                     
        <td ><?php echo $form->textField($findings[0],"is_rectal",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Rectal</td>  
        <td ><?php echo $form->textField($findings[0],"rectal",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>
    <tr>                            
        <td ><?php echo $form->textField($findings[0],"is_mtg",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Mouth, Teeth, Gums</td>  
        <td ><?php echo $form->textField($findings[0],"mtg",  
        array('style'=>"width:100%;")); ?></td>                                     
        <td ><?php echo $form->textField($findings[0],"is_extr",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Extremities</td>  
        <td ><?php echo $form->textField($findings[0],"extr",  
        array('style'=>"width:100%;")); ?></td>          
    </tr> 
    <tr>                            
        <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $form->textField($findings[0],"is_dc",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Dental Caries</td>  
        <td ><?php echo $form->textField($findings[0],"dc",  
        array('style'=>"width:100%;")); ?></td>                                     
        <td ><?php echo $form->textField($findings[0],"is_skin",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Skin</td>  
        <td ><?php echo $form->textField($findings[0],"skin",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>   
    <tr>                            
        <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $form->textField($findings[0],"is_dentures",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Dentures</td>  
        <td ><?php echo $form->textField($findings[0],"dentures",  
        array('style'=>"width:100%;")); ?></td>                                     
        <td ><?php echo $form->textField($findings[0],"is_neu",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Neurologic</td>  
        <td ><?php echo $form->textField($findings[0],"neu",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>   
    <tr>                            
        <td ><?php echo $form->textField($findings[0],"is_neck",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Neck</td>  
        <td ><?php echo $form->textField($findings[0],"neck",  
        array('style'=>"width:100%;")); ?></td>                                     
        <td ><?php echo $form->textField($findings[0],"is_deform",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Deformity</td>  
        <td ><?php echo $form->textField($findings[0],"deform",  
        array('style'=>"width:100%;")); ?></td>          
    </tr> 
    <tr>                            
        <td ><?php echo $form->textField($findings[0],"is_heart",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Heart</td>  
        <td ><?php echo $form->textField($findings[0],"heart",  
        array('style'=>"width:100%;")); ?></td>                                     
        <td ><?php echo $form->textField($findings[0],"is_others",  
        array('class'=>"cb","maxlength"=>"1", "readonly"=>"true")); ?> Others</td>  
        <td ><?php echo $form->textField($findings[0],"others",  
        array('style'=>"width:100%;")); ?></td>          
    </tr>              
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="pe4_submit" value="Save" class="ajaxBtn">  
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">
</p> 

<?php $this->endWidget(); ?>
    
    </div>