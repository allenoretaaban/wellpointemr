<h1>View HMO Trnx Item #<?php echo $model->itemid; ?></h1>

<?php 
$model = HmoFormItems::model()->findByPk($_GET["id"]);

$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'itemid',
        //'hmo_form_id',
        //'item_entry_date',
        //'item_avail_date',
        'payto',
        //'claim_doctor_id',
        'claim_doctor_name',
        'diagnosis',
        'med_service',
        'service_type',
        'req_doctor',
        'charge_type',
        'charge_fee',
        
        array(
            'name'=>'hmo_form_id',                    
            'type'=>'raw',
            'value'=>CHtml::link($model->hmo_form_id,array("ValuCare/viewform","id"=>$model->hmo_form_id))), 
    ),
)); ?>