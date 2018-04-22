<?php
$dataSource = new CActiveDataProvider('PatientChronicillness', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'patientChronicillness-grid',
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
                            'label'=>'View Chronic Illness',
                            'url'=>'Yii::app()->createUrl("patientChronicillness/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Chronic Illness',
                            'url'=>'Yii::app()->createUrl("patientChronicillness/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Chronic Illness',
                            'url'=>'Yii::app()->createUrl("patientChronicillness/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('patientChronicillness/create',array("id"=>$model->id)); ?>">Add Chronic Illness</a>