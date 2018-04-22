<?php
$this->breadcrumbs=array(
	'Family Histories'=>array('admin'),
	'Add',
);
?>

<h1>Add Family History</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>