<?php
$this->breadcrumbs=array(
	'Hmo Form Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List HmoFormItems', 'url'=>array('index')),
	array('label'=>'Create HmoFormItems', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hmo-form-items-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Hmo Form Items</h1>

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
	'id'=>'hmo-form-items-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'itemid',
		'hmo_form_id',
		'item_entry_date',
		'item_avail_date',
		'payto',
		'claim_doctor_id',
		/*
		'claim_doctor_name',
		'diagnosis',
		'med_service',
		'service_type',
		'req_doctor',
		'charge_type',
		'charge_fee',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
