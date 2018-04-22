<?php
/* @var $this ApeController */
/* @var $model Ape */

$this->breadcrumbs=array(
	'Apes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ape', 'url'=>array('index')),
	array('label'=>'Manage Ape', 'url'=>array('admin')),
);
?>

<h1>Create Ape</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>