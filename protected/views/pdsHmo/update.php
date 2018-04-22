<?php
$this->breadcrumbs=array(
	'PDS'=>array('pds/admin'),
        $model->pds->id=>array('pds/view','id'=>$model->pds->id),
	$model->controlno=>array('view','id'=>$model->id),
        'Update'
);
?>

<h1>Update HMO <?php echo $model->controlno; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>