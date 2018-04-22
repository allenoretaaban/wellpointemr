<?php
    $this->breadcrumbs=array(
	    'Urinalysis'=>array('admin'),
	    'Create',
    );

/*
$this->menu=array(
	array('label'=>'List DiagUrinalysis', 'url'=>array('index')),
	array('label'=>'Manage DiagUrinalysis', 'url'=>array('admin')),
);
*/
?>

<h2>Create Patient's Diagnostic for Urinalysis</h2>
<?php         
    echo $this->renderPartial('_form', array('model'=>$model)); 
?>