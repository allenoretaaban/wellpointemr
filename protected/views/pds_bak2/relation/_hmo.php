<?php
$dataSource = new CActiveDataProvider('PdsHmo', array(
        'criteria'=>array(
                'condition'=>'pds_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'pdsHmo-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
                'cardno',
		'controlno',
                'approvalcode',
                array(
                        'name'=>'hmo_id',
                        'value'=>'$data->hmo->name'
                ),
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View HMO',
                            'url'=>'Yii::app()->createUrl("pdsHmo/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update HMO',
                            'url'=>'Yii::app()->createUrl("pdsHmo/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete HMO',
                            'url'=>'Yii::app()->createUrl("pdsHmo/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('pdsHmo/create',array('id'=>$model->id)); ?>">Add HMO</a>