<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1>ValuCare Custom Billing</h1>

<?php 
$model = HmoBilling::model();
//$valuCareModel = HmoBilling::model()->findByPk(14);

$this->widget('zii.widgets.grid.CGridView', array(
    'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
    'id'=>'hmo-billing-grid',
       'dataProvider'=>$model->searchValuCare(),
       'filter'=>$model,  
       
    'columns'=>array(
        'id',        
         array(         
                'name'=>'hmo_id',
                'type'=>'raw',
                'value'=>'Hmo::model()->findByPk($data->hmo_id)->name'                        
         ),              
        'prepared_by',
        //'by_userid',
        'date_prepared',
        'date_due',
        'from_date',
        'to_date',
        'bill_total',          
        /*
        'pds_hmo_id',
        'bill_total',
        */
          
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}',   
            'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Billing Items',
                            'url'=>'Yii::app()->createUrl("ValuCare/ValuCare/viewbill", array("id"=>$data->id))',
                        ),
                    ),
        ),
    ),
)); ?>