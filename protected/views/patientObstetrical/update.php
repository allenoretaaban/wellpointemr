<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
	$model->year
);
?>

<h1>Update Obstetrical <?php echo $model->year; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>