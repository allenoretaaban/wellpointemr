<?php
/* @var $this ApeController */
/* @var $model Ape */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'user_id'); ?>
        <?php echo $form->textField($model,'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'datevisited'); ?>
        <?php echo $form->textField($model,'datevisited'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'patient_id'); ?>
        <?php echo $form->textField($model,'patient_id',array('size'=>20,'maxlength'=>20)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'hmo_id'); ?>
        <?php echo $form->textField($model,'hmo_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'hmo_member_id'); ?>
        <?php echo $form->textField($model,'hmo_member_id',array('size'=>60,'maxlength'=>100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'client_id'); ?>
        <?php echo $form->textField($model,'client_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'employee_id'); ?>
        <?php echo $form->textField($model,'employee_id',array('size'=>60,'maxlength'=>100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'is_preemployment'); ?>
        <?php echo $form->textField($model,'is_preemployment'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'is_annual'); ?>
        <?php echo $form->textField($model,'is_annual'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'is_executive'); ?>
        <?php echo $form->textField($model,'is_executive'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'is_card'); ?>
        <?php echo $form->textField($model,'is_card'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'card_number'); ?>
        <?php echo $form->textField($model,'card_number',array('size'=>60,'maxlength'=>100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'is_promo'); ?>
        <?php echo $form->textField($model,'is_promo'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'promo'); ?>
        <?php echo $form->textField($model,'promo',array('size'=>60,'maxlength'=>100)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'is_others'); ?>
        <?php echo $form->textField($model,'is_others'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'others'); ?>
        <?php echo $form->textField($model,'others',array('size'=>60,'maxlength'=>100)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->