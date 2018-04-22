<?php
$this->breadcrumbs=array(
	'Manage'=>array('admin'),
	$model->id,
);

/*$this->menu=array(
    array('label'=>'Update Template', 'url'=>array('update', 'id'=>$model->id))
	/*array('label'=>'List DiagTemps', 'url'=>array('index')),
	array('label'=>'Create DiagTemps', 'url'=>array('create')),                 	
	array('label'=>'Delete DiagTemps', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DiagTemps', 'url'=>array('admin')),
);*/
?>

<h1>View Diagnostic Template #<?php echo $model->id; ?></h1>    

<div style="float:left;margin:0px 0px 5px 0px;">
<?php echo CHtml::link('[Edit This Template]',array('diagTemps/update/'.$model->id)); ?>
&nbsp;&nbsp;
<a target="_blank" href="<?= Yii::app()->createUrl("PrintDiagResult/TemplatePreview/Print/?tempid=".$model->id, array()) ?>">[Print Preview]</a>
&nbsp;&nbsp;

</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'temp_title',  
        'diag_type', 
		'id',
		'createdate',
		'createby',
		'updateby',
		
	),
)); ?>
