<?php
$dataSource = new CActiveDataProvider('DiagResBloodchem', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'diagResBloodchem-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'pathologist',
                'medtech',
                'createdate',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Blood Chemistry',
                            'url'=>'Yii::app()->createUrl("diagResBloodchem/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Blood Chemistry',
                            'url'=>'Yii::app()->createUrl("diagResBloodchem/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Blood Chemistry',
                            'url'=>'Yii::app()->createUrl("diagResBloodchem/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('diagResBloodchem/create',array("patient_id"=>$model->id)); ?>">Add Blood Chemistry</a>