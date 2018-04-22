<?php
/* @var $this ApeReportsController */
/* @var $model ApeReports */

$this->breadcrumbs=array(
    'Ape'=>array('index'),
    'Ape Report',
);

//$this->menu=array(
//    array('label'=>'List ApeReports', 'url'=>array('index')),
//    array('label'=>'Create ApeReports', 'url'=>array('create')),
//);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#ape-reports-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Ape Reports</h1>

<p></p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:block">
<?php $this->renderPartial('_reportsearch',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
    'id'=>'ape-reports-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(  
        'ape_id',
        'store',  
        'store',          
        array(
                'name'=>'patient_id',
                'header'=>'Full Name',                                          
                'type'=>'raw',
                'value'=>'CHtml::link($data->patient->lastname .", ".$data->patient->firstname." ".$data->patient->middleinitial,array("patient/view","id"=>$data->patient_id))'
        ),  
        array(
                'name'=>'patient_id',
                'header'=>'Gender',
                'type'=>'raw',
                'value'=>'($data->patient->gender==M)? "MALE" : "FEMALE"'
        ),  
        array(
                'name'=>'patient_id',
                'header'=>'Age',
                'type'=>'raw',
                'value'=>'date_diff(date_create($data->patient->birthdate), date_create("today"))->y'
        ),         
        'cxr',
        'cbc',
        'uri',
        'fec',
        'ecg',
        'pap',
        'pmh',
        'sf',
        'rec',
        'cla',
        'status', 
        array(                          
            'class' => 'CButtonColumn',
            'template' => '{view}',   
            'buttons' => array(
                    'view' => array(
                        'url' => 'Yii::app()->createUrl("ape/view", array("id"=>$data->ape_id))',       
                    ),                        
            ),
        ),
        
    ),
)); ?>
