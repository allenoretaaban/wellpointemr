<?php
if ($_GET["billid"]){        
    //select the bill record
    $hmo_bill = HmoBilling::model()->findByPk($_GET["billid"]);
    
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('hmo-form-items-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
    
?>

<h1>Apply Received Check TO SOA</h1>

<div style="width:100%;display:table;">
    <div style="float:left;width:50%">
        <?php
        if ($hmo_bill):
        ?>
             <div>-APPLYING TO SOA-</div>
            <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$hmo_bill,
                'attributes'=>array(
                    'id',        
                     array(
                                'name'=>'HMO',
                                'value'=> Hmo::model()->findByPk($model->hmo_id)->name
                            ),        
                    'prepared_by',
                    //'by_userid',
                    'date_prepared',
                    'date_due',
                    //'pds_hmo_id',        
                     array(
                                'name'=>'bill_total',
                                'value'=> number_format($hmo_bill->bill_total,2 )
                            ),
                ),
            )); ?>
             <div style="background:none repeat scroll 0 0 #F8F8F8;">
                <BR/>
                <form method="post">
      
                    <div>
                        <span style="font-size:16px;color:#333">Change Current SOA No.:</span><input type="text" name="soano" />
                        <input type="submit" value="Submit" />
                    </div>

                </form>
            </div> 
            <?php endif; ?>   
           
    </div>
    <div style="float:left;width:50%">
            <div>-RECEIVED CHECK-</div>
            <?php $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                    'check_no',
                    'check_date',
                     array(
                                'name'=>'Bank',
                                'value'=> HmoarBanks::model()->findByPk($model->bank_id)->bank_title
                            ),   
                    
                    array(
                                'name'=>'HMO',
                                'value'=> Hmo::model()->findByPk($model->hmo_id)->name
                            ),   
                    'payto',
                    
                     array(
                                'name'=>'Doctor',
                                'value'=> Doctor::model()->findByPk($model->pay_doc_id)->firstname . " ".Doctor::model()->findByPk($model->pay_doc_id)->lastname
                            ), 
                    
                    'check_amnt',
                    'billed_amnt',
                    'wtax_amnt',
                    'provider_xces',
                    'member_xces',
                    'hmo_xces',
                    'hmo_xces_rem',
                    'misc_xces',
                    'misc_xces_rem',           
                    
                    
                ),
            )); 
            ?>
            <?php
            $connection=Yii::app()->db;  
            
            //get total applied
            $query ="select sum(paid_amnt) as totapply,
                        sum(wtax) as totwtax,
                        sum(loss) as totloss,
                        sum(provider_xces) as totproviderx,
                        sum(member_xces) as totmemberx,
                        sum(hmo_xces) as tothmox
                        FROM hmoar_chkapply
                        where check_id = ".$model->checkid;
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            $tot_apply = 0;
            $totwtax = 0;
            if ($datareader){
                foreach($datareader as $recd) { 
                    $tot_apply = $recd["totapply"];
                    $unapplied = floatval($model->check_amnt) - floatval($tot_apply);
                    $totwtax = $recd["totwtax"];
                    $taxbal = floatval($model->wtax_amnt) - floatval($totwtax);
                    $totloss = $recd["totloss"];
                    
                    $totproviderx = $recd["totproviderx"];
                    $providerbal = floatval($model->provider_xces) - floatval($totproviderx);
                    
                    $totmemberx = $recd["totmemberx"];
                    $memberbal = floatval($model->member_xces) - floatval($totmemberx);
                    
                    $tothmox = $recd["tothmox"];                    
                }
            }
            ?>
            <br/>
            <style>
            .lright{text-align: right;}
            .bal {color:red;}
            .blue{color:royalblue}
            .padd{padding:10px;}
            </style>
            <table>
                <tr>
                    <td><span class="lbl">Total Check Amount Applied</span>:</td>
                    <td class="lright"><span class="val"><?php echo number_format($tot_apply,2); ?></span> / <span class="bal">(<?php echo number_format($unapplied,2) ?>)</span></td>
                </tr>
                <tr>
                    <td><span class="lbl">Total WTax Applied</span>:</td>
                    <td class="lright"><span class="val"><?php echo number_format($totwtax,2); ?></span> / <span class="bal">(<?php echo number_format($taxbal,2) ?>)</span></td>
                </tr>
                <tr>
                    <td><span class="lbl">Total Provider Excess</span>:</td>
                    <td class="lright"><span class="val"><?php echo number_format($totproviderx,2); ?></span> / <span class="bal">(<?php echo number_format($providerbal,2) ?>)</span>
                    </td>
                </tr>
                <tr>
                    <td><span class="lbl">Total Member Excess</span>:</td>
                    <td class="lright"><span class="val"><?php echo number_format($totmemberx,2); ?></span> / <span class="bal">(<?php echo number_format($memberbal,2) ?>)</span>
                    </td>
                </tr>
            </table>
    </div>
    
</div>


 <br/>
 
<?php
if (!$hmo_bill):
?>
<script >
function submitSoano(){
    window.location = 'http://<?php echo $_SERVER["HTTP_HOST"] ?>/hmoarchecks/applysoaselect/'+check_id+'?billid='+$('#soano').val();
}
</script>
  
<div>
    <fieldset>
        <legend>Apply Check to Billing</legend>
    <span style="font-size:16px;">ENTER SOA No.:</span><input type="text" id="soano" name="soano" />
    <input type="button" value="Submit" onclick="submitSoano()" />
    </fieldset>
</div>
<br/>

<hr/>
<?php endif; ?> 
    
<h1 style="font-size:18px">- Transactions Applied to this Check - </h1>

<div>
    <div style="margin-top:10px">
         <?php
         $this->renderPartial('ajaxpaidtrnxs', array('model'=>$model), false, true);
         ?>
    </div>     
</div>

