<?php
/* @var $this ApeScanneddocsController */
/* @var $model ApeScanneddocs */

$this->breadcrumbs=array(                   
    'APE'=>array(Yii::app()->controller->createUrl('ape/view',array("id"=>$ape->id))),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ApeScanneddocs', 'url'=>array('index')),
	array('label'=>'Create ApeScanneddocs', 'url'=>array('create')),
	array('label'=>'View ApeScanneddocs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ApeScanneddocs', 'url'=>array('admin')),
);
?>

<h1>Update APE Scanned Docs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>