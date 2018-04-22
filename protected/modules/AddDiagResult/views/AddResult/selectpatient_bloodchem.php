<?php
$diagTemp = null;
if (isset($_POST["tempid"]))
{
    $diagTemp = Yii::app()->db->createCommand()
        ->select('id, temp_title')
        ->from('diag_temps')    
        ->where('id=:id', array(':id'=>$_POST["tempid"]))
        ->queryRow();
} 
?>
<br/>
<div style="color:blue;font-size: 16px;">You will create a diagnostic result <b>"Blood Chemistry"</b></div>

<form method="post" action="<?= Yii::app()->createAbsoluteUrl('DiagResBloodchem/create',array()) ?>" onsubmit="return submitThis();">

<h1>Select a Patient</h1>
*To search, type in the patient's <span style="color:blue">first name</span> or <span style="color:blue">last name</span> or <span style="color:blue">patient id</span>.
<br/>
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

<div>
    <input type="hidden" name="diagtemp" value="<?=$diagTemp["id"] ?>|<?=$diagTemp["temp_title"] ?>" />
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
        $('#patientval').val($('#Patient_id').val());
        return true;
    }
}
</script>