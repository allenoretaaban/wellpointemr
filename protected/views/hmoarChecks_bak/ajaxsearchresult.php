<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/jqgrid/redmond/jquery-ui-1.8.2.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/jqgrid/ui.jqgrid.css" />
<style type="text/css">
    .label{
        font-weight:bold;
        color:#555;
        width:100px;
    }
    .subLabel{
        font-weight:bold;
        color:#555;
        margin-left:10px;
        vertical-align:top;
    }
    .formHeader{
        font-weight:bold;
        font-size:110%;
    }
    .tdSubLabel{
        vertical-align:top;
    }
    #dispatchTabs li .ui-icon-close { float: left; margin: 0.4em 0.2em 0 0; cursor: pointer; }
</style>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/jquery/jquery.progressbar.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/jquery/addon/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/jquery/jquery.jqGrid.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/jquery/utility.js" type="text/javascript"></script>

<link href="<?php echo Yii::app()->request->baseUrl; ?>/modal/modal.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/modal/modal.js"></script>

<script type="text/javascript">
var offlineMode = false;
var pathtojsfiles = "../js/js/packed/";

var bill_id = '<?php echo  $_GET["billid"] ?>';
var check_id= "<?php echo $model->checkid; ?>";

<?php
    if ($_GET["pid"]):
?>
    var patientid = '<?php echo $_GET["pid"]; ?>';
<?php else: ?>
    var patientid = '';
<?php endif; ?>


var hmo_id = '<?php echo $model->hmo_id ?>';
var apply_errflag = 1;


$(document).ready(function() {
    dataUrl = '/sync/HmoarSync.php?a=GetHmoTrnxs&bid=' + bill_id + '&pid=' + patientid;  
    initHmoTrnxsGrid("HMO Trnxs", "#tblUntrnxs", "#pgrUntrnxs",dataUrl); 
    
    $('input#app_amnt').blur(function(){
        validateApply();                                                                   
    });  
    $('input#app_tax').blur(function(){
        validateApply();                                                                   
    });         
});

function applySubmit(){
    param = validateApply();       
    
    if (param == true){ 
            if (confirm("Are you sure you want to save this record?")){
                    $('#saving').show();
                    itemid = $('#app_itemid').val();
                    app_amnt = $('#app_amnt').val();
                    app_tax = $('#app_tax').val();
                    provider_xces = $('#provider_xces').val();
                    member_xces = $('#member_xces').val();
                    hmo_xces = $('#hmo_xces').val();
                    hmo_xces_rem = $('#hmo_xces_rem').val();
                    
                    params = itemid + "|"+app_amnt + "|"+ app_tax+ "|"+ check_id + 
                                "|"+ provider_xces +
                                "|"+ member_xces +
                                "|"+ hmo_xces +
                                "|"+ hmo_xces_rem ;
                    
                    $.get("<?= Yii::app()->request->baseUrl; ?>/sync/HmoarSync.php?a=SaveApply&params=" + params, function(result) {
                           $('#saving').hide();
                           alert(result);
                           window.location.reload();
                           //initGrids();    $("#tblPaidtrnxs").trigger("reloadGrid");
                           
                    });
                }
           
           /* if (apply_errflag == 1){
                alert("You have errors in you entry"); return;
            }else{
                
            }       */
    
    }
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function initGrids(){
    $("#tblUntrnxs").setGridParam({url : '<?= Yii::app()->request->baseUrl; ?>/sync/HmoarSync.php?a=GetHmoTrnxs&bid=' + bill_id});
    //$("#tblPaidtrnxs").setGridParam({url : '<?= Yii::app()->request->baseUrl; ?>/sync/HmoarSync.php?a=GetPaidTrnxs&checkid=' + check_id});
}

function searchData(){
    raw = $('#Patient_id').val();
    arr = raw.split(':');
    patientid = arr[0];
    /*initGrids();
     $("#tblUntrnxs").trigger("reloadGrid");*/
     
     <?php
     //clean
     $tmp_url = $_SERVER["REQUEST_URI"];
     $tmp_url = preg_replace('/&pid=(.*)/', '', $tmp_url);    
     ?>
     
     window.location = '<?php echo $tmp_url ?>' + '&pid='+patientid;
    
    /*alert(patientid);
    dataUrl = '/sync/HmoarSync.php?a=GetTrnxs&pid=' + patientid + '&hid=' + hmo_id;  
    initTrnxsGrid("Unpaid Trnxs", "#tblUntrnxs", "#pgrUntrnxs",dataUrl);             */
    
}

function applyCheck(itemid, fee, pname, medsvc){
    $('#app_itemid').val(itemid);
     $('#pname').html(pname);
      $('#medsvc').html(medsvc);
    $('#billamnt').html(fee);
    showModal("dialog",500,550);
    validateApply();
}

function disApply(itemid, fee, pname, medsvc){
    if (confirm("Do you really want to disapply this transaction?")){
            $.get("<?= Yii::app()->request->baseUrl; ?>/sync/HmoarSync.php?a=DisApply&itemid=" + itemid, function(result) {                   
                   alert(result);
                   window.location.reload();                                                                               
            });
        
    }
}

function validateApply(){
    app_amnt = $('#app_amnt').val();
    var num = parseFloat(app_amnt);
    var cleanNum = num.toFixed(2);
    $('#app_amnt').val(cleanNum);
    if (isNumber(cleanNum) == false){
            apply_errflag = 1;
            $('#app_amnt_error').html('Please enter valid amount');
    }else{
        app_amnt =  cleanNum;
        apply_errflag = 0;
        $('#app_amnt_error').html('');
        
    
        app_tax = $('#app_tax').val();
        var num = parseFloat(app_tax);
        var cleanNum = num.toFixed(2);
        $('#app_tax').val(cleanNum);
        if (isNumber(cleanNum) == false){
                apply_errflag = 1;
                $('#app_tax_error').html('Please enter valid amount');
        }else{
            apply_errflag = 0;
            app_tax =  cleanNum;
            $('#app_tax_error').html('');
        }
        
    }
    
    //check if app amount is zero    
    if (parseFloat(app_amnt) == 0){
        apply_errflag = 1;
        $('#app_amnt_error').html('Please enter valid amount');
    }
    
    
    if (apply_errflag == 1){
        $('#app_loss').val(0);
        return false;
    }else{
        numbill = $('#billamnt').html()
        numbill = numbill.replace(',','');
        bill_amnt = parseFloat(numbill);
        tmp_loss = bill_amnt - (parseFloat(app_amnt) +  parseFloat(app_tax));
        if (tmp_loss < 0){
            apply_errflag = 1;
            $('#app_loss').val(tmp_loss);   
            $('#app_loss_error').html('Exceeded billed amount');
            
        }else{
            apply_errflag = 0;
            $('#app_loss').val(tmp_loss);    
            $('#app_loss_error').html('');
        }
        return true;
    }
}

function removePatientFilter(){
     window.location = '<?php echo $tmp_url ?>';
}

</script>

<div class="view">
    <div id="unpaidwrap" style="float:left;width:520px;border:1px solid none;padding:3px;">

                <Div>
                    <table>
                        <tr>
                            <td><span class="blue">Search Patient:</span>
                            </td>
                            <td>
                                <?php 
                                    $pmodel = new Patient();
                                    
                                    $pbox_value = "";
                                    $tmp_patient = Patient::model()->findByPk($_GET["pid"]);
                                    if ($tmp_patient->id > 0){
                                        $pbox_value  = $tmp_patient->id. ":". $tmp_patient->lastname . ", ". $tmp_patient->firstname;
                                    }
                                    
                                    echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                                    array(
                                            'model'=>$pmodel,
                                            'attribute'=>'id',         
                                            'htmlOptions' => array("size"=>'50','style'=>'padding:10px;','value'=>"$pbox_value"),
                                            'sourceUrl'=>Yii::app()->createAbsoluteUrl('Patient/lookuphmoar',array())
                                             
                                    ),
                                    true
                                    );
                                    ?>
                                    <input type="button" value="   Search  " onclick="searchData()" />
                                    
                                    <br/>
                                    <small>*Autocomplete enabled</small>
                                    <br/>
                                    <?php
                                        if ($_GET["pid"]):
                                    ?>
                                    <a href="javascript:void(0)" onclick='removePatientFilter()'>Remove Filter</a>
                                    <?php endif; ?>
                            </td>                                                 
                        </tr>
                    </table>
                </div>

                <div style="margin-top:10px">
                    <table id="tblUntrnxs"></table>
                    <div id="pgrUntrnxs"></div>
                </div>     
    
    </div>

</div>

<div id="boxes">
    <div id="dialog" class="window">
        <div style="width:100%;text-align:right" ><a href="#" class="close" /><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/closelabel.png" /></a></div>
        <b>Apply Check:</b>
        <table>
            <tr>
                <td>Patient:</td>
                <td><span id='pname' ></span></td>                
            </tr>
            <tr>
                <td>Service:</td>
                <td><span id='medsvc' ></span></td>                
            </tr>
            <tr>
                <td>Billed Amount:</td>
                <td><span id='billamnt' ></span></td>                
            </tr>
        </table>
        <br/>
        <fieldset>
            <table>
                <tr>
                    <td>Check amnt to apply:</td>
                    <td><input type="text" id="app_amnt" name="app_amnt" class="field" value="0" /> <span id='app_amnt_error' style="color:red"></span>
                    </td>
                </tr>
                <tr>
                    <td>Tax amnt to apply:</td>
                    <td><input type="text" id="app_tax" name="app_tax" class="field" value="0" /><span id='app_tax_error' style="color:red"></span>
                    </td>
                </tr>
                <tr>
                    <td>Diff:</td>
                    <td><input type="text" id="app_loss" name="app_loss" class="field" value="0" disabled="disabled" /><span id='app_loss_error' style="color:red"></span></td>
                </tr>    
            </table>
        </fieldset>    
        <br/>
        <fieldset>
            <legend> If Check Amount is less than Billing Amount</legend>
            <table>
                <tr>
                    <td>Provider Excess:</td>
                    <td><input type="text" id="provider_xces" name="provider_xces" class="field" value="0" /> <span id='provider_xces_error' style="color:red"></span>
                    </td>
                </tr>
                <tr>
                    <td>Member Excess:</td>
                    <td><input type="text" id="member_xces" name="member_xces" class="field" value="0" /><span id='member_xces_error' style="color:red"></span>
                    </td>
                </tr>
               </table>
        </fieldset>    
        <fieldset>
            <legend> If Check Amount is greater than Billing Amount</legend>
            <table>
                <tr>
                    <td>HMO Excess:</td>
                    <td>
                    <input type="text" id="hmo_xces" name="hmo_xces" class="field" value="0" /><span id='hmo_xces_error' style="color:red"></span>
                    </td>
                </tr>
                <tr>
                    <td>Remarks</td>
                    <td>
                        <input type="text" id="hmo_xces_rem" name="hmo_xces_rem" class="field" /><span id='hmo_xces_rem_error' style="color:red"></span>
                    </td>
                </tr>
            </table>
        </fieldset>    
        <br/>
        <br/>
        <table>
            <tr>
                <td colspan="2"> 
                    <input type="hidden" id="app_itemid" name="app_itemid" value="0"  />
                    <input type="button" onclick="applySubmit()" value="  Submit  " />
                    <div id="saving" style="display:none">Please wait . . . saving record <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/rot_small.gif" /></div>
                </td>
            </tr>
        </table>
        
</div>

<div id="mask"></div>

