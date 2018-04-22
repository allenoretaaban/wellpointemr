<?php
$dataSource = new CActiveDataProvider('PatientPregnancyproblem', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'patientPregnancyproblem-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'name',
                'reason',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Pregnancy Problem',
                            'url'=>'Yii::app()->createUrl("patientPregnancyproblem/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Pregnancy Problem',
                            'url'=>'Yii::app()->createUrl("patientPregnancyproblem/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Pregnancy Problem',
                            'url'=>'Yii::app()->createUrl("patientPregnancyproblem/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('patientPregnancyproblem/create',array("id"=>$model->id)); ?>">Add Pregnancy Problem</a>