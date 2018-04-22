<style>
h3{
    color:#008000;
}
</style>
<div class="form">

<?php 
    $diagTemp="";
    $patientid="";

    
        if(!$_POST["patientval"]){            
            $patientid = $_POST["DiagUrinalysis"]['patient_id'];
        }else{
            list($patientname, $patientno) = explode("|",$_POST["patientval"]);
            list($dum, $patientid) = explode(":",$patientno);
        }
        
        $diagTemp = Yii::app()->db->createCommand()
            ->select('*')
            ->from('patient')    
            ->where('id=:id', array(':id'=>$patientid))
            ->queryRow();
    
    $form=$this->beginWidget('CActiveForm', array(
	    'id'=>'diag-urinalysis-form',
	    'enableAjaxValidation'=>false,
    ));
    
    //fullpatient name
    $fullpatientname = $diagTemp['lastname'].',';
    $fullpatientname .= ' '.trim($diagTemp['firstname']);
    if(trim($diagTemp['middleinitial']) != ''){$fullpatientname .= ' '.trim($diagTemp['middleinitial']);}
    
    $birthday_timestamp = strtotime($diagTemp["birthdate"]);  
    $age = date('md', $birthday_timestamp) > date('md') ? date('Y') - date('Y', $birthday_timestamp) - 1 : date('Y') - date('Y', $birthday_timestamp);
    $sex = trim($diagTemp['gender']);
?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
    
	<?php echo $form->errorSummary($model); ?>
    
    <hr>
    
	<!--div class="row">
		<?php //echo $form->labelEx($model,'id'); ?>
		<?php //echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
		<?php //echo $form->error($model,'id'); ?>
	</div-->
    
	<div class="row">
		<?php echo $form->labelEx($model,'datereceived'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'datereceived',
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
                                    'yearRange'=>'1900'
                                )
                            ),
                            true
                        );
                ?>
		<?php echo $form->error($model,'datereceived'); ?>
	</div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'datereleased'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'datereleased',
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
                                    'yearRange'=>'1900'
                                )
                            ),
                            true
                        );
                ?>
        <?php echo $form->error($model,'datereleased'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250,'value'=>strtoupper($fullpatientname),'readonly'=>'readonly')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'age'); ?>
		<?php echo $form->textField($model,'age',array('value'=>$age,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'age'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->textField($model,'sex',array('size'=>60,'maxlength'=>250,'value'=>$sex,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'requesting_physician'); ?>
		<?php echo $form->textField($model,'requesting_physician',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'requesting_physician'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sp_no'); ?>
		<?php echo $form->textField($model,'sp_no',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'sp_no'); ?>
	</div>

    <hr >        
    <div class="row">
        <h3 style="width:90%;">Physical Characteristics</h3>
    </div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'pc_color'); ?>
		<?php echo $form->textField($model,'pc_color',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'pc_color'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pc_tranparency'); ?>
		<?php echo $form->textField($model,'pc_tranparency',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'pc_tranparency'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pc_specific_gravity'); ?>
		<?php echo $form->textField($model,'pc_specific_gravity',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'pc_specific_gravity'); ?>
	</div>

    <hr >        
    <div class="row">
        <h3 style="width:90%;">Chemical Characteristics</h3>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'cc_ph'); ?>
		<?php echo $form->textField($model,'cc_ph',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cc_ph'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cc_sugar'); ?>
		<?php echo $form->textField($model,'cc_sugar',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cc_sugar'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cc_protein'); ?>
		<?php echo $form->textField($model,'cc_protein',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'cc_protein'); ?>
	</div>

    <hr >        
    <div class="row">
        <h3 style="width:90%;">Microscopic</h3>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'m_puscell'); ?>
		<?php echo $form->textField($model,'m_puscell',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'m_puscell'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'m_rbc'); ?>
		<?php echo $form->textField($model,'m_rbc',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'m_rbc'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'m_epitelial_cells'); ?>
		<?php echo $form->textField($model,'m_epitelial_cells',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'m_epitelial_cells'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'m_mucus_threads'); ?>
		<?php echo $form->textField($model,'m_mucus_threads',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'m_mucus_threads'); ?>
	</div>

    <hr >        
    <div class="row">
        <h3 style="width:90%;">Crystals</h3>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_amorph_urates'); ?>
		<?php echo $form->textField($model,'c_amorph_urates',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'c_amorph_urates'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_amorph_phosphates'); ?>
		<?php echo $form->textField($model,'c_amorph_phosphates',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'c_amorph_phosphates'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_uric_acid'); ?>
		<?php echo $form->textField($model,'c_uric_acid',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'c_uric_acid'); ?>
	</div>

        <div class="row">
            <?php echo $form->labelEx($model,'c_triple_phospate'); ?>
            <?php echo $form->textField($model,'c_triple_phospate',array('size'=>60,'maxlength'=>250)); ?>
            <?php echo $form->error($model,'c_triple_phospate'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'c_calcium_oxalate'); ?>
		<?php echo $form->textField($model,'c_calcium_oxalate',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'c_calcium_oxalate'); ?>
	</div>

        <hr >     

	<div class="row">
		<?php echo $form->labelEx($model,'bacteria'); ?>
		<?php echo $form->textField($model,'bacteria',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'bacteria'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'casts'); ?>
		<?php echo $form->textField($model,'casts',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'casts'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pregnancy_test'); ?>
		<?php echo $form->textField($model,'pregnancy_test',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'pregnancy_test'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'others'); ?>
		<?php echo $form->textArea($model,'others',array('cols'=>45,'rows'=>3,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'others'); ?>
	</div>
    
        <hr>

	<div class="row">
		<?php echo $form->labelEx($model,'med_tech'); ?>
		<?php echo $form->textField($model,'med_tech',array('size'=>60,'maxlength'=>200,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'med_tech'); ?>
	</div>

        <div class="row">
            <?php echo $form->labelEx($model,'licenseno'); ?>
            <?php echo $form->textField($model,'licenseno',array('size'=>20,'maxlength'=>20,'readonly'=>'readonly')); ?>
            <?php echo $form->error($model,'licenseno'); ?>
        </div>

	<div class="row">
		<?php echo $form->labelEx($model,'pathologist'); ?>
		<?php echo $form->textField($model,'pathologist',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'pathologist'); ?>
	</div>

	<div class="row" style="display:none;">
		<?php echo $form->labelEx($model,'patient_id'); ?>
                <input type="hidden" name="DiagUrinalysis[patient_id]" value="<?=$patientid ?>">
		<?php echo $form->textField($model,'patient_id',array('size'=>20,'maxlength'=>20,'value'=>$patientid)); ?>
		<?php echo $form->error($model,'patient_id'); ?>
	</div>
    
    <div class="row" style="display:none;">
        <input type="hidden" name="DiagUrinalysis[datecreated]" value="<?= date("Y-m-d h:m:s")?>">        
    </div>
 
    
    <hr>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::link(CHtml::button('Cancel'),array('diagurinalysis/admin'),array('style'=>'text-decoration:none;')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
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