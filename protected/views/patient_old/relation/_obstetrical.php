<?php
$dataSource = new CActiveDataProvider('PatientObstetrical', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'patientObstetrical-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'year',
                'place',
                'gestage',
                'mannerofdelivery',
                'babyweight',
                'babygender',
                'notes',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Obstetrical History',
                            'url'=>'Yii::app()->createUrl("patientObstetrical/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Obstetrical History',
                            'url'=>'Yii::app()->createUrl("patientObstetrical/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Obstetrical History',
                            'url'=>'Yii::app()->createUrl("patientObstetrical/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('patientObstetrical/create',array("id"=>$model->id)); ?>">Add Obstetrical History</a>