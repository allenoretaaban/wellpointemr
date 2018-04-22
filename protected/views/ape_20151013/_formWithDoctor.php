<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'Ape-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
                    
    <?php echo $form->errorSummary($model); ?>  
                               
    <div class="row">
        <?php echo $form->labelEx($model,'client_id'); ?>
        <?php
            $clientlist = Clients::model()->find(array("condition"=>"client_name = 'No Company'"),array('order'=>'client_name'));
        ?>
        <?php
            echo $form->dropDownList(
                $model,'client_id',CHtml::listData(Clients::model()->findAll(array('order'=>'client_name')), 'client_id', 'client_name'), array('empty'=>array($clientlist->client_id=>$clientlist->client_name), 'prompt'=>$model->client_id)
            );
        ?>
        <?php echo $form->error($model,'client_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'employee_id'); ?>
        <?php echo $form->textField($model,'employee_id'); ?>
        <?php echo $form->error($model,'employee_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'hmo_id'); ?>          
        <?php
            $hmolist = HMO::model()->find(array("condition"=>"name = 'No HMO'"));     
        ?>
        <?php 
            echo $form->dropDownList($model,'hmo_id', 
                CHtml::listData(Hmo::model()->findAll(array('order'=>'name')), 'id', 'name'),
                //array('options'=>array($hmolist->id=>array('selected' => true)))
                array('empty'=>array($hmolist->id=>$hmolist->name))
            );
        ?>
        <?php echo $form->error($model,'hmo_id'); ?>
    </div>

    <div class="row">                                        
        <?php echo $form->labelEx($model,'hmo_member_id'); ?>
        <?php echo $form->textField($model,'hmo_member_id'); ?>
        <?php echo $form->error($model,'hmo_member_id'); ?>
    </div>

    <div class="row">                                        
        <?php echo $form->labelEx($model,'medilink_no'); ?>
        <?php echo $form->textField($model,'medilink_no'); ?>
        <?php echo $form->error($model,'medilink_no'); ?>
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
                <script type="text/javascript">
                    document.getElementById("Ape_datevisited").value = "<?php echo date("Y-m-d"); ?>";
                </script>
        <?php echo $form->error($model,'datevisited'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->