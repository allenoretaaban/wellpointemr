<?php
$this->breadcrumbs=array(
	'Patients'=>array('patient/admin'),
        $parent_model->firstname=>array('patient/view','id'=>$parent_model->id),
        'Present Illness History',
	'Add',
);
?>

<h1>Add Present Illness History</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>