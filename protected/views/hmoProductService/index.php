<?php
$this->breadcrumbs=array(
	'Hmo Product Services',
);

$this->menu=array(
	array('label'=>'Create HmoProductService', 'url'=>array('create')),
	array('label'=>'Manage HmoProductService', 'url'=>array('admin')),
);
?>

<h1>Hmo Product Services</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
