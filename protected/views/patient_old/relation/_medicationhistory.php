<?php
$dataSource = new CActiveDataProvider('PatientMedicationhistory', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'patientMedicationhistory-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'drugortherapy',
                'presentFlag:boolean',
                'presentAsOfDate',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Medication History',
                            'url'=>'Yii::app()->createUrl("patientMedicationhistory/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Medication History',
                            'url'=>'Yii::app()->createUrl("patientMedicationhistory/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Medication History',
                            'url'=>'Yii::app()->createUrl("patientMedicationhistory/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('patientMedicationhistory/create',array("id"=>$model->id)); ?>">Add Medication History</a>