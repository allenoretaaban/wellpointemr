<?php
  
$recommendation = ApeRecommendation::model()->findAll(array("condition"=>"ape_id = $model->id")); 
$recommendation[0]->ape_id; 
?>
<style type="text/css">   
.recommendationTable{
    width:100%;
    border-collapse:collapse;     
}           
.recommendationTable .recommendationTableHead{  
    text-align: center;      
    font-weight:bold;    
}   
.recommendationTable tr td{   
    padding-left:5px;
    padding-right:5px;   
    vertical-align:top;   
}
.recommendationTable tr td input[type="text"]{       
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
.right{         
    text-align:right;      
}  
.bold{               
    font-weight: bold;      
}
.bordered{                
    border:1px solid black;     
}
</style>               
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(        
    'id'=>'ape-form-recommendation',
    //'action'=>'/ape/recommendationUpdate',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>
<table class="recommendationTable">     
    <tr class=" bold bordered">                                         
        <td>Over-All Recommendation(s) for the Patient</td>
    </tr>         
    <tr>                                         
        <td></td>
    </tr>         
    <tr>                                         
        <td class="right">1. <?php echo $form->textArea($recommendation[0],"recommendation1",  
        array('style'=>"width:95%; text-align:left;")); ?></td>
    </tr>          
    <tr>                                         
        <td class="right">2. <?php echo $form->textArea($recommendation[0],"recommendation2",  
        array('style'=>"width:95%; text-align:left;")); ?></td>
    </tr>          
    <tr>                                         
        <td class="right">3. <?php echo $form->textArea($recommendation[0],"recommendation3",  
        array('style'=>"width:95%; text-align:left;")); ?></td>
    </tr>          
    <tr>                                         
        <td class="right">4. <?php echo $form->textArea($recommendation[0],"recommendation4",  
        array('style'=>"width:95%; text-align:left;")); ?></td>
    </tr>          
    <tr>                                         
        <td class="right">5. <?php echo $form->textArea($recommendation[0],"recommendation5",  
        array('style'=>"width:95%; text-align:left;")); ?></td>
    </tr>           
</table>
<br/>
<p style="text-align: right;  padding-right: 50px;">
<input type="submit" name="rec_submit" value="Save" class="ajaxBtn">  
<input type="button" name="mh1_submit" value="Print Front Page" onclick="window.open('print/<?=$model->id ?>','_blank')">
<input type="button" name="mh1_submit" value="Print Back Page" onclick="window.open('printBack/<?=$model->id ?>','_blank')">
</p> 

<?php $this->endWidget(); ?>
    
    </div>