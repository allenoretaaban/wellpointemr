<?php
$this->breadcrumbs=array(
	'Medical Statuses'=>array('admin'),
	'Add',
);
?>

<h1>Add Medical Status</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>