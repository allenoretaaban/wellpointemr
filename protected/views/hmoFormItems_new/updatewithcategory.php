<?php
$this->breadcrumbs=array(
    'Hmo Form Items'=>array('index'),
    $model->itemid=>array('view','id'=>$model->itemid),
    'Update',
);

$this->menu=array(
    array('label'=>'View Transaction Item', 'url'=>array($model->itemid)),
    array('label'=>'Back To Transaction', 'url'=>array('hmoForm/view/', 'id'=>$model->hmo_form_id)),
);
?>

<script>
    var hmoMedIndex = 0;
    var addMedServices = function(msvE) {
        var msv = $('#med_service').val();
        if(msvE){ msv = msvE; }

        msvArr = msv.split(':');
        if(msv != '' && msv != null){
            if(msvArr[1] == null){
                alert('Please enter correct medical service title and amount. (e.g., Chiro Xray 1 view:375 )');
                return false;
            }
            $('#services_box').append('<input type="button" value="'+msv+'&nbsp;(x)" id="msv'+hmoMedIndex+'" onclick="removeThisButton('+hmoMedIndex+')" style="margin:0px 3px 3px 0px;" ><input type="hidden" class="msv_class" id="msvt'+hmoMedIndex+'" name="HmoFormItemsCategorySupport[medical_service][]" value="'+msv+'">');
            computeChargeFee();
            $('#med_service').val('');
            $('#med_service').focus();
            hmoMedIndex++;
        }else{
            alert('Cannot add empty value.'); return false;
        }
    }
    var addOthersMedServices = function(msvE){
        if(msvE){
            msvo = msvE;
        }else{
            others_title = $('#others_title').val();
            others_amount = $('#others_amount').val();
            msvo = others_title+':'+others_amount+':'+'Others';
            if(others_title == '' || others_title == null || others_amount == '' || others_amount == null || others_amount == 0){
                alert('Please enter correct medical service title and amount. (e.g., Chiro Xray 1 view:375 )');
                return false;
            }
        }
        $('#services_others_box').append('<input type="button" value="'+msvo+'&nbsp;(x)" id="msv'+hmoMedIndex+'" onclick="removeThisButton('+hmoMedIndex+')" style="margin:0px 3px 3px 0px;" ><input type="hidden" class="msv_class" id="msvt'+hmoMedIndex+'" name="HmoFormItemsCategorySupport[medical_service][]" value="'+msvo+'">');
        computeChargeFee();
        $('#others_title').val('');
        $('#others_amount').val('');
        $('#others_title').focus();
        hmoMedIndex++;
    }
    var computeChargeFee = function() {
        var total_medical_service = 0;
        $('.msv_class').each(function(index,value){
            amtArr = $(value).val().split(':');
            if(parseFloat(amtArr[1])){
                total_medical_service = total_medical_service + parseFloat(amtArr[1]);
            }
        })
        $('#HmoFormItems_charge_fee').val(total_medical_service);
    }
    var removeThisButton = function(indexNumber){
        $('#msv'+indexNumber).remove();
        $('#msvt'+indexNumber).remove();
        computeChargeFee();
    }

    /* doctor */
    var hmoMedIndexDoctor = 0;
    var addMedServicesDoctor = function(msvE) {
        var msv = $('#med_service_doctor').val();
        if(msvE){ msv = msvE; }

        msvArr = msv.split(':');
        if(msv != '' && msv != null){
            if(msvArr[1] == null){
                alert('Please enter correct medical service title and amount. (e.g., Chiro Xray 1 view:375 )');
                return false;
            }
            $('#services_box_doctor').append('<input type="button" value="'+msv+'&nbsp;(x)" id="msvd'+hmoMedIndexDoctor+'" onclick="removeThisButtonDoctor('+hmoMedIndexDoctor+')" style="margin:0px 3px 3px 0px;" ><input type="hidden" class="msvd_class" id="msvtd'+hmoMedIndexDoctor+'" name="HmoFormItemsCategorySupport[medical_service][]" value="'+msv+'">');
            computeChargeFeeDoctor();
            $('#med_service_doctor').val('');
            $('#med_service_doctor').focus();
            hmoMedIndexDoctor++;
        }else{
            alert('Cannot add empty value.'); return false;
        }
    }
    var removeThisButtonDoctor = function(indexNumber){
        $('#msvd'+indexNumber).remove();
        $('#msvtd'+indexNumber).remove();
        computeChargeFeeDoctor();
    }
    var computeChargeFeeDoctor = function() {
        var total_medical_service = 0;
        $('.msvd_class').each(function(index,value){
            amtArr = $(value).val().split(':');
            if(parseFloat(amtArr[1])){
                total_medical_service = total_medical_service + parseFloat(amtArr[1]);
            }
        })
        $('#HmoFormItems_charge_fee_doctor').val(total_medical_service);
    }
</script>


<h1>Update Hmo Form Transaction Item<?php echo $model->itemid; ?></h1>

<?php
    $cv = Yii::app()->user->getFlash('cv');
    if($cv){ 
        Yii::app()->user->setFlash('cv',$cv);
    }
    $cvd = Yii::app()->user->getFlash('cvd');
    if($cvd){ 
        Yii::app()->user->setFlash('cvd',$cvd);
    }

    if ($cv['payto'] == 'DOCTOR' || $cvd['payto'] == 'DOCTOR') {
        $tablabel = 'DOCTOR';
        $tabarray = $this->renderPartial('relations/_doctorupdate', array('model'=>$model), $this);
    }else{
        $tablabel = 'CLINIC';
        $tabarray = $this->renderPartial('relations/_clinicupdate', array('model'=>$model), $this);
    }


    $this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs'=>array(
            $tablabel => $tabarray
        )
    ));
?>