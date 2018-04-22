<?php
$this->breadcrumbs=array(
	'Hmo Forms'=>array('index'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List HmoForm', 'url'=>array('index')),
	array('label'=>'Create HmoForm', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hmo-form-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage HMO Transactions</h1>

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

<?php 

$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
	'id'=>'hmo-form-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'hmo_billing_id',
		//'hmo_id',
        'hmo_name',
		//'patient_id',
		'patient_name',
		'entry_date',
        'avail_date',
        'hmo_billing_id',
        array(         
                'name'=>'hmo_billing_date',
                'type'=>'raw',
                'value'=>'HmoBilling::model()->findByPk($data->hmo_billing_id)->date_prepared'                        
         ),
		/*           		
		'control_no',
		'card_no',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
