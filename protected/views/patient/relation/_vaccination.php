<?php
$dataSource = new CActiveDataProvider('PatientVaccination', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'patientVaccination-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'name',
                'datereceived',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Vaccination History',
                            'url'=>'Yii::app()->createUrl("patientVaccination/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Vaccination History',
                            'url'=>'Yii::app()->createUrl("patientVaccination/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Vaccination History',
                            'url'=>'Yii::app()->createUrl("patientVaccination/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('patientVaccination/create',array("id"=>$model->id)); ?>">Add Vaccination History</a>