<?php
$this->breadcrumbs=array(
	'Product/Service'=>array('admin'),
	'Add',
);
?>

<h1>Add Product/Service</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>