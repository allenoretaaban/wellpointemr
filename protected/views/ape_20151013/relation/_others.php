<?php
  
$others = ApeOthers::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$others[0]->ape_id; 
?>
<style type="text/css">   
.othersTable{
    width:100%;
    border-collapse:collapse;
    border:1px solid black;
}           
.othersTable .othersTableHead{  
    text-align: center;      
    font-weight:bold;    
}   
.othersTable tr td{   
    padding-left:5px;
    padding-right:5px; 
    border:1px solid black;  
}
.othersTable tr td input[type="text"]{       
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
    'id'=>'ape-form-others',
    //'action'=>'/ape/othersUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<table class="othersTable">     
    <tr class="center bold">                                         
        <td colspan="5"><h2>Others</h2></td>
    </tr>       
    <tr class="center bold">                                                                 
        <td style="width:100px;"></td>  
        <td></td>                                 
        <td ></td>  
        <td ></td>          
        <td ></td>          
    </tr>           
    <tr class="center bold">                                                                 
        <td class="left">Others 1.</td>                                 
        <td colspan="4">
        <?php echo $form->textArea($others[0],"others1",array('style'=>'width:100%;')); ?></td>                  
    </tr>     
    <tr class="center bold">                                                                 
        <td class="left">Others 2.</td>                                 
        <td colspan="4">
        <?php echo $form->textArea($others[0],"others2",array('style'=>'width:100%;')); ?></td>                  
    </tr>     
    <tr class="center bold">                                                                 
        <td class="left">Others 3.</td>                                 
        <td colspan="4">
        <?php echo $form->textArea($others[0],"others3",array('style'=>'width:100%;')); ?></td>                  
    </tr>     
    <tr class="center bold">                                                                 
        <td class="left">Others 4.</td>                                 
        <td colspan="4">
        <?php echo $form->textArea($others[0],"others4",array('style'=>'width:100%;')); ?></td>                  
    </tr>    
    <tr class="center bold">                                                                 
        <td class="left">Others 5.</td>                                 
        <td colspan="4">
        <?php echo $form->textArea($others[0],"others5",array('style'=>'width:100%;')); ?></td>                  
    </tr>    
    <tr class="center bold">                                                                 
        <td class="left">Others 6.</td>                                 
        <td colspan="4">
        <?php echo $form->textArea($others[0],"others6",array('style'=>'width:100%;')); ?></td>                  
    </tr>    
    <tr class="center bold">                                                                 
        <td class="left">Significant Findings</td>                                 
        <td colspan="4">
        <?php echo $form->textArea($others[0],"significant_findings",array('style'=>'width:100%;')); ?></td>                  
    </tr>    
    <tr class="center bold">                                                                 
        <td class="left">Classification</td>                                 
        <td colspan="4">
        <?php echo $form->textArea($others[0],"classification",array('style'=>'width:100%;')); ?></td>                  
    </tr>              
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="others_submit" value="Save" class="ajaxBtn">  
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">
</p> 

<?php $this->endWidget(); ?>
    
    </div>