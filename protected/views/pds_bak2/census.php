<?php
$this->breadcrumbs=array(
	'PDS'=>array('admin'),
	'Census',
);
?>

<h1>Patient Census</h1>      

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'census-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">             
        <?php echo $form->labelEx($model,'datefrom'); ?>
        <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                    array(
                        'model'=>$model,
                        'attribute'=>'datefrom',
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
        <?php echo $form->error($model,'datefrom'); ?>
    </div>
    <div class="row">     
        <?php echo $form->labelEx($model,'dateto'); ?>
        <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                    array(
                        'model'=>$model,
                        'attribute'=>'dateto',
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
        <?php echo $form->error($model,'dateto'); ?>
    </div>    
	<div class="row">
		<?php echo $form->labelEx($model,'preparedby'); ?>
		<?php echo $form->textField($model,'preparedby',array('size'=>48, 'maxlength'=>128)); ?>
		<?php echo $form->error($model,'preparedby'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'preparedbytitle'); ?>
		<?php echo $form->textField($model,'preparedbytitle',array('size'=>24, 'maxlength'=>128)); ?>
		<?php echo $form->error($model,'preparedbytitle'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'checkedby'); ?>
		<?php echo $form->textField($model,'checkedby',array('size'=>48, 'maxlength'=>128)); ?>
		<?php echo $form->error($model,'checkedby'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'checkedbytitle'); ?>
		<?php echo $form->textField($model,'checkedbytitle',array('size'=>24, 'maxlength'=>128)); ?>
		<?php echo $form->error($model,'checkedbytitle'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Print'); ?>
	</div>
    
<?php $this->endWidget(); ?>

</div><!-- form -->