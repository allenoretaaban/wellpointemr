<?php
$this->breadcrumbs=array(
	'PDS'=>array('admin'),
	'Select Patient',
);
?>

<h1>Select Patient</h1>

*To search, type in the patient's <span style="color:blue">first name</span> or <span style="color:blue">last name</span> or <span style="color:blue">patient id</span>.<br/><br/>

<div class="row">
<?php 
echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
        array(
                'id'=>'search',
                'name'=>'search',
                'attribute'=>'id',
                'sourceUrl'=>Yii::app()->createAbsoluteUrl('patient/lookuppds', array()),
                'options'=>array(
                        'select'=>'js:function(event,ui){
                                close();
                                term=ui.item.value.split(":");
                                document.getElementById("id").value=term[0];
                                ui.item.value=term[1];
                        }'
                ),

        ),
        true
);
?>
</div>

<?php echo CHtml::beginForm('create','get'); ?>

<?php echo CHtml::hiddenField('id'); ?>

<div class="row buttons">
        <?php echo CHtml::submitButton('Select',
                        array('onclick'=>'if(document.getElementById("id").value==""){
                                    alert("Please select an item to proceed"); return false;
                            }')
                );
        ?>
</div>

<?php echo CHtml::endForm(); ?>