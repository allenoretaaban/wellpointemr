<?php
$dataSource = new CActiveDataProvider('PatientPresentillnesshistory', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'patientPresentillnesshistory-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'details',
                'datecreated',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Medication History',
                            'url'=>'Yii::app()->createUrl("patientPresentillnesshistory/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Medication History',
                            'url'=>'Yii::app()->createUrl("patientPresentillnesshistory/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Medication History',
                            'url'=>'Yii::app()->createUrl("patientPresentillnesshistory/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('patientPresentillnesshistory/create',array("id"=>$model->id)); ?>">Add Present Illness History</a>