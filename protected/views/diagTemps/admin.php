<?php
$this->breadcrumbs=array(	
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List DiagTemps', 'url'=>array('index')),
	array('label'=>'Create DiagTemps', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('diag-temps-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Diagnostic Templates List</h1>

<!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
	'id'=>'diag-temps-grid',
	'dataProvider'=>$model->search(),    
	'filter'=>$model,
	'columns'=>array(
		'id',
		'createdate',
		/*'createby',
		'updateby',*/
		'temp_title',
        'diag_type',  
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
