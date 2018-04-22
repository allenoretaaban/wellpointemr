<?php
$this->breadcrumbs=array(
	'Hmoar Banks'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Back to Check Banks', 'url'=>array('admin')),
);
?>

<h1>Add New Check Bank</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>