<?php
$this->breadcrumbs=array(
	'Invoices'=>array('admin'),
	$model->patientname=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Invoice <?php echo $model->patientname; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>