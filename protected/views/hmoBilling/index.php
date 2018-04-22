<?php
$this->breadcrumbs=array(
	'Hmo Billings',
);

$this->menu=array(
	array('label'=>'Create HmoBilling', 'url'=>array('create')),
	array('label'=>'Manage HmoBilling', 'url'=>array('admin')),
);
?>

<h1>Hmo Billings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
