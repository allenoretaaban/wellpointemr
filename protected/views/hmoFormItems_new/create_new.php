<?php
$this->breadcrumbs=array(
	'HMO Trnx Items'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'List HmoFormItems', 'url'=>array('index')),
	array('label'=>'Manage HmoFormItems', 'url'=>array('admin')),
);*/
?>
      

<h1>Create HMO Transaction Item</h1>

<?php echo $this->renderPartial('_form_create', array('model'=>$model)); ?>