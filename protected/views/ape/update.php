<?php
/* @var $this ApeController */
/* @var $model Ape */

$this->breadcrumbs=array(
	'Apes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

?>

<h1>Update <?=$model->ape_type ?> Ape <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>

