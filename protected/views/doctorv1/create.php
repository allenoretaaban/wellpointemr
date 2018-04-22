<?php
$this->breadcrumbs=array(
	'Doctors'=>array('admin'),
	'Add',
);
?>

<h1>Add Doctor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>