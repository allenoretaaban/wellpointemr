<?php
  $dataSource = new CActiveDataProvider('HmoForm', array(
        'criteria'=>array(
                'condition'=>'hmo_billing_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>100,
        ),
 ));
 
 $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'pds-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
        'columns'=>array(
        'id',
        'entry_date',       
        'avail_date',
        //'hmo_name',
        'patient_name',
         array(
                    'name'=>'form_total',
                    'value'=> 'number_format($data->form_total,2 )'
                ),
        array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{viewslip}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Details',
                            'url'=>'Yii::app()->createUrl("hmoForm/view", array("id"=>$data->id))',
                             'label'=>'View Transaction Items',
                            
                        ),
                        'update' => array
                        (
                            
                        ),
                        'delete' => array
                        (
                            
                        ),
                        'viewslip' => array
                        (
                            'label'=>'&nbsp;Charge Slip',
                            'imageUrl'=>Yii::app()->request->baseUrl.'/images/charge_slip/slip.png',
                            'url'=>'Yii::app()->createUrl("hmoFormItems/printchargeslip/",array("id"=>$data->id))',
                        ),
                    ),
        ),
    ),
));
?>
