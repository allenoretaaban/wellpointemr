<?php
$dataSource = new CActiveDataProvider('DiagTempsResults', array(
        'criteria'=>array(
                'condition'=>'patient_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'diagTempsResults-grid',
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
                            'label'=>'View Templated Results',
                            'url'=>'Yii::app()->createUrl("diagTempsResults/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Templated Results',
                            'url'=>'Yii::app()->createUrl("diagTempsResults/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Templated Results',
                            'url'=>'Yii::app()->createUrl("diagTempsResults/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('diagTempsResults/create',array("id"=>$model->id)); ?>">Add Templated Results</a>