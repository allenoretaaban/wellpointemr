<?php
class GenerateController extends Controller
{
    public function actionIndex()
    {
        $this->render('generate');     
    } 
    
    public function actionSubmit()
    {   
       
        $this->render('choose_hmos');     
        
    }
    
    public function actionProcess()
    {   
        
        if ($_POST){
            //validate date
            
            if (!$_POST["procids"]){
                echo "Error: No HMO company chosen to process";
                return;
            }
            
            $from_date = $_POST["from_date"];
            $to_date = $_POST["to_date"];
            $due_date = $_POST["due_date"];
            $today = date("Y-m-d",time()); 
            $error_flag = false;
            
            session_start();   
            $from_date_x = $from_date." 00:00:00";
            $to_date_x = $to_date." 11:59:59"; 
            
            /*if (strtotime($from_date_x) >= strtotime($to_date_x)){  
                 $_SESSION["errmsg"][] = "From date must not be later than today."; $error_flag = true;   
            }*/
            if (strtotime($from_date_x) == strtotime($to_date_x)){  
                 $_SESSION["errmsg"][] = "From date and To date must not be the same."; $error_flag = true;   
            }
            if (strtotime($from_date_x)  >  strtotime($to_date_x)){
                $_SESSION["errmsg"][] = "From date must be earlier than To date."; $error_flag = true;  
            }                 
            if (strtotime($due_date) <= strtotime($today)){  
                 $_SESSION["errmsg"][] = "Due date must be later than today."; $error_flag = true;   
            }               
            
            $connection=Yii::app()->db;           
            
            //validate if date period is processed                            
            /*$query = "select count(id) as billcount from hmo_billing
                        where from_date = '$from_date'";            
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
            foreach($dataReader as $row) { 
                    $billcount = $row["billcount"];
            }
            if (intval($billcount) > 0){
                 $_SESSION["errmsg"][] = "Can't continue, this period is already processed. Consult the system admin if you wish to regenerate this period again."; 
                 $error_flag = true;   
            }*/
            
            
            if ($error_flag == true){
                $url = $_SERVER["HTTP_HOST"].Yii::app()->getHomeUrl() ;
                $this->redirect('http://'.$url.'/HmoWeekBill/generate?due_date='.$due_date.'&from_date='.$from_date.'&to_date='.$to_date);    
            }else{
                //process if true
                  $this->processGenerate($from_date, $to_date, $due_date, $_POST["procids"]);
            }
            
            
            
            
        }else{
            $this->render('generate');     
        }
    } 
    
    public function processGenerate($from_date, $to_date, $due_date, $hmoids){
        
        $connection=Yii::app()->db;                           
        $url = $_SERVER["HTTP_HOST"].Yii::app()->getHomeUrl() ;
        $user = Yii::app()->getModule('user')->user();
        $userid  = $user->id;
        $profile=Yii::app()->getModule('user')->user()->profile;                
        $prepared_by = $profile->first_name.' '.$profile->last_name;
        
        foreach ($hmoids as $hmo_id){
                        
                        $query = "INSERT INTO `hmo_billing` (                                        
                                                `hmo_id`, 
                                                `from_date`, 
                                                `date_prepared`, 
                                                `date_due`, 
                                                `to_date`, 
                                                `prepared_by`, 
                                                `by_userid`                                        
                                                ) 
                                            VALUES 
                                                ($hmo_id, 
                                                '$from_date', 
                                                NOW(), 
                                                '$due_date', 
                                                '$to_date', 
                                                '$prepared_by', 
                                                $userid);";
                        $command=$connection->createCommand($query);    
                        $rowCount = $command->execute();
                        $hmo_bill_id = Yii::app()->db->getLastInsertID();
                        
                        //get hmo transactions for the HMO company, hmo_id, entry_date
                        
                        //update all concerns billing items
                        $query = "update hmo_form
                                set 
                                hmo_billing_id = $hmo_bill_id
                                where `hmo_id` = $hmo_id and `entry_date` between '$from_date 00:00:00' and '$to_date 23:59:59' ";
                        $command=$connection->createCommand($query);    
                        $rowCount = $command->execute();
                        
                        //compute total                                 
                        $query = "select sum(charge_fee) as billtotal from 
                                    hmo_form_items 
                                    where hmo_form_id in ( 
                                    SELECT 
                                    id
                                    FROM hmo_form
                                    where hmo_id = $hmo_id and entry_date between '$from_date 00:00:00' and '$to_date 23:59:59'
                                    )";
                        $command=$connection->createCommand($query);
                        $dataReader=$command->query();
                    
                        foreach($dataReader as $row) { 
                            $billtotal = floatval($row["billtotal"]);
                        }

                        //update all billing category items                            
                        $query = "select itemid as item_id from hmo_form_items where hmo_form_id in ( 
                                    SELECT id FROM hmo_form
                                    where hmo_id = $hmo_id and entry_date between '$from_date 00:00:00' and '$to_date 23:59:59'
                                    )";
                        $command=$connection->createCommand($query);
                        $dataReader=$command->query();
                        foreach($dataReader as $row) { 
                            $queryc = "update hmo_form_items_category set  hmo_billing_id = $hmo_bill_id where `hmo_form_item_id` = ".$row["item_id"];
                            $commandc=$connection->createCommand($queryc); $commandc->execute();
                        }
                        
                        //save total
                        $query = "UPDATE `hmo_billing`
                                    SET bill_total = $billtotal
                                         WHERE id = $hmo_bill_id 
                                    ";
                        $command=$connection->createCommand($query);    
                        $rowCount = $command->execute();                        
                        
                    
        }
          
          $this->redirect('http://'.$url.'/Hmobilling/admin');    
          
          /*
            }else{
                $_SESSION["errmsg"][] = "There's no transaction found for this period."; $error_flag = true;                   
                $this->redirect('http://'.$url.'/HmoWeekBill/generate?due_date='.$due_date.'&from_date='.$from_date.'&to_date='.$to_date);    
            }*/
                //save to log
                
                //prompt user the view
                
                

                
            
        
        
        
    }
}  
?>
