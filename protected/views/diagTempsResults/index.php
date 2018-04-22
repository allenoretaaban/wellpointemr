<?php
$this->breadcrumbs=array(
	'Diag Temps Results',
);

$this->menu=array(
	array('label'=>'Create DiagTempsResults', 'url'=>array('create')),
	array('label'=>'Manage DiagTempsResults', 'url'=>array('admin')),
);
?>

<h1>Diag Temps Results</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
