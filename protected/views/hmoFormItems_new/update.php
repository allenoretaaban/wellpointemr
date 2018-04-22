<?php
$this->breadcrumbs=array(
	'HMO Trnx Items'=>array('index'),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List HmoFormItems', 'url'=>array('index')),
	array('label'=>'Manage HmoFormItems', 'url'=>array('admin')),
);*/
?>

<h1>Create HMO Transaction Item</h1>

<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>