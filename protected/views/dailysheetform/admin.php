<?php
$this->breadcrumbs=array(
	'Daily Sheet Forms'
);

$this->menu=array(
    array('label'=>'Add New', 'url'=>array('create'))
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('dailysheetform-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Daily Sheet Forms</h1>

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
	'id'=>'dailysheetform-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'afterAjaxUpdate'=>'reinstallDatePicker',
	'columns'=>array(
		'id',
        array(
            'name' => 'date',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model,
                'attribute'=>'date',
                'language' => 'ja',
                'i18nScriptFile' => 'jquery.ui.datepicker-ja.js',
                'htmlOptions' => array(
                    'id' => 'datepicker_for_date',
                    'size' => '10',
                ),
                'defaultOptions' => array(
                    'dateFormat'=>'yy-mm-dd',
                    'showButtonPanel'=>false,
                    'changeYear'=>true,
                    'changeMonth'=>true,
                    'yearRange'=>'1900'
                )
            ),
            true),
        ),
		'beginningcash',
		'supervisorname',
        'total',
		'verifiedby',
		'preparedby',
		array(
			'class'=>'CButtonColumn',
		),
	),
));

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_date').datepicker();
}
");
?>