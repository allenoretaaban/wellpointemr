<?php
$this->breadcrumbs=array(
	'HMOs'=>array('admin'),
	'Add',
);
?>

<h1>Add HMO</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>