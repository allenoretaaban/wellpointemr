<?php
/* @var $this ApeController */
/* @var $model Ape */

$this->breadcrumbs=array(
    'APE'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List APE', 'url'=>array('index')),
    array('label'=>'Create APE', 'url'=>array('createWithDoctor')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    if($('#patient_name').val()==''){
        $('#Ape_patient_id').val('');
    }
    $('#ape-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Manage APE</h1>         
<div class="search-form" style="display:block">    
<?php $this->renderPartial('_searchwithpatient',array(
    'model'=>$model,
)); ?> 
</div>                  
<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
    'id'=>'ape-grid',
    'dataProvider'=>$model->search(),        
    //'filter'=>$model,
    'columns'=>array(
        'id',
//        'user_id',
//        'username',
        'datevisited',
        array(               
            'name'=>'patient_id',
            'value'=>'ucwords($data->patient->firstname." ".$data->patient->lastname)'
        ),   
        array(
            'name'=>'hmo_id',
            'value'=>'$data->hmo->name'
        ),  
        'hmo_member_id',  
        array(
            'name'=>'client_id',
            'value'=>'$data->client->client_name'
        ),
        'employee_id',
//        'is_preemployment',
//        'is_annual',
//        'is_executive',
//        'is_card',
//        'card_number',
//        'is_promo',
//        'promo',
//        'is_others',
//        'others',    
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
