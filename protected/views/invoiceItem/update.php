<?php
$this->breadcrumbs=array(
	'Invoice'=>array('invoice/admin'),
    $model->invoice->orno=>array('invoice/view','id'=>$model->invoice_id),
	$model->description,
    'Update'
);

$this->menu=array(
   array('label'=>'Delete', 'url'=>array('Itemdelete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this invoice discount?')),
);

?>

<h1>Update Invoice Item <?php echo $model->description; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>