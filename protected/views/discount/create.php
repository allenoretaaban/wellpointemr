<?php
$this->breadcrumbs=array(
	'Discounts'=>array('admin'),
	'Add',
);
?>

<h1>Add Discount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>