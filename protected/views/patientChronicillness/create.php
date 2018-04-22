<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
        'Chronic Illness',
	'Add',
);
?>

<h1>Add Chronic Illness</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>