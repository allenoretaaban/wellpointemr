<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
	$model->datecreated
);
?>

<h1>Update Present Illness History <?php echo $model->datecreated; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>