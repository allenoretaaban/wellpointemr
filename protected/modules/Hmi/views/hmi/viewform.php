   
<h1>HMI Form Trnx# <?php echo $model->id; ?></h1>

<?php 
$model = HmoForm::model()->findByPk($_GET["id"]);

$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',        
        'hmo_name',
        'patient_id',
        'patient_name',
        'entry_date',
        'avail_date',
        'form_total',
        'control_no',
        'card_no',
        
        array(
            'name'=>'hmo_billing_id',                    
            'type'=>'raw',
            'value'=>CHtml::link($model->hmo_billing_id,array("Hmi/viewbill","id"=>$model->hmo_billing_id))), 
                
    ),
)); ?>


<br/>



<div>
    <fieldset>
        <legend>ValuCare Forms Trnx Items</legend>
        
        <?php
            $dataSource = new CActiveDataProvider('HmoFormItems', array(
                    'criteria'=>array(
                            'condition'=>'hmo_form_id = ' . $model->id
                    ),
                    'pagination'=>array(
                            'pageSize'=>10,
                    ),
            ));

            $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'invoiceItem-grid',
                    'dataProvider'=>$dataSource,
                    'ajaxUpdate' => false,
                        'columns'=>array(
                        'payto',
                        'claim_doctor_name',
                        'med_service',
                        'service_type',
                        'charge_fee',

                        array(
                                    'class'=>'CButtonColumn',
                                    'template'=>'{view}',
                                    'buttons'=>array
                                    (
                                        'view' => array
                                        (
                                            'label'=>'View Transaction Item',
                                            'url'=>'Yii::app()->createUrl("Hmi/Hmi/viewFormItem", array("id"=>$data->itemid))',
                                        ),      
                                    ),
                        ),
                ),
            ));

            ?>

        
    </fieldset>

</div>
