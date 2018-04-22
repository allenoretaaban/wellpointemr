<?php
$this->breadcrumbs=array(
	'Urinalysis'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),'View '.$model->id
);
/*
$this->menu=array(
	array('label'=>'List DiagUrinalysis', 'url'=>array('index')),
	array('label'=>'Create DiagUrinalysis', 'url'=>array('create')),
	array('label'=>'Update DiagUrinalysis', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DiagUrinalysis', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DiagUrinalysis', 'url'=>array('admin')),
);
*/

$this->menu=array(
    array('label'=>'Manage Records List', 'url'=>array('admin')),
    array('label'=>'Edit This Record', 'url'=>array('diagurinalysis/update/'.$model->id)),
    array('label'=>'Delete This Record', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h2>View Patient's Diagnostics for Urinalysis</h2>
<div style="float:left;margin:0px 0px 5px 0px;">
<?php echo CHtml::link('[Edit This Result]',array('diagurinalysis/update/'.$model->id)); ?>
&nbsp;&nbsp;
<a target="_blank" href="<?= Yii::app()->createUrl("PrintDiagResult/FormUrinalysis/Print/?resultid=".$model->id, array()) ?>">[Print This Result]</a>
&nbsp;&nbsp;
<a id="yt0" href="#">[Delete This Record]</a>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        'datereceived',
        'datereleased',
		'name',
		'age',
		'sex',
		'requesting_physician',
		'sp_no',
		'pc_color',
		'pc_tranparency',
		'pc_specific_gravity',
		'cc_ph',
		'cc_sugar',
		'cc_protein',
		'm_puscell',
		'm_rbc',
		'm_epitelial_cells',
		'm_mucus_threads',
		'c_amorph_urates',
		'c_amorph_phosphates',
		'c_uric_acid',
        'c_triple_phospate',
		'c_calcium_oxalate',
		'bacteria',
		'casts',
		'pregnancy_test',
		'others',
        'datecreated',
		'med_tech',
        'licenseno',
		'pathologist',
		'patient_id',
	),
)); ?>
<div style="float:left;width:100%;margin:10px 0px 0px 0px;"></div>
