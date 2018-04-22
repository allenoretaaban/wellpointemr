<?php
$this->breadcrumbs=array(
	'Blood Chemistry Results'=>array('admin'),
	$model->id,
);

/*$this->menu=array(
	array('label'=>'List DiagResBloodchem', 'url'=>array('index')),
	array('label'=>'Create DiagResBloodchem', 'url'=>array('create')),
	array('label'=>'Update DiagResBloodchem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DiagResBloodchem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DiagResBloodchem', 'url'=>array('admin')),
);*/
?>

<h1>View Blood Chemistry Result #<?php echo $model->id; ?></h1>

<div style="float:left;margin:0px 0px 5px 0px;">
<?php echo CHtml::link('[Edit This Result]',array('diagResBloodchem/update/'.$model->id)); ?>
&nbsp;&nbsp;
<a target="_blank" href="<?= Yii::app()->createUrl("PrintDiagResult/FormBloodChem/Print/?resultid=".$model->id, array()) ?>">[Print This Result]</a>
&nbsp;&nbsp;

</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',	
                'datereceived',
                'datereleased',
                'patient_id',
                'patient_name',
                'age',
                'gender',
		'sp_no', 
		'req_doctor',						
		'medtech',
		'medtech_license',
		'pathologist',		
		'glucose',
		'bun',
		'creatinine',
		'uric_acid',
		'cholesterol',
		'triglycerides',
		'hdl_c',
		'ldl_c',
		'vldl_c',
		'sgot_ast',
		'sgpt_alt',
		'hba1c',
		'total_bilirubin',
		'direct_bilirubin',
		'indirect_bilirubin',
		'sodium',
		'potassium',
		'chloride',
		'calcium',
		//'total_protein',
		'alkaline_phosphatase',
		'other',
	),
)); ?>
