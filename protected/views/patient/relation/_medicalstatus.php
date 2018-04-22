<?php
$dataSource = new CActiveDataProvider('PatientMedicalstatus', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'patientMedicalstatus-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'name',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Medical Status',
                            'url'=>'Yii::app()->createUrl("patientMedicalStatus/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Medical Status',
                            'url'=>'Yii::app()->createUrl("patientMedicalStatus/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Medical Status',
                            'url'=>'Yii::app()->createUrl("patientMedicalStatus/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('patientMedicalstatus/create',array("id"=>$model->id)); ?>">Add Medical Status</a>