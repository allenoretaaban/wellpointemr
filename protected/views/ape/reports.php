<?php
/* @var $this ApeReportsController */
/* @var $model ApeReports */

$this->breadcrumbs=array(
    'Ape'=>array('admin'),
    'Reports',
);

$this->menu=array(
//    array('label'=>'List ApeReports', 'url'=>array('index')),
//    array('label'=>'Create ApeReports', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $('#export-to-excel').attr('href','/ape/ExportToExcel?'+$(this).serialize());
    $('#ape-reports-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>APE Summary Report</h1>      

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:block">    
<?php $this->renderPartial('_searchreports',array(
    'model'=>$model
)); ?>
                 
   
<?php                                    
    echo CHtml::link('Export to excel','/ape/ExportToExcel',array('class'=>'button', 'id'=>'export-to-excel'));      
?>
             
<style type="text/css">
#ape-reports-grid td{
    vertical-align: top;
    text-align:center;
}
</style>               
</div><!-- search-form -->                                                           
<?php                      
    $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'ape-reports-grid',
        'dataProvider'=>$model->search(),
        //'filter'=>$model,
        'columns'=>array(       
            'client_name',                                         
            'hmo_name',
            'hmo_member_id',
            'medilink_no',
            array("name"=>'datevisited',"header"=>'AVAILMENT&nbsp;DATE',),  
            'patient_name',  
            'employee_id',   
            array("name"=>'ape_id',"header"=>'CONTRL&nbsp;NO',),       
            'age',
            'gender',
            'ht',
            'wt',
            'bmi',
            'body_built',     
            'bp',       
            'cxr',
            'cbc',
            'fecalysis',
            'urinalysis',
            'drugtest',
            'ecg',
            'papsmear',
            'visual_acuity',
            'audiometry',   
            'past_history',
            'physical_exam',
            'others1',
            'others2',
            'others3',
            'others4',
            'others5',
            'others6',
            'significant_findings',
            'recommendations',
            'classification',                
            array(
                'class'=>'CButtonColumn',
            ),
        ),
    ));           
?>     