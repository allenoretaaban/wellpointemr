<?php
$this->breadcrumbs=array(
	'Hmoar Checks',
);

$this->menu=array(
	array('label'=>'Create HmoarChecks', 'url'=>array('create')),
	array('label'=>'Manage HmoarChecks', 'url'=>array('admin')),
);
?>

<h1>Hmoar Checks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
