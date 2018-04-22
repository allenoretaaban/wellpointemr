<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
	'Add Medical Status',
);
?>

<h1>Add Medical Status</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>