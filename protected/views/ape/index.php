<?php
/* @var $this ApeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'APE',
);

$this->menu=array(
	array('label'=>'Create APE', 'url'=>array('createWithDoctor')),
	array('label'=>'Manage APE', 'url'=>array('admin')),
);
?>

<h1>APE</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
