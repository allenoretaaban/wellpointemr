<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <fieldset>
            <legend>Personal Information</legend>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model, 'image'); ?>
                        <?php echo $form->fileField($model, 'image'); ?>
                        <?php echo $form->error($model, 'image'); ?>
                </div>
            </div>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'lastname'); ?>
                        <?php echo $form->textField($model,'lastname',array('size'=>30,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'lastname'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'firstname'); ?>
                        <?php echo $form->textField($model,'firstname',array('size'=>30,'maxlength'=>64)); ?>
                        <?php echo $form->error($model,'firstname'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'middleinitial'); ?>
                        <?php echo $form->textField($model,'middleinitial',array('size'=>1,'maxlength'=>1)); ?>
                        <?php echo $form->error($model,'middleinitial'); ?>
                </div>
            </div>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'gender'); ?>
                        <?php echo $form->dropDownList($model,'gender',array('M'=>'Male','F'=>'Female')); ?>
                        <?php echo $form->error($model,'gender'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'birthdate'); ?>
                        <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                                    array(
                                        'model'=>$model,
                                        'attribute'=>'birthdate',
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
                        <?php echo $form->error($model,'birthdate'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'civilstatus'); ?>
                        <?php echo $form->dropDownList($model,'civilstatus',array('Single'=>'Single','Married'=>'Married','Widowed'=>'Widowed','Separated'=>'Separated','Divorce'=>'Divorce')); ?>
                        <?php echo $form->error($model,'civilstatus'); ?>
                </div>
                <div class="newline">
                    <div class="row line">
                            <?php echo $form->labelEx($model,'mobile_no'); ?>
                            <?php echo $form->textField($model,'mobile_no',array('size'=>20,'maxlength'=>64)); ?>
                            <?php echo $form->error($model,'mobile_no'); ?>
                    </div>
                    <div class="row line">
                            <?php echo $form->labelEx($model,'tel_no'); ?>
                            <?php echo $form->textField($model,'tel_no',array('size'=>20,'maxlength'=>64)); ?>
                            <?php echo $form->error($model,'tel_no'); ?>
                    </div>
                    <div class="row line">
                            <?php echo $form->labelEx($model,'email'); ?>
                            <?php echo $form->textField($model,'email',array('size'=>20,'maxlength'=>255)); ?>
                            <?php echo $form->error($model,'email'); ?>
                    </div>
                </div>
             
            </div>
        </fieldset>
        <fieldset>
            <legend>Address</legend>
            <div class="row">
                    <?php echo $form->labelEx($model,'street1'); ?>
                    <?php echo $form->textField($model,'street1',array('size'=>60,'maxlength'=>64)); ?>
                    <?php echo $form->error($model,'street1'); ?>
            </div>
            <div class="row">
                    <?php echo $form->labelEx($model,'street2'); ?>
                    <?php echo $form->textField($model,'street2',array('size'=>60,'maxlength'=>64)); ?>
                    <?php echo $form->error($model,'street2'); ?>
            </div>
            <div class="newline">
                <div class="row line">
                        <?php echo $form->labelEx($model,'barangay'); ?>
                        <?php echo $form->textField($model,'barangay',array('size'=>20,'maxlength'=>32)); ?>
                        <?php echo $form->error($model,'barangay'); ?>
                </div>
                <div class="row line">
                        <?php echo $form->labelEx($model,'city'); ?>
                        <?php echo $form->textField($model,'city',array('size'=>20,'maxlength'=>32)); ?>
                        <?php echo $form->error($model,'city'); ?>
                </div>
            </div>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'province'); ?>
                        <?php echo $form->textField($model,'province',array('size'=>20,'maxlength'=>32)); ?>
                        <?php echo $form->error($model,'province'); ?>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Work</legend>
            <div class="row line">
                    <?php echo $form->labelEx($model,'occupation'); ?>
                    <?php echo $form->textField($model,'occupation',array('size'=>20,'maxlength'=>32)); ?>
                    <?php echo $form->error($model,'occupation'); ?>
            </div>
            <div class="row line">
                    <?php echo $form->labelEx($model,'company'); ?>
                    <?php echo $form->textField($model,'company',array('size'=>40,'maxlength'=>128)); ?>
                    <?php echo $form->error($model,'company'); ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>Spouse</legend>
            <div class="row line">
                    <?php echo $form->labelEx($model,'spousename'); ?>
                    <?php echo $form->textField($model,'spousename',array('size'=>30,'maxlength'=>128)); ?>
                    <?php echo $form->error($model,'spousename'); ?>
            </div>
            <div class="row line">
                    <?php echo $form->labelEx($model,'spouseoccupation'); ?>
                    <?php echo $form->textField($model,'spouseoccupation',array('size'=>20,'maxlength'=>32)); ?>
                    <?php echo $form->error($model,'spouseoccupation'); ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>Contact in case of emergency</legend>
            <div class="row line">
                    <?php echo $form->labelEx($model,'emergencycontactname'); ?>
                    <?php echo $form->textField($model,'emergencycontactname',array('size'=>30,'maxlength'=>128)); ?>
                    <?php echo $form->error($model,'emergencycontactname'); ?>
            </div>
            <div class="row line">
                    <?php echo $form->labelEx($model,'emergencycontactrelation'); ?>
                    <?php echo $form->textField($model,'emergencycontactrelation',array('size'=>15,'maxlength'=>32)); ?>
                    <?php echo $form->error($model,'emergencycontactrelation'); ?>
            </div>
            <div class="newline">
                <div class="row">
                        <?php echo $form->labelEx($model,'emergencycontactaddress'); ?>
                        <?php echo $form->textField($model,'emergencycontactaddress',array('size'=>60,'maxlength'=>256)); ?>
                        <?php echo $form->error($model,'emergencycontactaddress'); ?>
                </div>
                <div class="row">
                        <?php echo $form->labelEx($model,'emergencycontactnos'); ?>
                        <?php echo $form->textField($model,'emergencycontactnos',array('size'=>20,'maxlength'=>128)); ?>
                        <?php echo $form->error($model,'emergencycontactnos'); ?>
                </div>
                </div>
        </fieldset>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->