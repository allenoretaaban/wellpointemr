<div class="form"  name="hmoitems_doctor">

    <?php
        $flash_error = Yii::app()->user->getFlash('error_doctor');
        if($flash_error){
            echo '<div class="errorSummary" style="padding:5px 7px 10px 7px!important;"><p>Please fix the following input errors:</p><ul>';
            foreach($flash_error as $key=>$message){
                echo '<li class="flash-' . $key . '">' . $message . "</li>";
            }
            echo '</ul></div>';
            $cv = Yii::app()->user->getFlash('cv');
            $model->attributes = $cv;
        }

        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'hmo-form-items-form',
            'enableAjaxValidation'=>false,
        ));

        $this->menu=array(
            array('label'=>'Back to Form Items', 'url'=>array('hmoForm/view/', 'id'=>$_GET['id'])),
        );
    ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->hiddenField($model,'hmo_form_id', array('value'=>$_GET["id"])); ?>
	</div>

	<div class="row">
		<label>Doctor's Name</label>
        <?php
            echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                    array(
                            'model'=>$model,
                            'id'=>'HmoFormItems_claim_doctor_name',
                            'name'=>'HmoFormItemsCategorySupport[claim_doctor_name]',
                            'attribute'=>'claim_doctor_name',
                            'sourceUrl'=>Yii::app()->createAbsoluteUrl('doctor/lookupfullname', array()),
                            'htmlOptions' => array("size"=>'50')
                    ),
                    true
            );
        ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'Diagnosis <font style="color:#ff0000">*</font>'); ?>
        <?php echo $form->textField($model,'diagnosis',array('size'=>60,'maxlength'=>250)); ?>
        <?php echo $form->error($model,'diagnosis'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_type'); ?>
        <?php echo $form->dropDownList($model,'service_type',array('DIAGNOSTIC'=>'Diagnostic','CONSULTATION'=>'Consultation','PROCEDURE'=>'Procedure','OTHERS'=>'Consultation/Procedure')); ?>
		<?php echo $form->error($model,'service_type'); ?>
	</div>

    <div class="row" id="services_box_doctor">
        <?php echo $form->labelEx($model,'Procedure Type <font style="color:#ff0000">*</font>'); ?>

        <?php
        echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
            array(
                'model'=>$model,
                'id'=>'med_service_doctor',
                'name'=>'HmoFormItemsCategorySupport[med_service]',
                'attribute'=>'med_service',
                'sourceUrl'=>Yii::app()->createAbsoluteUrl('HmoProductService/lookup', array()),
                'htmlOptions' => array("size"=>'50')
            ),
            true
        );
        ?>
        <?php echo $form->error($model,'med_service'); ?>
        <input type="button" name="hmo_form_items_category_doctor_add_med_service" value="&nbsp;+&nbsp;" onclick="addMedServicesDoctor()"><br>

    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'Charge Fee  <font style="color:#ff0000">*</font>'); ?>
        <input name="HmoFormItemsCategorySupport[charge_fee]" id="HmoFormItems_charge_fee_doctor" type="number" step="0.01" value="">
		<?php //echo $form->textField($model,'charge_fee'); ?>
		<?php echo $form->error($model,'charge_fee'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save'); ?>
        <?php echo $form->hiddenField($model,'hmo_items_savetype', array('value'=>2)); ?>
		<!--input type="button" name="hmo_form_items_category_doctor" value="Preview Charge Slip"-->
	</div>

    <?php
        if($cv['medical_service']){
            foreach($cv['medical_service'] as $msv){
                echo "<script>addMedServicesDoctor('".$msv."');</script>";
            }
        }
    ?>

<?php $this->endWidget(); ?>

</div><!-- form -->