<?php
$this->breadcrumbs=array(
	'Hmo Form Items'=>array('index'),
	$model->itemid=>array('view','id'=>$model->itemid),
	'Update',
);

$this->menu=array(	
	array('label'=>'View Transaction Item', 'url'=>array('view', 'id'=>$model->itemid)),	
    array('label'=>'Back To Transaction', 'url'=>array('hmoForm/view/', 'id'=>$model->hmo_form_id)),    
);
?>

<h1>Update HmoFormItems <?php echo $model->itemid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>