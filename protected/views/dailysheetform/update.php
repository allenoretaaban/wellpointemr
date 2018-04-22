<?php
$this->breadcrumbs=array(
    'Daily Sheet Forms'=>array('admin'),
    $model->date=>array('view','id'=>$model->id),
    'Update',
);
?>

<h1>Update Daily Sheet Form <?php echo $model->date; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>