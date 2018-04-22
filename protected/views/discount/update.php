<?php
$this->breadcrumbs=array(
	'Discounts'=>array('admin'),
	$model->description=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Discount <?php echo $model->description; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>