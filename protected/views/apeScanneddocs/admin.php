<?php
/* @var $this ApeScanneddocsController */
/* @var $model ApeScanneddocs */

$this->breadcrumbs=array(
	'Ape Scanneddocs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ApeScanneddocs', 'url'=>array('index')),
	array('label'=>'Create ApeScanneddocs', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ape-scanneddocs-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ape Scanneddocs</h1>

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
	'id'=>'ape-scanneddocs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'ape_id',
		'user_id',
		'username',
		'update_datetime',
		'title',
		/*
		'description',
		'filepath',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
