<?php
$this->breadcrumbs=array(
	'Hmo Forms'=>array('index'),
	$model->id,
);

$this->menu=array(		
	array('label'=>'Update This Transaction', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete This Transaction (Must be admin)', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Back to list', 'url'=>array('admin')),
	
);
?>

<h1>View HMO Form Trnx# <?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',		
		'hmo_name',
		'patient_id',
		'patient_name',
		'entry_date',
		'avail_date',
        'form_total',
		'control_no',
		'card_no',
        
        array(
            'name'=>'hmo_billing_id',                    
            'type'=>'raw',
            'value'=>CHtml::link($model->hmo_billing_id,array("hmoBilling/view","id"=>$model->hmo_billing_id))), 
                
	),
)); ?>


<!--div style="display:table">
<a target="" href="<?= Yii::app()->createUrl("hmoForm/Update/".$model->id, array()) ?>">
    [Update this transaction]
</a>
<br/><br/>                    
</div-->
<br/>



<div>
    <fieldset>
        <legend>Hmo Forms Trnx Items</legend>
        <?php
            $this->widget('zii.widgets.jui.CJuiTabs', array(
                    'tabs'=>array(
                            'Items'=>$this->renderPartial('relation/_item', array('model'=>$model), $this),                
                    ),
            ));                                             
            ?>
    </fieldset>

</div>