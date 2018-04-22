<?php
$dataSource = new CActiveDataProvider('PdsPatientAppearance', array(
        'criteria'=>array(
                'condition'=>'pds_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'pdsPatientAppearance-grid',
        'dataProvider'=>$dataSource,           
        'ajaxUpdate' => false,
	'columns'=>array(
		'item',
                'normalFlag:boolean',
                'notes',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Appearance',
                            'url'=>'Yii::app()->createUrl("pdsPatientAppearance/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Appearance',
                            'url'=>'Yii::app()->createUrl("pdsPatientAppearance/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Appearance',
                            'url'=>'Yii::app()->createUrl("pdsPatientAppearance/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('pdsPatientAppearance/create',array("id"=>$model->id)); ?>">Add Appearance</a>