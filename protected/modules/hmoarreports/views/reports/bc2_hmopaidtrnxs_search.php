<?php
if($_GET['task']== 'trnxs'){
    $url = "/hmoarreports/reports/bcreport?task={$_GET['task']}&billid={$_GET['billid']}";
    $radio ="<label for='HmoFormItems_check_number'>Filter by: </label> 
    <input type='radio' name='paid' value='1'";
    if($_GET['paid']=='1'){$radio .= "checked";}
    $radio .= "> Paid 
    <input type='radio' name='paid' value='0'";
    if($_GET['paid']=='0'){$radio .= "checked";}
    $radio .= "> Not Paid
    <input type='radio' name='paid' value='2'";
    if($_GET['paid']=='2'||$_GET['paid']==''){$radio .= "checked";}
    $radio .= "> Both
    <br/>";
}
if($_GET['task']== 'hmopaidtrnxs'){
    $url = "/hmoarreports/reports/bcreport?task={$_GET['task']}&hmoid={$_GET['hmoid']}&start={$_GET['start']}&end={$_GET['end']}&paid={$_GET['paid']}";
}
if($_GET['task']== 'hmonotpaidtrnxs'){
    $url = "/hmoarreports/reports/bcreport?task={$_GET['task']}&hmoid={$_GET['hmoid']}&start={$_GET['start']}&end={$_GET['end']}&paid={$_GET['paid']}";
}
?>


    <form method="get" action="/hmoarreports/reports/bcreport" id="yw1">    
        <fieldset>
            <legend>Data Filter Options</legend>
            <div class="wide form">
            <label for="HmoFormItems_patient_name">Patient Name</label>    
            <input type="text" maxlength="250" id="HmoFormItems_patient_name" name="Search[patient_name]" value="<?php echo $_GET['Search']['patient_name']?>">
            <br/>
            <label for="HmoForm_avail_date">Avail Date</label> 
            <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'Search[avail_date]',
                    'value' => $_GET['Search']['avail_date'],
                    'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                            'showButtonPanel'=>false,
                            'changeYear'=>true,
                            'changeMonth'=>true,
                            'yearRange'=>'2000'
                    )
             ));
             ?>
            <!--<input type="text" id="HmoForm_avail_date" name="Search[avail_date]" value="<?php echo $_GET['Search']['avail_date']?>">-->
            <br/>
            <label for="HmoFormItems_claim_doctor_name">Doctor Name</label>    
            <input type="text" maxlength="250" id="HmoFormItems_claim_doctor_name" name="Search[claim_doctor_name]" value="<?php echo $_GET['Search']['claim_doctor_name']?>">    
            <br/>
            <label for="HmoFormItems_med_service">Medical Service</label>    
            <input type="text" maxlength="250" id="HmoFormItems_med_service" name="Search[med_service]" value="<?php echo $_GET['Search']['med_service']?>">
            <br/>  
            <label for="HmoFormItems_payable_to">Payable To</label>    
            <input type="text" maxlength="250" id="HmoFormItems_payable_to" name="Search[payable_to]" value="<?php echo $_GET['Search']['payable_to']?>">
            <br/>
            <label for="HmoFormItems_check_number">Check Number</label>    
            <input type="text" maxlength="250" id="HmoFormItems_check_number" name="Search[check_number]" value="<?php echo $_GET['Search']['check_number']?>">
            <br/>
            <label for="HmoForm_check_date">Check Date</label> 
            <?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name' => 'Search[check_date]',
                    'value' => $_GET['Search']['check_date'],
                    'options'=>array(
                            'dateFormat'=>'yy-mm-dd',
                            'showButtonPanel'=>false,
                            'changeYear'=>true,
                            'changeMonth'=>true,
                            'yearRange'=>'2000'
                    )
             ));
             ?>
             <br/>
             <?php if($radio){echo $radio;}?>   

            <input type="submit" value="Search" name="yt2">            
            <a href="<?php echo $url; ?>" style='color:blue;'>Clear Search</a>
            </div>
            
        </fieldset>
    </form>