<?php
$dataSource = new CActiveDataProvider('PdsPatientObgyne', array(
        'criteria'=>array(
                'condition'=>'pds_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'pdsPatientObgyne-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
                'monthlyflag:boolean',
                'pregnantflag:boolean',
                'lastmenstrualperiod',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Obgyne',
                            'url'=>'Yii::app()->createUrl("pdsPatientObgyne/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Obgyne',
                            'url'=>'Yii::app()->createUrl("pdsPatientObgyne/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Obgyne',
                            'url'=>'Yii::app()->createUrl("pdsPatientObgyne/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('pdsPatientObgyne/create',array("id"=>$model->id)); ?>">Add Obgyne</a>