<?php
$this->breadcrumbs=array(
	'PDS'=>array('admin'),
	$model->id
);

$this->menu=array(
	array('label'=>'Print Form 1 (Front Page)', 'url'=>array('print','id'=>$model->id)),
    array('label'=>'Print Form 1 (Back Page)', 'url'=>array('PrintBack','id'=>$model->id)),
    array('label'=>'Print Form 2', 'url'=>array('printForm2','id'=>$model->id)),
);
?>

<h1>View PDS <?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'datevisited',
		'visitreason',
                'doctor',
                'department',
                'hmo',
                array(
                    'name'=>'patient',
                    'value'=>$model->patient->firstname.' '.$model->patient->lastname
                )
	),
)); ?>

<br/>
<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs'=>array(
                'HMO'=>$this->renderPartial('relation/_hmo', array('model'=>$model), $this),
                'Appearance'=>$this->renderPartial('relation/_appearance', array('model'=>$model), $this),
                'Eye Exam'=>$this->renderPartial('relation/_eyeexam', array('model'=>$model), $this),
                'Obgyne'=>$this->renderPartial('relation/_obgyne', array('model'=>$model), $this),
                'Vital Sign'=>$this->renderPartial('relation/_vitalsign', array('model'=>$model), $this),
                'Diagnosis & Recommendation'=>$this->renderPartial('relation/_diagnosis', array('model'=>$model), $this),
                'Scanned Documents'=>$this->renderPartial('relation/_scanneddocs', array('model'=>$model), $this),
        ),
));
?>
