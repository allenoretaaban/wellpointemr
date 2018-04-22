<?php
$this->breadcrumbs=array(
	'Diag Res Bloodchems',
);

$this->menu=array(
	array('label'=>'Create DiagResBloodchem', 'url'=>array('create')),
	array('label'=>'Manage DiagResBloodchem', 'url'=>array('admin')),
);
?>

<h1>Diag Res Bloodchems</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
