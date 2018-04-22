<?php
$this->breadcrumbs=array(
	'PDS'=>array('pds/admin'),
        $model->pds->id=>array('pds/view','id'=>$model->pds->id),
	    $model->id
);

$this->menu=array(
	array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete', 'url'=>array('delete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Download', 'url'=>'../'.$model->filepath,
            'linkOptions'=>array('confirm'=>'Are you sure you want to download this file?')),
);
?>

<h1>View Scanned Document<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'title',
        'description',
        'filepath',
	),
)); ?>
<br>
<center>
	<a href="../<?=$model->filepath ?>" target="_blank">CLICK HERE TO VIEW DIRECTLY TO BROWSER</a>	
	<br>
	<iframe src="../<?=$model->filepath ?>" height="1000" width="700" style="margin:10px 0px 0px 0px;padding:0px;"></iframe>
	<!--embed width=700 height=1000
    src="../<?=$model->filepath ?>" type="image/tiff/pdf"
    negative=no fit=width page=1 smooth=yes toolbar=top bgcolor="#006400"  style="margin:10px 0px 10px 0px"-->
</center>