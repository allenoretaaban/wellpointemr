<?php
/* @var $this ApeController */
/* @var $model Ape */

$this->breadcrumbs=array(
	'Apes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Ape', 'url'=>array('index')),
	array('label'=>'Create Ape', 'url'=>array('create')),
	array('label'=>'Update Ape', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ape', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ape', 'url'=>array('admin')),
);
?>

<h1>View Ape #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',       
		'visitreason',
		'datevisited',
        array(
                'name'=>'patient_id',
                'type'=>'raw',
                'value'=>CHtml::link($model->patient->firstname." ".$model->patient->lastname,array("patient/view","id"=>$model->patient_id))
        ), 
		'doctor',
		'department',
		'hmo',
	),
)); ?>   
<br/>
<fieldset>
    <legend>Medical History</legend>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(                                                                                            
                    'Past History'=>$this->renderPartial('relation/_pasthistory', array('model'=>$model), $this),  
                    'Family History'=>$this->renderPartial('relation/_familyhistory', array('model'=>$model), $this),      
                    'Social History'=>$this->renderPartial('relation/_socialhistory', array('model'=>$model), $this),      
                    'Medication History'=>$this->renderPartial('relation/_medicationhistory', array('model'=>$model), $this),      
                    'OB-GYNE History'=>$this->renderPartial('relation/_obgynehistory', array('model'=>$model), $this),      
            ),
    ));
    ?>
</fieldset>
<br/>
<fieldset>
    <legend>Physical Examination</legend>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(                                                                                            
                    'Body Mass Index'=>$this->renderPartial('relation/_bodymassindex', array('model'=>$model), $this),  
                    'Blood Pressure'=>$this->renderPartial('relation/_bloodpressure', array('model'=>$model), $this),  
                    'Visual Acuity'=>$this->renderPartial('relation/_visualacuity', array('model'=>$model), $this),  
                    'Findings'=>$this->renderPartial('relation/_findings', array('model'=>$model), $this),  
                    
            ),
    ));
    ?>
</fieldset>  
<br/>
<fieldset>
    <legend>Diagnostic Results / Interpretation</legend>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(                                                                                            
                    'Diagnostic'=>$this->renderPartial('relation/_diagnostic', array('model'=>$model), $this),  
            ),
    ));
    ?>
</fieldset>
<br/>
<fieldset>
    <legend>Recommendation</legend>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(                                                                                            
                    'Recommendation'=>$this->renderPartial('relation/_recommendation', array('model'=>$model), $this),  
            ),
    ));
    ?>
</fieldset>
<br/>
