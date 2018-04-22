<?php
$this->breadcrumbs=array(
    'Deposits'=>array('admin'),
    'Add',
);
?>

<h1>Add Deposit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>