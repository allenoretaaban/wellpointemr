<?php
$model->patient_id = $_GET['id'];

$this->breadcrumbs=array(
	'PDS'=>array('admin'),
        $model->patient->firstname.' '.$model->patient->lastname=>array('patient/view','id'=>$model->patient_id),
	'Add',
);
?>

<h1>Add PDS</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>