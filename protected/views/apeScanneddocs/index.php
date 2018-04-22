<?php
/* @var $this ApeScanneddocsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ape Scanneddocs',
);

$this->menu=array(
	array('label'=>'Create ApeScanneddocs', 'url'=>array('create')),
	array('label'=>'Manage ApeScanneddocs', 'url'=>array('admin')),
);
?>

<h1>Ape Scanneddocs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
