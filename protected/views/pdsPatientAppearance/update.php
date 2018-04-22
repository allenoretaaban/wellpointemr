<?php
$this->breadcrumbs=array(
	'PDS'=>array('pds/admin'),
        $model->pds->id=>array('pds/view','id'=>$model->pds->id),
	$model->item=>array('view','id'=>$model->id),
        'Update'
);
?>

<h1>Update Appearance <?php echo $model->item; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>