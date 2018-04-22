<?php
$this->breadcrumbs=array(
	'PDS'=>array('admin'),
        $model->patient->firstname.' '.$model->patient->lastname=>array('patient/view','id'=>$model->patient_id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update PDS <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_formWithDoctor', array('model'=>$model)); ?>