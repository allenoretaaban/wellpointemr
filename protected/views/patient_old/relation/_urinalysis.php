<?php
$dataSource = new CActiveDataProvider('DiagUrinalysis', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'diagUrinalysis-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'pathologist',
                'med_tech',
                'datecreated',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Urinalysis',
                            'url'=>'Yii::app()->createUrl("diagUrinalysis/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Urinalysis',
                            'url'=>'Yii::app()->createUrl("diagUrinalysis/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Urinalysis',
                            'url'=>'Yii::app()->createUrl("diagUrinalysis/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('diagUrinalysis/create',array("patient_id"=>$model->id)); ?>">Add Urinalysis</a>