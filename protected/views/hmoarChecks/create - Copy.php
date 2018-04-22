<?php
$this->breadcrumbs=array(
	'Hmoar Checks'=>array('index'),
	'Create',
);

$this->menu=array(          
	//array('label'=>'List HmoarChecks', 'url'=>array('index')),
	array('label'=>'Back to Received Checks', 'url'=>array('admin')),
);
?>

<h1>Add Received Check</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>