<?php
$this->breadcrumbs=array(
	'Hmoar Banks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Add New Bank', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hmoar-banks-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage HMO Check Banks</h1>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
	'id'=>'hmoar-banks-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'bankid',
		'bank_title',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
