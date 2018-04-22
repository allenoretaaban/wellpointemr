<?php
$this->breadcrumbs=array(
	'Hmo Billings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HmoBilling', 'url'=>array('index')),
	array('label'=>'Manage HmoBilling', 'url'=>array('admin')),
);
?>

<h1>Create HmoBilling</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>