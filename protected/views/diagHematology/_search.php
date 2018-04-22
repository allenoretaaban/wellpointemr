<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'age'); ?>
		<?php echo $form->textField($model,'age'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sex'); ?>
		<?php echo $form->textField($model,'sex',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'requestingphysician'); ?>
		<?php echo $form->textField($model,'requestingphysician',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'spno'); ?>
		<?php echo $form->textField($model,'spno',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rbc'); ?>
		<?php echo $form->textField($model,'rbc',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hemoglobin'); ?>
		<?php echo $form->textField($model,'hemoglobin',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hematocrit'); ?>
		<?php echo $form->textField($model,'hematocrit',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'wbc'); ?>
		<?php echo $form->textField($model,'wbc',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'segmenters'); ?>
		<?php echo $form->textField($model,'segmenters',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lymphocytes'); ?>
		<?php echo $form->textField($model,'lymphocytes',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monocytes'); ?>
		<?php echo $form->textField($model,'monocytes',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eosinophils'); ?>
		<?php echo $form->textField($model,'eosinophils',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stabband'); ?>
		<?php echo $form->textField($model,'stabband',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'basophil'); ?>
		<?php echo $form->textField($model,'basophil',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plateletcount'); ?>
		<?php echo $form->textField($model,'plateletcount',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bloodtype'); ?>
		<?php echo $form->textField($model,'bloodtype',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rhtype'); ?>
		<?php echo $form->textField($model,'rhtype',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'esr'); ?>
		<?php echo $form->textField($model,'esr',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bleedingtime'); ?>
		<?php echo $form->textField($model,'bleedingtime',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'clottingtime'); ?>
		<?php echo $form->textField($model,'clottingtime',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'others'); ?>
		<?php echo $form->textField($model,'others',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datecreated'); ?>
		<?php echo $form->textField($model,'datecreated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'medicaltechnologist'); ?>
		<?php echo $form->textField($model,'medicaltechnologist',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'licenseno'); ?>
		<?php echo $form->textField($model,'licenseno',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pathologist'); ?>
		<?php echo $form->textField($model,'pathologist',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'patient_id'); ?>
		<?php echo $form->textField($model,'patient_id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->