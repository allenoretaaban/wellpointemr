<?php
$this->breadcrumbs=array(
	'Hmo Forms',
);

$this->menu=array(
	array('label'=>'Create HmoForm', 'url'=>array('create')),
	array('label'=>'Manage HmoForm', 'url'=>array('admin')),
);
?>

<h1>Hmo Forms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
