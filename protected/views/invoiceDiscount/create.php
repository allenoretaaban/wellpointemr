<?php
$invoicemodel=Invoice::model()->findByPk($_GET['id']);
$this->breadcrumbs=array(
	'Invoice'=>array('invoice/admin'),
    $invoicemodel->id=>array('invoice/view','id'=>$invoicemodel->id),
    'Invoice Discount',
	'Add',
);
?>

<h1>Add Invoice Discount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>