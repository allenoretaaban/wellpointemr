<?php
$this->breadcrumbs=array(
	'Patients'=>array('admin'),
	'Add',
);
?>

<h1>Add Patient</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>