<?php
session_start();
if (isset($_SESSION['errmsg']))
{
    if (count($_SESSION['errmsg']) > 0){
        foreach ($_SESSION["errmsg"] as $errmsg){
            echo '<div class="error1">'.$errmsg.'</div>';

        }
        $_SESSION["errmsg"] = null;
    }
}
?>

<style>
.error1{
    padding:5px;
    background:red;
    color:white;
}
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hmoar-checks-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'check_no'); ?>
		<?php echo $form->textField($model,'check_no',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'check_no'); ?>
	</div>

	<!--div class="row">
		<?php echo $form->labelEx($model,'check_date'); ?>
		<?php echo $form->textField($model,'check_date'); ?>
		<?php echo $form->error($model,'check_date'); ?>
	</div-->
    <div class="row">
        <?php echo $form->labelEx($model,'entry_date'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'entry_date',
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
                                    'yearRange'=>'2000'
                                )
                            ),
                            true
                        );
                ?>
        <?php echo $form->error($model,'avail_date'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'check_date'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'check_date',
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
                                    'yearRange'=>'2000'
                                )
                            ),
                            true
                        );
                ?>
        <?php echo $form->error($model,'avail_date'); ?>
    </div>

	<!--div class="row">
		<?php echo $form->labelEx($model,'check_clear_date'); ?>
		<?php echo $form->textField($model,'check_clear_date'); ?>
		<?php echo $form->error($model,'check_clear_date'); ?>
	</div-->
     
	<div class="row">
		<?php echo $form->labelEx($model,'bank_id'); ?>
		<?php //echo $form->textField($model,'bank_id'); ?>
        <?php echo $form->dropDownList($model, 'bank_id', CHtml::listData(HmoarBanks::model()->findAll(array('order'=>"bank_title asc")), 'bankid', 'bank_title')); ?>
		<?php echo $form->error($model,'bank_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hmo_id'); ?>
		<?php //echo $form->textField($model,'hmo_id'); ?>
        <?php echo $form->dropDownList($model, 'hmo_id', CHtml::listData(Hmo::model()->findAll(array('order'=>"name asc")), 'id', 'name')); ?>
		<?php echo $form->error($model,'hmo_id'); ?>
	</div>

    <div class="row">                        
        <?php echo $form->labelEx($model,'payto'); ?>
        <?php echo $form->dropDownList($model,'payto',array('WPCLINIC'=>'WellPoint Clinic','DOCTOR'=>'Doctor')); ?>
        <?php echo $form->error($model,'payto'); ?>        
    </div>
    <script type="">
     $(document).ready(function() { 
              if ($('#HmoarChecks_payto').val() == 'WPCLINIC'){
                $('#HmoarChecks_pay_doc_id').val('');                
                $('#wrap_pay_doc_id').hide();
                }else{
                    $('#wrap_pay_doc_id').show();
                }
     });
    $('#HmoarChecks_payto').change(function(e) { 
        if ($('#HmoarChecks_payto').val() == 'WPCLINIC'){
                $('#HmoarChecks_pay_doc_id').val('');                
                $('#wrap_pay_doc_id').hide();
        }else{
            $('#wrap_pay_doc_id').show();
        }
    });
    </script>

	<div class="row" id="wrap_pay_doc_id" style="display: none;">
		<?php //echo $form->labelEx($model,'pay_doc_id'); ?>
		<?php //echo $form->textField($model,'pay_doc_id'); ?>
		<?php // echo $form->error($model,'pay_doc_id'); ?>
        
        <label>Doctor Name (The claimant doctor if payable to the doctor)</label>
        <small>Search & Select: Type in a character or word to search a doctor name </small>       
        <?php 
            echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                    array(
                            'model'=>$model, 
                            'id'=>'HmoarChecks_pay_doc_name', 
                            'name'=>'HmoarChecks[pay_doc_name]',
                            'attribute'=>'pay_doc_name',
                            'sourceUrl'=>Yii::app()->createAbsoluteUrl('doctor/lookup', array()),
                            'htmlOptions' => array("size"=>'50', "onblur"=>"checkIfEmtpry(this)"),  
                            'options'=>array(
                                    'select'=>'js:function(event,ui){
                                            close();
                                            term=ui.item.value.split(":");
                                            document.getElementById("HmoarChecks_pay_doc_id").value=term[0];
                                            ui.item.value=term[1];
                                    }'                                    
                            ),

                    ),
                    true
            );
        ?>
        
        
	</div>
    <div class="row">        
        <?php echo $form->hiddenField($model,'pay_doc_id'); ?>        
    </div>   

	<div class="row">
		<?php echo $form->labelEx($model,'check_amnt'); ?>
		<?php echo $form->textField($model,'check_amnt'); ?>
		<?php echo $form->error($model,'check_amnt'); ?>
	</div>
          
	<div class="row">
		<?php echo $form->labelEx($model,'wtax_amnt'); ?>
		<?php echo $form->textField($model,'wtax_amnt'); ?>
		<?php echo $form->error($model,'wtax_amnt'); ?>
	</div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'billed_amnt'); ?>  
        <?php echo $form->textField($model,'billed_amnt'); ?>
        <?php echo $form->error($model,'billed_amnt'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'provider_xces'); ?>  
        <?php echo $form->textField($model,'provider_xces'); ?>
        <?php echo $form->error($model,'provider_xces'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'member_xces'); ?>  
        <?php echo $form->textField($model,'member_xces'); ?>
        <?php echo $form->error($model,'member_xces'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'hmo_xces'); ?>          
        <?php echo $form->textField($model,'hmo_xces'); ?>
        <br/>
        Remarks :<?php echo $form->textField($model,'hmo_xces_rem'); ?>
        <?php echo $form->error($model,'hmo_xces'); ?>
    </div>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->