<?php
$this->breadcrumbs=array(
	'HMOs'=>array('hmo/admin'),
        $parent_model->name=>array('hmo/view','id'=>$parent_model->id),
	$model->number
);
?>

<h1>Update Contact <?php echo $model->number; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>