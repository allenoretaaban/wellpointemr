<?php
$this->breadcrumbs=array(
	'Diag Temps',
);

$this->menu=array(
	array('label'=>'Create DiagTemps', 'url'=>array('create')),
	array('label'=>'Manage DiagTemps', 'url'=>array('admin')),
);
?>

<h1>Diag Temps</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
