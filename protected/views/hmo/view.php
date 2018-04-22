<?php
$this->breadcrumbs=array(
	'HMOs'=>array('admin'),
	$model->name,
);
?>

<h1>View HMO <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'street1',
		'street2',
		'barangay',
		'city',
		'province',
	),
)); ?>

<h3>Contact Number</h3>
<?php $dataSource = new CActiveDataProvider('HmoContact', array(
        'criteria'=>array(
                'condition'=>'hmo_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'hmoContact-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'number',
                'type',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Contact',
                            'url'=>'Yii::app()->createUrl("hmoContact/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Contact',
                            'url'=>'Yii::app()->createUrl("hmoContact/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Contact',
                            'url'=>'Yii::app()->createUrl("hmoContact/delete", array("id"=>$data->id))',
                        ),
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('hmoContact/create',array("id"=>$model->id)); ?>">Add Contact</a>