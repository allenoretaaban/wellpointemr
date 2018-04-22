<?php
$this->breadcrumbs=array(
	'Hmo Billings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List HmoBilling', 'url'=>array('index')),
	array('label'=>'Create HmoBilling', 'url'=>array('create')),
	array('label'=>'View HmoBilling', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage HmoBilling', 'url'=>array('admin')),
);
?>

<h1>Update HmoBilling <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>