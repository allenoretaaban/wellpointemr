<div class="form" name="hmoitems_clinic">

	<?php

        $flash_error = Yii::app()->user->getFlash('error');
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
		<?php echo $form->labelEx($model,'Diagnosis <font style="color:#ff0000">*</font>'); ?>
		<?php echo $form->textField($model,'diagnosis',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'diagnosis'); ?>
	</div>

	<div class="row" id="services_box">
		<?php echo $form->labelEx($model,'Medical Service <font style="color:#ff0000">*</font>'); ?>

        <?php
            echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                array(
                    'model'=>$model,
                    'id'=>'med_service',
                    'name'=>'HmoFormItemsCategorySupport[med_service]',
                    'attribute'=>'med_service',
                    'sourceUrl'=>Yii::app()->createAbsoluteUrl('hmoProductService/lookup', array()),
                    'htmlOptions' => array("size"=>'50')
                ),
                true
            );
        ?>
		<?php echo $form->error($model,'med_service'); ?>
		<input type="button" name="hmo_form_items_category_clinic_add_med_service" value="&nbsp;+&nbsp;" onclick="addMedServices()"><br>

	</div>

	<div class="row" id="services_others_box">
		<?php echo $form->labelEx($model,'Others'); ?>
        <small>(Consultation, Procedure, Others)</small><br/>
        <input type="text" style="width:350px;" name="others_title" id="others_title">
        <input type="number" placeholder="Amount" style="width:150px;padding:0px 3px;" name="others_amount" id="others_amount" step="0.01">
		<input type="button" name="hmo_form_items_category_clinic_add_med_service" value="&nbsp;+&nbsp;" onclick="addOthersMedServices()"><br>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_type'); ?>
        <?php echo $form->dropDownList($model,'service_type',array('DIAGNOSTIC'=>'Diagnostic','CONSULTATION'=>'Consultation','APE'=>'Annual Physical Exam')); ?>
		<?php echo $form->error($model,'service_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Requesting Physician'); ?>
        <?php
        echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
            array(
                'model'=>$model,
                'id'=>'HmoFormItems_req_doctor',
                'name'=>'HmoFormItemsCategorySupport[req_doctor]',
                'attribute'=>'req_doctor',
                'sourceUrl'=>Yii::app()->createAbsoluteUrl('doctor/lookupfullname', array()),
                'htmlOptions' => array("size"=>'50')
            ),
            true
        );
        ?>
		<?php echo $form->error($model,'req_doctor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Charge Fee <font style="color:#ff0000">*</font>'); ?>
        <input name="HmoFormItemsCategorySupport[charge_fee]" id="HmoFormItems_charge_fee" type="number" step="0.01">
		<?php //echo $form->textField($model,'charge_fee'); ?>
		<?php echo $form->error($model,'charge_fee'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Save'); ?>
        <?php echo $form->hiddenField($model,'hmo_items_savetype', array('value'=>1)); ?>
<!--		<input type="button" name="hmo_form_items_category_clinic" value="Preview Charge Slip">-->
	</div>

    <?php
        if($cv['medical_service']){
            foreach($cv['medical_service'] as $msv){
                $msvArr = explode(':',$msv);
                if($msvArr[2] != 'Others'){
                    echo "<script>addMedServices('".$msv."');</script>";
                }else{
                    echo "<script>addOthersMedServices('".$msv."');</script>";
                }
            }
        }
        if($cv['medical_service_others']){
            foreach($cv['medical_service_others'] as $msvo){
                //echo "<script>addOthersMedServices('".$msvo."');</script>";
            }
        }
    ?>


	<?php $this->endWidget(); ?>

</div><!-- form -->