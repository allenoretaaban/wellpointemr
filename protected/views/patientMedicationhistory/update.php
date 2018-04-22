<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
	$model->drugortherapy
);
?>

<h1>Update Medication History <?php echo $model->drugortherapy; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>