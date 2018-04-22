
<script type="text/javascript">
	function getSpecialization(id)
	{
	    $.get('../../doctor/lookupSpecialization/' + id,
	        function(data){
	            $("#department").val(data);
	        }
	    );
	}
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pds-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'visitreason'); ?>
		<?php echo $form->textArea($model,'visitreason',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'visitreason'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'doctor'); ?>
		<?php 
		echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
		        array(
		                'id'=>'search',
		                'name'=>'search',
		                'model'=>$model,
		                'attribute'=>'doctor',
		                'sourceUrl'=>Yii::app()->createAbsoluteUrl('doctor/lookupFullname', array()),
		                'options'=>array(
		                        'select'=>'js:function(event,ui){
		                                close();
		                                term=ui.item.value.split(":");
		                                ui.item.value=term[1];
		                                getSpecialization(term[0]);
		                        }'
		                ),
					    'htmlOptions'=>array(
					        'style'=>'width:220px;',
					    ),
		        ),
		        true
		);
		?>
		<?php echo $form->error($model,'doctor'); ?>
	</div>
	<div class="row">        
		<?php echo $form->labelEx($model,'department'); ?>
        <small>Note: If patient transaction type is "APE" just manually type <b>APE</b> in the field below.</small><br/>
		<?php echo $form->textField($model,'department',array('id'=>'department','size'=>32,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'department'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'hmo'); ?>
        <small>Select a HMO Company if patient transaction type is HMO. Leave blank if not applicable.</small><br/>
		<?php echo $form->dropDownList($model,'hmo',
                                CHtml::listData(Hmo::model()->findAll(), 'id', 'name'),
                                array('empty'=>'', 'prompt'=>$model->hmo)
                        );
                ?>
		<?php echo $form->error($model,'hmo'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'datevisited'); ?>
                <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(
                                'model'=>$model,
                                'attribute'=>'datevisited',
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
		<?php echo $form->error($model,'datevisited'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->