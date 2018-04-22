<?php
/*$this->breadcrumbs=array(
	'Diag Temps Results'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DiagTempsResults', 'url'=>array('index')),
	array('label'=>'Create DiagTempsResults', 'url'=>array('create')),
	array('label'=>'View DiagTempsResults', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DiagTempsResults', 'url'=>array('admin')),
);*/
?>

<h3>Edit Diagnostic Result</h3>
<hr/> 



<?php 

$from=date('Y-m-d 00:00:00',strtotime($model->createdate));
//$to=date('Y-m-d 23:59:59', strtotime("2012-07-02"));
$to=date('Y-m-d h:m:s');
$cnt=0;
$nodays= (strtotime($to) - strtotime($from))/ (60 * 60 * 24); //it will count no. of days

if ($nodays <= 2){
    echo $this->renderPartial('_form', array('model'=>$model));     
}else{
    echo "<span style='color:red'>Grace period 48 hours have expired since result was made. You can't edit this record anymore.</span>";
}

?>