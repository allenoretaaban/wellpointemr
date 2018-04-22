<?php
$dataSource = new CActiveDataProvider('DiagHematology', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'diagHematology-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'pathologist',
                'medicaltechnologist',
                'datecreated',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Hematology',
                            'url'=>'Yii::app()->createUrl("diagHematology/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Hematology',
                            'url'=>'Yii::app()->createUrl("diagHematology/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Hematology',
                            'url'=>'Yii::app()->createUrl("diagHematology/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('diagHematology/create',array("patient_id"=>$model->id)); ?>">Add Hematology</a>