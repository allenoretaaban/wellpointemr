<?php
$this->breadcrumbs=array(
	'Invoices'=>array('admin'),
	$model->patientname,
);



$this->menu=array(
	array('label'=>'Update', 'url'=>array('update','id'=>$model->id)),
    array('label'=>'Print', 'url'=>array('print','id'=>$model->id)),     
	array('label'=>'Delete', 'url'=>array('delete','id'=>$model->id),
            'linkOptions'=>array('confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Invoice <?php echo $model->patientname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'orno',
		'date',  
        'preparedby',
        'patientname',          		
        array(
                    'name'=>'subtotal',
                    'value'=>number_format($model->subtotal,2),
                ),
      
        array(
                    'name'=>'subtotal_discount',
                    'value'=>number_format($model->subtotal_discount,2),
                ),
      
         array(
                    'name'=>'subtotal_vat',
                    'value'=>number_format($model->subtotal_vat,2),
                ),
		
          array(
                    'name'=>'vatexemptsale',
                    'value'=>number_format($model->vatexemptsale,2),
                ),
        
          array(
                    'name'=>'vatexemptsale_discount',
                    'value'=>number_format($model->vatexemptsale_discount,2),
                ),   
		
         array(
                    'name'=>'total',
                    'value'=>number_format($model->total,2),
                ),   
		
	),
)); ?>

<br/>



<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs'=>array(
                'Item'=>$this->renderPartial('relation/_item', array('model'=>$model), $this),
                'Discount'=>$this->renderPartial('relation/_discount', array('model'=>$model), $this)
        ),
));
?>

<div style="float:right">
<br/>
<a target="_blank" href="<?= Yii::app()->createUrl("Invoice/Print/".$model->id, array()) ?>">[Print This Invoice]</a>
<br/>
</div>