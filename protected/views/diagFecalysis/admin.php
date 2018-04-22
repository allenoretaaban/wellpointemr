<?php
$this->breadcrumbs=array(
    'Fecalysis'=>array('admin'),
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
    $.fn.yiiGridView.update('diag-fecalysis-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h2>Fecalysis Diagnostic Results</h2>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
	'id'=>'diag-fecalysis-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
        'datecreated',
		'name',
		'age',
		'sex',
		'requestingphysician',
		'spno',
		/*
		'color',
		'consistency',
		'mucus',
		'undigestedfood',
		'microscopic',
		'wbc',
		'rbc',
		'fatglobules',
		'yeastcells',
		'bacteria',
		'parasites',
		'amoeba',
		'occultblood',
		'others',
		'datereceived',
		'datereleased',
		'medicaltechnologist',
		'licenseno',
		'pathologist',
		'patientno',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
