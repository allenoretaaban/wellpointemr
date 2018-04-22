<?php
$pds=Pds::model()->findByPk($_GET['id']);
$this->breadcrumbs=array(
	'PDS'=>array('pds/admin'),
        $pds->id=>array('pds/view','id'=>$pds->id),
        'Add',
);
?>

<h1>Add Scanned Document</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>