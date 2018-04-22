<?php
/*$this->breadcrumbs=array(
	'Diag Temps Results'=>array('index'),
	$model->id,
);*/

/*$this->menu=array(
	array('label'=>'List DiagTempsResults', 'url'=>array('index')),
	array('label'=>'Create DiagTempsResults', 'url'=>array('create')),
	array('label'=>'Update DiagTempsResults', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DiagTempsResults', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DiagTempsResults', 'url'=>array('admin')),
);*/
?>

<h3>View Diagnostic Template Result </h3>
Result No: <span style="color:blue;font-weight:bold"><?php echo $model->resultno; ?></span><br/>
Result: <span style="color:blue;font-weight:bold"><?= $model->diagtemptitle ?></span><br/>
<br/>
    <a href="<?= Yii::app()->createUrl("diagTempsResults/update/".$model->id, array()) ?>">[Edit This Result]</a>&nbsp;&nbsp;
    <a target="_blank" href="<?= Yii::app()->createUrl("PrintDiagResult/FromTemplate/Print/?resultid=".$model->id, array()) ?>">[Print This Result]</a>
<hr/>

<?php 
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',
		'resultno',*/
        'diagtemptitle',
        'createdate', 
		'status',		
		'patient_id',
        'patient_name',  
		'age',
		'gender',
		/*'req_doctor',
		'read_doctor',
		'date_last_print',
		'lastupdateby',
		'med_tech_id',*/
	),
)); ?>
<b>Result Content</b>
<div style="background: #E5F1F4;display:table; padding: 5px 0 0 5px;width: 610px;">
<?= $model->result_content ?>
</div>