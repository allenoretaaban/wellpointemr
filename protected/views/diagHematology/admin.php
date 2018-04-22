<?php
$this->breadcrumbs=array(
    'Hematology'=>array('admin'),
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
    $.fn.yiiGridView.update('diag-hematology-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h2>Manage Hematology Diagnostic Records</h2>

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
	'id'=>'diag-hematology-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'age',
		'sex',
		'requestingphysician',
		'spno',
		/*
		'rbc',
		'hemoglobin',
		'hematocrit',
		'wbc',
		'segmenters',
		'lymphocytes',
		'monocytes',
		'eosinophils',
		'stabband',
		'basophil',
		'plateletcount',
		'bloodtype',
		'rhtype',
		'esr',
		'bleedingtime',
		'clottingtime',
		'others',
		'datereceived',
		'datereleased',
		'medicaltechnologist',
		'licenseno',
		'pathologist',
		'patient_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
