<?php
$dataSource = new CActiveDataProvider('PatientFamilyhistory', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'patientFamilyhistory-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'name',
                'relation',
                'agedetected',
                'cancertype',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Family History',
                            'url'=>'Yii::app()->createUrl("patientFamilyhistory/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Family History',
                            'url'=>'Yii::app()->createUrl("patientFamilyhistory/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Family History',
                            'url'=>'Yii::app()->createUrl("patientFamilyhistory/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('patientFamilyhistory/create',array("id"=>$model->id)); ?>">Add Family History</a>