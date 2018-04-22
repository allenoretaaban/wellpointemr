<?php
$this->breadcrumbs=array(
	'Hmo Form Items',
);

$this->menu=array(
	array('label'=>'Create HmoFormItems', 'url'=>array('create')),
	array('label'=>'Manage HmoFormItems', 'url'=>array('admin')),
);
?>

<h1>Hmo Form Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
