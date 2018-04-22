<?php
$this->breadcrumbs=array(
	'HMOs'=>array('hmo/admin'),
        $parent_model->name=>array('hmo/view','id'=>$parent_model->id),
        'Contact',
	'Add',
);
?>

<h1>Add Contact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>