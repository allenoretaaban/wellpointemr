<?php
session_start();
if (isset($_SESSION['errmsg']))
{
    if (count($_SESSION['errmsg']) > 0){
        foreach ($_SESSION["errmsg"] as $errmsg){
            echo '<div class="error">'.$errmsg.'</div>';

        }
        $_SESSION["errmsg"] = null;
    }
}
?>

<style>
#tempid{
    padding:10px;font-size:14px;
}
.error{
    border:1px solid red;padding:10px;    width:650px;    margin-top:3px;color:red;font-weight: bold;
}
.results li{
    padding:5px;
}
</style>

<h1>Generate Weekly Billing</h1>
   
<br/>

<script>
function submitThis(){
    if ($('#from_date').val() == ''){
        alert('Please enter the From date')   ;
        return false;
    }
    if ($('#to_date').val() == ''){
        alert('Please enter the To date')   ;
        return false ;
    }
    if ($('#due_date').val() == ''){
        alert('Please enter the Due date')   ;
        return false ;
    }
    return;

}
</script>

<form method="post" action="<?= Yii::app()->createAbsoluteUrl('HmoWeekBill/generate/Submit',array()) ?>" onsubmit="return submitThis();">
<div><b>Specify the week period</b></div>   
 <table cellpadding="5">
    <tr>
        <td>From Date:</td>
        <td>
            <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(     
                                'id'=>'from_date' ,
                                'name'=>'from_date',   
                                'value'=>$_GET["from_date"],          
                                'htmlOptions' => array("size"=>'25'),                                           
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
							'maxDate'=>'+25Y',
							'minDate'=>'-20Y'
                                )
                            ),
                            true
                        );
            ?>        
        </td>
    </tr>
    <tr>
        <td>To Date:</td>
        <td>
            <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(     
                                'id'=>'to_date' ,
                                'name'=>'to_date',       
                                'value'=>$_GET["to_date"],                                                
                                'htmlOptions' => array("size"=>'25'),                                           
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
							'maxDate'=>'+25Y',
							'minDate'=>'-20Y'                                )
                            ),
                            true
                        );
                ?>        
        </td>
    </tr>    
 </table>
 <br/>
 <div><b>Specify the bill's payment due date</b></div>   
 <table cellpadding="5">
    <tr>
        <td>Due Date:</td>
        <td>
            <?php echo $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array(     
                                'id'=>'due_date' ,
                                'name'=>'due_date', 
                                'value'=>$_GET["due_date"], 
                                'htmlOptions' => array("size"=>'25'),                                           
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'showButtonPanel'=>false,
                                    'changeYear'=>true,
                                    'changeMonth'=>true,
                                    	'maxDate'=>'+25Y',
							'minDate'=>'-20Y'
                                )
                            ),
                            true
                        );
                ?>        
        </td>
    </tr>
</table>        
        
        
<input type="submit" value="  Submit  " />
 
</form>
