<?php
/* @var $this ApeController */
/* @var $model Ape */               

$this->breadcrumbs=array(
	'APE'=>array('index'),
	$model->id,
);

$this->menu=array(                                                             
    array('label'=>'Print Front Page', 'url'=>array('ape/print/'.$model->id)),
    array('label'=>'Print Back Page', 'url'=>array('ape/printBack/'.$model->id)),
//  array('label'=>'List Ape', 'url'=>array('index')),
//	array('label'=>'Create Ape', 'url'=>array('create')),
//	array('label'=>'Update Ape', 'url'=>array('update', 'id'=>$model->id)),
//	array('label'=>'Delete Ape', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Ape', 'url'=>array('admin')),
);
?>

<script type="text/javascript">      
$("document").ready(function(){
    $('.ajaxBtn').click( function(){   
            var ajaxBtn = $(this);        
            //var data = new FormData(document.getElementById("ape-bloodpressure-form"));
            var data = new FormData(document.getElementById(ajaxBtn.parent().parent().attr("id")));
            data.append(ajaxBtn.attr("name"),"1");
            ajaxBtn.val("Saving...");  
            $.ajax({
                url: '',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data){
                    console.log("1");
                    ajaxBtn.val("Save");
                }
            });
        return false;    
    });
     
});               
</script>
<h1>View <?=$model->ape_type ?> APE #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(          
        'datevisited',  
        array(
                'name'=>'patient_id',
                'type'=>'raw',
                'value'=>CHtml::link($model->patient->firstname." ".$model->patient->lastname,array("patient/view","id"=>$model->patient_id))
        ),
        array(
            'name'=>'ape_type',
            'type'=>'raw',
            'value'=>$model->ape_type
        ),
        array(
                'name'=>'client_id',
                'type'=>'raw',
                'value'=>$model->client->client_name
        ),         
        'employee_id',         
        array(
                'name'=>'hmo_id',
                'type'=>'raw',
                'value'=>$model->hmo->name
        ),     
        'hmo_member_id',   
        array(
                'name'=>'status',
                'type'=>'raw',   
                'value'=>CHtml::label(($model->status == 1)? "Pending Completion": "Completed","",array("style"=>($model->status == 1)? "color:red; font-weight:bold;": "color:blue; font-weight:bold;"))
                
        ),             
	),
));       
if($model->status == 1){                  
$string = "<table class='detail-view' id='yw0'>
    <tbody>
    <tr class='even'>
        <th></th>
        <td>". CHtml::link("Mark as Complete", array("ape/update_status","id"=>$model->id))."</td>
    </tr>       
    </tbody>
</table>";
echo $string;
}                                                                                   
?>   
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
<fieldset>
    <legend>Others</legend>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(                                                                                            
                    'Others'=>$this->renderPartial('relation/_others', array('model'=>$model), $this),  
            ),
    ));
    ?>
</fieldset>
<br/>       
<fieldset>
    <legend>Files</legend>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(                                                                                            
                    'Scanned Docs'=>$this->renderPartial('relation/_scanneddocs', array('model'=>$model), $this),  
            ),
    ));
    ?>
</fieldset>
<br/>
