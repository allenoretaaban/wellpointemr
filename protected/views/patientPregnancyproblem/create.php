<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
        'Pregnancy Problem',
	'Add',
);
?>

<h1>Add Pregnancy Problem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>