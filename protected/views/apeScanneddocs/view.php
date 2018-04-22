<?php
/* @var $this ApeScanneddocsController */
/* @var $model ApeScanneddocs */

$ape=Ape::model()->findByPk($_GET['id']);
$this->breadcrumbs=array(
    'APE'=>array(Yii::app()->controller->createUrl('ape/view',array("id"=>$ape->id))),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ApeScanneddocs', 'url'=>array('index')),
	array('label'=>'Create ApeScanneddocs', 'url'=>array('create')),
	array('label'=>'Update ApeScanneddocs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ApeScanneddocs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ApeScanneddocs', 'url'=>array('admin')),
);
?>

<h1>View APE Scanned Documents #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(     
		'title',
        'description',            
		'date_uploaded',            
        array('label'=>'File Path',
            'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode($model->filepath), '../../'.$model->filepath,
            array("download"=>$model->filename))), 
	),
)); ?>
<br>
<center>
<embed width="700" height="1000"
    src="../<?=$model->filepath ?>" type="image/tiff/pdf/excel"
    negative="no" fit="width" page="1" smooth="yes" toolbar="top" bgcolor="#006400">
</embed>
</center>
