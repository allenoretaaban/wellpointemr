<?php
$dataSource = new CActiveDataProvider('PatientAllergy', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'patientAllergy-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'foodordrug',
                'type',
                'sideeffects',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Allergy History',
                            'url'=>'Yii::app()->createUrl("patientAllergy/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Allergy History',
                            'url'=>'Yii::app()->createUrl("patientAllergy/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Allergy History',
                            'url'=>'Yii::app()->createUrl("patientAllergy/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('patientAllergy/create',array("id"=>$model->id)); ?>">Add Allergy</a>