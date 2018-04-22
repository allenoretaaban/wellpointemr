<?php
$this->breadcrumbs=array(
    'PDS'=>array('pds/admin'),
    $model->pds->id=>array('pds/view','id'=>$model->pds->id),
    $model->doctor=>array('view','id'=>$model->id),
    'Update'
);
?>

<h1>Update Diagnosis <?php echo $model->doctor; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>