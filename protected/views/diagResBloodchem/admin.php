<?php

/*$this->menu=array(
	array('label'=>'List DiagResBloodchem', 'url'=>array('index')),
	array('label'=>'Create DiagResBloodchem', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('diag-res-bloodchem-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>
input[type=text]{
    padding:0!important;
}
</style>

<h1>Manage Blood Chemistry Results</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
	'id'=>'diag-res-bloodchem-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',		
		'sp_no',
		'createdate',
                'patient_id', 
                'patient_name',
        
		/*
                'status',
		
		'createby',
		'patient_id',
		
		'age',
		'gender',
		'req_doctor',
		'read_doctor',
		'date_last_print',
		'lastupdateby',
		'medtech',
		'med_tech_id',
		'pathologist',
		'pathologist_id',
		'glucose',
		'bun',
		'creatinine',
		'uric_acid',
		'cholesterol',
		'triglycerides',
		'hdl_c',
		'ldl_c',
		'vldl_c',
		'sgot_ast',
		'sgpt_alt',
		'hba1c',
		'total_bilirubin',
		'direct_bilirubin',
		'indirect_bilirubin',
		'sodium',
		'potassium',
		'calcium',
		'total_protein',
		'alkaline_phosphatase',
		'other',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
