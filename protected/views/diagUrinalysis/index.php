<?php
$this->breadcrumbs=array(
    'Urinalysis'=>array('admin'),
);

/*
$diagTemp = Yii::app()->db->createCommand()
    ->select('id, temp_title')
    ->from('diag_temps')    
    ->where('id=:id', array(':id'=>$_POST["tempid"]))
    ->queryRow();
*/  
?>
<br/>
<div style="color:blue">You will create a diagnostic result <b>"Urinalysis"</b></div>

<form method="post" action="<?= Yii::app()->createAbsoluteUrl('diagUrinalysis/create/',array()) ?>" onsubmit="return submitThis();">

<h2>Select a Patient</h2>
*To search, type in the patient's <span style="color:blue">first name</span> or <span style="color:blue">last name</span> or <span style="color:blue">patient id</span>.
<br/>
<div style="float:left;margin:3px 0px 3px 0px;">
<?php 
$model = new Patient();
echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                            array(
                                    'model'=>$model,
                                    'attribute'=>'id',
                                    'htmlOptions' => array("size"=>'50','style'=>'padding:10px;'),
                                    'sourceUrl'=>Yii::app()->createAbsoluteUrl('Patient/lookup',array())     
                            ),
                            true
                        );
?>
</div>
<div style="width:100%;float:left;">
    <input type="hidden" name="diag" value="urinalysis" />
    <input type="hidden" name="patientval" value="" id="patientval" />
    <input type="submit" value=" Create Result " />
</div>

</form>


<script>
submitThis = function (){
    if ($('#Patient_id').val() == ''){
        alert('Please select a patient first');
        return false;
    }else{
        $x = $('#patientval').val($('#Patient_id').val());
        return true;
    }
}
</script>