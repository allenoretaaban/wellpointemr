<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
	$model->number
);
?>

<h1>Update Contact <?php echo $model->number; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>