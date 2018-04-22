<?php
$this->breadcrumbs=array(
    'Hematology'=>array('admin'),
    $model->name=>array('view','id'=>$model->id),'View '.$model->id
);

$this->menu=array(
    array('label'=>'Manage Records List', 'url'=>array('admin')),
    array('label'=>'Edit This Record', 'url'=>array('diaghematology/update/'.$model->id)),
    array('label'=>'Delete This Record', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h2>View Patient's Diagnostics for Hematology</h2>
<div style="float:left;margin:0px 0px 5px 0px;">
<?php echo CHtml::link('[Edit This Result]',array('diaghematology/update/'.$model->id)); ?>
&nbsp;&nbsp;
<a target="_blank" href="<?= Yii::app()->createUrl("PrintDiagResult/FormHematology/Print/?resultid=".$model->id, array()) ?>">[Print This Result]</a>
&nbsp;&nbsp;
<a id="yt0" href="#">[Delete This Record]</a>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
                'datereceived',
                'datereleased',
		'name',
		'age',
		'sex',
		'requestingphysician',
		'spno',
		'rbc',
		'hemoglobin',
		'hematocrit',
		'wbc',
		'segmenters',
		'lymphocytes',
		'monocytes',
		'eosinophils',
		'stabband',
		'basophil',
		'plateletcount',
		'mcv',
		'mch',
		'mchc',
		'bloodtype',
		'rhtype',
		'esr',
		'bleedingtime',
		'clottingtime',
		'others',
		'datecreated',
		'medicaltechnologist',
		'licenseno',
		'pathologist',
		'patient_id',
	),
)); ?>
