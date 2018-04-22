<?php
$this->breadcrumbs=array(
	'Cash Vouchers'=>array('admin'),
	$model->description=>array('view','id'=>$model->id),
	'Update',
);
?>

<h1>Update Cash Voucher <?php echo $model->description; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>