<?php
/* @var $this ApeScanneddocsController */
/* @var $model ApeScanneddocs */

$ape=Ape::model()->findByPk($_GET['id']);
$this->breadcrumbs=array(
	'APE'=>array(Yii::app()->controller->createUrl('ape/view',array("id"=>$ape->id))),
	'Create',
);

$this->menu=array(
	array('label'=>'List ApeScanneddocs', 'url'=>array('index')),
	array('label'=>'Manage ApeScanneddocs', 'url'=>array('admin')),
);
?>

<h1>Create APE Scanned Docs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>