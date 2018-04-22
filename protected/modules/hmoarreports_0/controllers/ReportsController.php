<?php
class ReportsController extends Controller
{
    
    public function actionArsum()
    {
        $this->render('arsummary');
    }
    
    public function actionBcreport(){
        $task = $_GET["task"];
        
        switch ($task){
            case "doctrnxs":
                $this->render('bc2_doctrnxs');
                
            break;
            case "docgenerate":
                $this->render('bc2_docgenerate');
                
            break;
            case "docparams":
                $this->render('bc2_docparams');
                break;
            
            case "trnxs":                
                $billid = $_GET["billid"];
                
                $this->render('bc1_trnxs');
                
            break;
            
            case "generate":
                $hmoid = $_GET["hmoid"];
                $dstart = $_GET["start"];
                $dend = $_GET["end"];
                
                $this->render('bc1_generate');
                
            break;
            default:
                $this->render('bc1_params');
            break;
        }
    }
    
    public function customLinks($data,$row){
        echo "<a href='http://".$_SERVER["HTTP_HOST"]."/hmoarreports/reports/bcreport?task=trnxs&billid=".$data->id."'>View Trnxs</a>";
    }
    
    public function docCustomLinks($data,$row){
        $dstart  = $_GET["start"];
            $dend  = $_GET["end"];
        echo "<a href='http://".$_SERVER["HTTP_HOST"]."/hmoarreports/reports/bcreport?task=doctrnxs&docid=".$data->id."&start=".$dstart."&end=".$dend."'>View Trnxs</a>";
    }
    
    public function getPaidTotal($data,$row){            
            $connection=Yii::app()->db;  
            $query ="select sum(a.paid_amnt) as totpaid
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                left join hmo_form c
                on b.hmo_form_id = c.id
                where c.hmo_id = ".$data->hmo_id. " and c.hmo_billing_id = ".$data->id;
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    if (floatval($recd["totpaid"]) > 0){
                        echo number_format($recd["totpaid"], 2);    
                    }else{
                        echo "0.00";
                    }
                    
                }
            }
    }
    
    public function getWtaxTotal ($data,$row){
            $connection=Yii::app()->db;  
            $query ="select sum(a.wtax) as totwtax
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                left join hmo_form c
                on b.hmo_form_id = c.id
                where c.hmo_id = ".$data->hmo_id. " and c.hmo_billing_id = ".$data->id;
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    
                    if (floatval($recd["totwtax"]) > 0){
                        echo number_format($recd["totwtax"], 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }
        
    }
    
    public function getLossTotal ($data,$row){
            $connection=Yii::app()->db;  
            $query ="select sum(a.loss) as totloss
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                left join hmo_form c
                on b.hmo_form_id = c.id
                where c.hmo_id = ".$data->hmo_id. " and c.hmo_billing_id = ".$data->id;
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    
                    if (floatval($recd["totloss"]) > 0){
                        echo number_format($recd["totloss"], 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }
        
    }
    
    public function getBalance ($data,$row){
            $connection=Yii::app()->db;  
            $query ="select c.hmo_billing_id, sum(a.paid_amnt) as totpaid,
                sum(a.wtax) as tottax,
                sum(a.loss) as totloss
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                left join hmo_form c
                on b.hmo_form_id = c.id
                where c.hmo_id = ".$data->hmo_id. " and c.hmo_billing_id = ".$data->id;
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    $tmp_paidtot = floatval($recd["totpaid"]) + floatval($recd["tottax"]) + floatval($recd["totloss"]);
                    $receivable = floatval($data->bill_total) - $tmp_paidtot;
                    if ($receivable > 0){
                        echo number_format($receivable, 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }
        
    }
    
    //Transaction info
    
     public function getTrnxBalance ($data,$row){
            $connection=Yii::app()->db;  
            $query ="select sum(a.paid_amnt) as totpaid,
                sum(a.wtax) as tottax,
                sum(a.loss) as totloss
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$data->itemid;
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    $tmp_paidtot = floatval($recd["totpaid"]) + floatval($recd["tottax"]) + floatval($recd["totloss"]);
                    $receivable = floatval($data->charge_fee) - $tmp_paidtot;
                    if ($receivable > 0){
                        echo number_format($receivable, 2);    
                    }else{
                        echo number_format($receivable, 2);
                    }
                }
            }         
    }
    
    public function getTrnxPaidTotal($data,$row){            
            $connection=Yii::app()->db;  
            $connection=Yii::app()->db;  
            $query ="select sum(a.paid_amnt) as totpaid
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$data->itemid;
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    if (floatval($recd["totpaid"]) > 0){
                        echo number_format($recd["totpaid"], 2);    
                    }else{
                        echo "0.00";
                    }
                    
                }
            }
    }
    
    public function getTrnxWtaxTotal ($data,$row){
            $connection=Yii::app()->db;  
            $query ="select sum(a.wtax) as totwtax
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$data->itemid;
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    
                    if (floatval($recd["totwtax"]) > 0){
                        echo number_format($recd["totwtax"], 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }   
    }
    
    public function getTrnxLossTotal ($data,$row){
            $connection=Yii::app()->db;  
            $query ="select sum(a.loss) as totloss
                from hmoar_chkapply a
                left join hmo_form_items b
                on a.form_itemid = b.itemid
                where a.form_itemid = ".$data->itemid;
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    
                    if (floatval($recd["totloss"]) > 0){
                        echo number_format($recd["totloss"], 2);    
                    }else{
                        echo "0.00";
                    }
                }
            }
        
    }
    
    //Doctors
    public function getDocBilled ($data,$row){
        $connection=Yii::app()->db;
            $dstart  = $_GET["start"];
            $dend  = $_GET["end"];
            $query ="select sum(c.charge_fee) as bill_total            
                    from               
                    (                  
                    select b.avail_date, a.payto, a.claim_doctor_id, a.claim_doctor_name, a.charge_fee 
                    from hmo_form_items a                  
                    left join hmo_form b                  
                    on a.hmo_form_id = b.id                  
                    where             
                    a.claim_doctor_id = ".$data->id."
                    and     
                    a.payto = 'DOCTOR'                    
                    and                   
                    b.avail_date 
                    between                   
                    '$dstart' and '$dend'              
                    ) c ";
             $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) {
                    echo number_format($recd["bill_total"], 2); 
                }
            }         
    }
    
    public function getDocBalance ($data,$row){
            $connection=Yii::app()->db;
            $dstart  = $_GET["start"];
            $dend  = $_GET["end"];
            $query ="select sum(c.charge_fee) as bill_total            
                    from               
                    (                  
                    select b.avail_date, a.payto, a.claim_doctor_id, a.claim_doctor_name, a.charge_fee 
                    from hmo_form_items a                  
                    left join hmo_form b                  
                    on a.hmo_form_id = b.id                  
                    where             
                    a.claim_doctor_id = ".$data->id."
                    and     
                    a.payto = 'DOCTOR'                    
                    and                   
                    b.avail_date 
                    between                   
                    '$dstart' and '$dend'              
                    ) c ";
             $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) {
                    $billtotal = floatval($recd["bill_total"]); 
                }
            }         
        
            
            $query ="SELECT sum(a.paid_amnt) as totpaid,    
                      sum(a.wtax) as tottax,      
                      sum(a.loss) as totloss      
                      from hmoar_chkapply a      
                        left join hmo_form_items b      
                            on a.form_itemid = b.itemid      
                        left join hmo_form c      
                            on b.hmo_form_id = c.id            
                        where
                        b.claim_doctor_id = ".$data->id."
                        and
                        b.payto = 'DOCTOR'  
                        and 
                        c.avail_date between '$dstart' and '$dend'   ";
            
            $command=$connection->createCommand($query);
            $datareader=$command->query();
            if ($datareader){
                foreach($datareader as $recd) { 
                    $tmp_paidtot = floatval($recd["totpaid"]) + floatval($recd["tottax"]) + floatval($recd["totloss"]);
                    $receivable = floatval($billtotal) - $tmp_paidtot;
                    echo number_format($tmp_paidtot, 2) ." / ". number_format($receivable, 2);
                }
            }         
    }
    
}
?>
