<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
	$model->primaryname
);
?>

<h1>Update HMO <?php echo $model->primaryname; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>