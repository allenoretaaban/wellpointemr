<?php                  

$this->breadcrumbs=array(
    'Ape'=>array('admin'),    
    $model->id=>array('view','id'=>$model->id),
);
?>

<h1>View APE <?php echo $model->id; ?>: " Mark as Completed" </h1>
<p>Mark this APE as completed</p>

<?php $this->renderPartial('_formupdatestatus', array('model'=>$model)); ?>

