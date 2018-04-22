<?php
$dataSource = new CActiveDataProvider('PdsDiagnosis', array(
        'criteria'=>array(
                'condition'=>'pds_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'pdsDiagnosis-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
        'columns'=>array(
            'doctor',
            array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Diagnosis',
                            'url'=>'Yii::app()->createUrl("pdsDiagnosis/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Diagnosis',
                            'url'=>'Yii::app()->createUrl("pdsDiagnosis/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Diagnosis',
                            'url'=>'Yii::app()->createUrl("pdsDiagnosis/delete", array("id"=>$data->id))',
                        ),
                    ),
        ),
    ),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('pdsDiagnosis/create',array("id"=>$model->id)); ?>">Add Diagnosis</a>