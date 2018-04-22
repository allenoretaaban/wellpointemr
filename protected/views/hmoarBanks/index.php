<?php
$this->breadcrumbs=array(
	'Hmoar Banks',
);

$this->menu=array(
	array('label'=>'Create HmoarBanks', 'url'=>array('create')),
	array('label'=>'Manage HmoarBanks', 'url'=>array('admin')),
);
?>

<h1>Hmoar Banks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
