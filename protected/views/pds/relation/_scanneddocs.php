<?php
$dataSource = new CActiveDataProvider('PdsPatientScannedDocs', array(
        'criteria'=>array(
                'condition'=>'pds_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'pdsPatientScannedDocs-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	    'columns'=>array(
                'title',
                'description',
                'filepath',
		        array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                (
                        'view' => array
                        (
                            'label'=>'View Scanned Documents',
                            'url'=>'Yii::app()->createUrl("pdsPatientScannedDocs/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Scanned Document',
                            'url'=>'Yii::app()->createUrl("pdsPatientScannedDocs/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Scanned Document',
                            'url'=>'Yii::app()->createUrl("pdsPatientScannedDocs/delete", array("id"=>$data->id))',
                        ),
                ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('pdsPatientScannedDocs/create',array("id"=>$model->id)); ?>">Add Scanned Document</a>