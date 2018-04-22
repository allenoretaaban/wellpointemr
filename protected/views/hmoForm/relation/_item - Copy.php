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
                        'template'=>'{view}{update}',
                        'buttons'=>array
                        (
                            'view' => array
                            (
                                'label'=>'View Transaction Item',
                                'url'=>'Yii::app()->createUrl("hmoFormItems/view", array("id"=>$data->itemid))',
                            ),
                            'update' => array
                            (
                                'label'=>'Edit Transaction Item',   
                                'url'=>'Yii::app()->createUrl("hmoFormItems/update", array("id"=>$data->itemid))',
                                
                            ),
                            /*'delete' => array
                            (
                                'label'=>'Delete Invoice Item',
                                'url'=>'Yii::app()->createUrl("invoiceItem/delete", array("id"=>$data->id))',
                            ),*/
                        ),
            ),
    ),
));

?>
<a href="<?php echo Yii::app()->controller->createUrl('hmoFormItems/create',array("id"=>$model->id)); ?>">Add Transaction Item</a>