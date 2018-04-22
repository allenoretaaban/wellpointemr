<?php
$this->breadcrumbs=array(
    'Hematology'=>array('admin'),
    $model->name=>array('view','id'=>$model->id),
    'Update '.$model->id,
);
?>

<h2>Update Patient's Diagnostic for Fecalysis</h2>
<?php echo CHtml::link('[View This Result]',array('diaghematology/'.$model->id)); ?>
<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>