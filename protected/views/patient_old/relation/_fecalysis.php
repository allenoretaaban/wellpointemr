<?php
$dataSource = new CActiveDataProvider('DiagFecalysis', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'diagFecalysis-grid',
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
                            'label'=>'View Fecalysis',
                            'url'=>'Yii::app()->createUrl("diagFecalysis/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Fecalysis',
                            'url'=>'Yii::app()->createUrl("diagFecalysis/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Fecalysis',
                            'url'=>'Yii::app()->createUrl("diagFecalysis/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('diagFecalysis/create',array("patient_id"=>$model->id)); ?>">Add Fecalysis</a>