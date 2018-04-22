<?php
$dataSource = new CActiveDataProvider('PdsPatientVitalsign', array(
        'criteria'=>array(
                'condition'=>'pds_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'pdsPatientVitalsign-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
                'height',
                'weight',
                'bmi',
                array(
                        'header'=>'BP',
                        'name'=>'bpsystolic',
                        'value'=>'$data->bpsystolic."/".$data->bpdiastolic'
                ),
                'pulserate',
                'respiratoryrate',
                'temperature',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Vital Sign',
                            'url'=>'Yii::app()->createUrl("pdsPatientVitalsign/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Vital Sign',
                            'url'=>'Yii::app()->createUrl("pdsPatientVitalsign/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Vital Sign',
                            'url'=>'Yii::app()->createUrl("pdsPatientVitalsign/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('pdsPatientVitalsign/create',array("id"=>$model->id)); ?>">Add Vital Sign</a>