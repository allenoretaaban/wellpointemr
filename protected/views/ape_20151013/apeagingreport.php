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
    $('#export-to-excel').attr('href','/ape/exporttoexcelapeagingreport?'+$(this).serialize());
    $('#ape-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>APE Aging Report</h1>         
<div class="search-form" style="display:block">    
<?php $this->renderPartial('_agingreportsearch',array(
    'model'=>$model,
)); ?> 
</div>     

<?php                                    
    echo CHtml::link('Export to excel','/ape/exporttoexcelapeagingreport?',array('class'=>'button', 'id'=>'export-to-excel'));      
?>
             
<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
    'id'=>'ape-grid',
    'dataProvider'=>$model->search(),        
    //'filter'=>$model,
    'columns'=>array(
        'id',         
        'datevisited',
        array(               
            'name'=>'days pending',
            'value'=>'floor((time() - strtotime($data->datevisited))/(60*60*24))'
        ),   
        array(               
            'name'=>'patient_id',
            'value'=>'ucwords($data->patient->firstname." ".$data->patient->lastname)'
        ),   
        array(
            'name'=>'hmo_id',
            'value'=>'($data->hmo->name == "No HMO")? "" : $data->hmo->name;'     
        ),  
//        'hmo_member_id',  
        array(
            'name'=>'client_id',
            'value'=>'($data->client->client_name == "No Company")? "" : $data->client->client_name;'
        ),
//        'employee_id',    
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
