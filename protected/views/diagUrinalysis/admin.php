<?php
$this->breadcrumbs=array(
	'Urinalysis'=>array('admin'),
	'Manage',
);

$this->menu=array(
    array('label'=>'Add New', 'url'=>array('index'))
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('diag-urinalysis-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Urinalysis Diagnostic Results</h2>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
	'id'=>'diag-urinalysis-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
        'sp_no',
		'name',
		'age',
		'sex',	
		/*
                'requesting_physician',
		'pc_color',
		'pc_tranparency',
		'pc_specific_gravity',
		'cc_ph',
		'cc_sugar',
		'cc_protein',
		'm_puscell',
		'm_rbc',
		'm_epitelial_cells',
		'm_mucus_threads',
		'c_amorph_urates',
		'c_amorph_phosphates',
		'c_uric_acid',
		'c_calcium_oxalate',
		'bacteria',
		'casts',
		'pregnancy_test',
		'others',
		'date_released',
		'date_received',
		'med_tech',
		'pathologist',
		'patient_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
