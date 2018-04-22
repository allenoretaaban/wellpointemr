<?php
$this->breadcrumbs=array(
	'Hmo Billing Items',
);

$this->menu=array(
	array('label'=>'Create HmoBillingItem', 'url'=>array('create')),
	array('label'=>'Manage HmoBillingItem', 'url'=>array('admin')),
);
?>

<h1>Hmo Billing Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
