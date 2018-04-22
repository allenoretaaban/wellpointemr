<?php
$dataSource = new CActiveDataProvider('PdsPatientEyeexam', array(
        'criteria'=>array(
                'condition'=>'pds_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'pdsPatientEyeexam-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
                array(
                    'value'=>'"Please select options on the right"'
                ),
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Appearance',
                            'url'=>'Yii::app()->createUrl("pdsPatientEyeexam/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Appearance',
                            'url'=>'Yii::app()->createUrl("pdsPatientEyeexam/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Appearance',
                            'url'=>'Yii::app()->createUrl("pdsPatientEyeexam/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('pdsPatientEyeexam/create',array("id"=>$model->id)); ?>">Add Eye Exam</a>