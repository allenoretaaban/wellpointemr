<?php
$this->breadcrumbs=array(
	'Hmo Billing Items'=>array('index'),
	'Manage',
);
/*
$this->menu=array(
	array('label'=>'List HmoBillingItem', 'url'=>array('index')),
	array('label'=>'Create HmoBillingItem', 'url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hmo-billing-item-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>HMO Billing Items</h1>

<p> 
        You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
        or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
	'id'=>'hmo-billing-item-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'avail_date',
		'hmo',
        'refno',
		'patient_name',				
        'medicalservice',         
        array(
                        'name'=>'charge',
                        'type'=>'raw',
                        'value'=>'number_format($data->charge,2)'
                ),      
		/*
		'doctor',
		'diagnosis',
		'medicalservice',
		'charge_type',
		'charge',
		'by_userid',
		'hmo_billing_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
