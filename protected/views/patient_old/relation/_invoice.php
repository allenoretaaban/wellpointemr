<?php
$dataSource = new CActiveDataProvider('Invoice', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id,
                'order'=>'date desc'
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'invoice-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
        'columns'=>array(
            'id',
            'orno',
            'date',
            'total',
            'patientname',
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}{delete}',
                'buttons'=>array
                (
                    'view' => array
                    (
                        'label'=>'View Invoice',
                        'url'=>'Yii::app()->createUrl("invoice/view", array("id"=>$data->id))',
                    ),
                    'update' => array
                    (
                        'label'=>'Update Invoice',
                        'url'=>'Yii::app()->createUrl("invoice/update", array("id"=>$data->id))',
                    ),
                    'delete' => array
                    (
                        'label'=>'Delete Invoice',
                        'url'=>'Yii::app()->createUrl("invoice/delete", array("id"=>$data->id))',
                    ),
                ),
            ),
        ),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('invoice/create',array("id"=>$model->id)); ?>">Add Invoice</a>