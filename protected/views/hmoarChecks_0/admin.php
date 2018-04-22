<?php
$this->breadcrumbs=array(
	'Hmoar Checks'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Add Received Checks', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hmoar-checks-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Received Checks </h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
	'id'=>'hmoar-checks-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'checkid',
		'check_no',
		'check_date',
        array(         
                'name'=>'bank_id',
                'type'=>'raw',
                'value'=>'HmoarBanks::model()->findByPk($data->bank_id)->bank_title'                        
         ),   
        
        array(         
                'name'=>'hmo_id',
                'type'=>'raw',
                'value'=>'Hmo::model()->findByPk($data->hmo_id)->name'                        
         ),  
		
		'payto',
		
        array(         
                'name'=>'pay_doc_id',
                'type'=>'raw',
                'value'=>'Doctor::model()->findByPk($data->pay_doc_id)->firstname. " " .Doctor::model()->findByPk($data->pay_doc_id)->lastname'                        
         ), 
        
		'check_amnt',
		'billed_amnt',
		'wtax_amnt',      
        
        array(            
            'name'=>'applied_amnt',
            'value'=>array($this,'getAppliedTotal')
        ),
        
        array(            
            'name'=>'applied_wtax',
            'value'=>array($this,'getWtaxTotal')
        ),
        
        array(            
            'name'=>'custom_links',
            'value'=>array($this,'customLinks')
        ),
        
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
