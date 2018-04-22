<?php
if ($_GET["billid"]){
    //select the bill record
    $hmo_bill = HmoBilling::model()->findByPk($_GET["billid"]);
    if ($hmo_bill->hmo_id != $model->hmo_id){
        echo "Billing HMO and Check HMO attributes does not match"; return;
    }

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

    <script>
        function changeBillid(){
            window.location = 'http://<?php echo $_SERVER["HTTP_HOST"] ?>/hmoarChecks/Applysoaselect/'+check_id+'?billid='+$('#soano').val();
        }
    </script>

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
                        'value'=> Hmo::model()->findByPk($hmo_bill->hmo_id)->name
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
                            <span style="font-size:16px;color:#333">Change Current SOA No.:</span><input type="text" id="soano" />
                            <input type="button" onclick="changeBillid()" value="Submit" />
                        </div>

                    </form>
                </div>
            <?php endif; ?>

        </div>
        <div style="float:left;width:50%">
            <div>-RECEIVED CHECK-</div>

            <?php
            $check_amount =  $model->check_amnt;
            $billed_amount =   $model->billed_amnt;
            $wtax_amount =   $model->wtax_amnt;
            $check_no = $model->check_no;
            $this->widget('zii.widgets.CDetailView', array(
                'data'=>$model,
                'attributes'=>array(
                    array(

                        'name'=>'Check No',
                        'value'=> $model->check_no
                    ),
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

                    array(

                        'name'=>'Check Amount',
                        'value'=>   number_format($model->check_amnt, 2)
                    ),
                    array(

                        'name'=>'Billed Amount',
                        'value'=>  number_format($model->billed_amnt, 2)
                    ),
                    array(

                        'name'=>'WTAX Amount',
                        'value'=>  number_format($model->wtax_amnt, 2)
                    )   ,
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
                    if($unapplied < 0 ) { $unapplied = 0; }
                    $totwtax = $recd["totwtax"];
                    $taxbal = floatval($model->wtax_amnt) - floatval($totwtax);
                    if($unapplied == 0 ) { $taxbal = 0; }
                    $totloss = $recd["totloss"];

                    $totproviderx = $recd["totproviderx"];
                    $providerbal = floatval($model->provider_xces) - floatval($totproviderx);

                    $totmemberx = $recd["totmemberx"];
                    $memberbal = floatval($model->member_xces) - floatval($totmemberx);

                    $tothmox = $recd["tothmox"];

                    $chck_total_left = $unapplied + $taxbal;
                    $chck_total_applied = $tot_apply + $totwtax;
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
                <tr ><td colspan="7"><hr><td></td>
                <tr>
                    <td><span class="lbl">Total Amount</span>:</td>
                    <td class="lright"><span class="val"><?php echo number_format($chck_total_applied,2); ?></span> / <span class="bal">(<?php echo number_format($chck_total_left,2) ?>)</span>
                    </td>
                </tr>
                <tr ><td colspan="7"><hr><td></td>
            </table>
            <div>
                <!--button onclick="applyToAll(2)" id='ataBtn' value="<?php //echo $_GET["billid"] ?>" >Apply to All (2%)</button>
                <button onclick="applyToAll(10)" id='ataBtn' value="<?php //echo $_GET["billid"] ?>" >Apply to All (10%)</button>
                <button onclick="applyToAll(15)" id='ataBtn' value="<?php //echo $_GET["billid"] ?>" >Apply to All (15%)</button-->
                <input id='unappliedTotal' type="hidden" value="<?php $unappliedall = $unapplied + $taxbal; echo round($unappliedall,2); ?>"></input>
                <input id='unappliedCheckAmount' type="hidden" value="<?php echo $unapplied ?>"></input>
                <input id='unappliedWtaxAmount' type="hidden" value="<?php echo $taxbal ?>"></input>
                <input id='unappliedCheckNo' type="hidden" value="<?php echo $check_no ?>"></input>

                <div id='status'></div>
            </div>
        </div>

    </div>


    <br/>

<?php
if (!$hmo_bill):
    ?>
    <script >
        function submitSoano(){
            window.location = '<?php echo $_SERVER["REQUEST_URI"] ?>?billid='+$('#soano').val();
        }
    </script>

    <div>
        <span style="font-size:16px;">ENTER SOA No.:</span><input type="text" id="soano" name="soano" />
        <input type="button" value="Submit" onclick="submitSoano()" />
    </div>



    <br/>
<?php endif; ?>

<?php
if ($hmo_bill):
    ?>
    <div id="midwrap" style="display: table;width:100%">
        <div id="unpaidwrap" style="float:left;width:100%;border:1px solid none;padding:3px;">



            <div style="margin-top:10px">
                <?php
                $this->renderPartial('ajaxsearchresult', array('model'=>$model), false, true);
                ?>
            </div>

        </div>
    </div>
<?php endif; ?>