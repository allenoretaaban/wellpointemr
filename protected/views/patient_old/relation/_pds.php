<?php
$dataSource = new CActiveDataProvider('Pds', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'pds-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'visitreason',
                'datevisited',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View PDS',
                            'url'=>'Yii::app()->createUrl("pds/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update PDS',
                            'url'=>'Yii::app()->createUrl("pds/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete PDS',
                            'url'=>'Yii::app()->createUrl("pds/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('pds/create',array("id"=>$model->id)); ?>">Add PDS</a>