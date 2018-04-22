<?php
$this->breadcrumbs=array(
	'Chronic Illnesses'=>array('admin'),
	'Add',
);
?>

<h1>Add Chronic Illness</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>