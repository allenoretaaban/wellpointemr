<?php
/*$this->breadcrumbs=array(
	'Diag Temps Results'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DiagTempsResults', 'url'=>array('index')),
	array('label'=>'Create DiagTempsResults', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('diag-temps-results-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Diagnostic Results From Template</h1>

<!--p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p-->

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
	'id'=>'diag-temps-results-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
        'diagtemptitle',
        'diag_type',
		'resultno',        
		/*'status',
		'createdate',
		'result_content',
		'patient_id',    */
        'patient_name',
		/*
		'age',
		'gender',
		'req_doctor',
		'read_doctor',
		'date_last_print',
		'lastupdateby',
		'med_tech_id',
		*/
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view}{update}',                    
		),
	),
)); ?>


