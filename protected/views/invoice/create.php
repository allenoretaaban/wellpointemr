<?php
$this->breadcrumbs=array(
	'Invoices'=>array('admin'),
	'Add',
);
?>

<h1>Add Invoice</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>