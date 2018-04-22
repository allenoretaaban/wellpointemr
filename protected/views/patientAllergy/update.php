<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
	$model->foodordrug
);
?>

<h1>Update Allergy <?php echo $model->foodordrug; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>