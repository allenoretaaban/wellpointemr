<?php
$dataSource = new CActiveDataProvider('PatientContact', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'patientContact-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'number',
                'type',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Contact',
                            'url'=>'Yii::app()->createUrl("patientContact/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Contact',
                            'url'=>'Yii::app()->createUrl("patientContact/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Contact',
                            'url'=>'Yii::app()->createUrl("patientContact/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('patientContact/create',array("id"=>$model->id)); ?>">Add Contact</a>