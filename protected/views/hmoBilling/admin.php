<?php
$this->breadcrumbs=array(
	'Hmo Billings'=>array('index'),
	'Manage',
);

/*$this->menu=array(
	array('label'=>'List HmoBilling', 'url'=>array('index')),
	array('label'=>'Create HmoBilling', 'url'=>array('create')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hmo-billing-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage HMO Billings</h1>

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
	'id'=>'hmo-billing-grid',
	'dataProvider'=>$model->search(),
    'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}", //THIS DOES WHAT YOU WANT
	'filter'=>$model,
	'columns'=>array(
		'id',		
         array(         
                'name'=>'hmo_id',
                'type'=>'raw',
                'value'=>'Hmo::model()->findByPk($data->hmo_id)->name'                        
         ),              
		'prepared_by',
		//'by_userid',
		'date_prepared',
		'date_due',
        'from_date',
        'to_date',
        'bill_total',          
		/*
		'pds_hmo_id',
		'bill_total',
		*/
		  
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{delete}',   
            'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Billing Items',
                            'url'=>'Yii::app()->createUrl("hmoBilling/view", array("id"=>$data->id))',
                        ),
                    ),
        ),
	),
)); ?>
