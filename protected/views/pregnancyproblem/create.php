<?php
$this->breadcrumbs=array(
	'Pregnancy Problems'=>array('admin'),
	'Add',
);
?>

<h1>Add Pregnancy Problem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>