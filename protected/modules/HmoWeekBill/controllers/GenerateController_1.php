<?php
class GenerateController extends Controller
{
    public function actionIndex()
    {
        $this->render('generate');     
    } 
    
    public function actionSubmit()
    {
        if ($_POST){
            //validate date
            $from_date = $_POST["from_date"];
            $to_date = $_POST["to_date"];
            $due_date = $_POST["due_date"];
            $today = date("Y-m-d",time()); 
            $error_flag = false;
            
            session_start();    
            
            if (strtotime($from_date) >= strtotime($today)){  
                 $_SESSION["errmsg"][] = "From date must not be later than today."; $error_flag = true;   
            }
            if (strtotime($from_date) == strtotime($to_date)){  
                 $_SESSION["errmsg"][] = "From date and To date must not be the same."; $error_flag = true;   
            }
            if (strtotime($from_date)  >  strtotime($to_date)){
                $_SESSION["errmsg"][] = "From date must be earlier than To date."; $error_flag = true;  
            }                 
            if (strtotime($due_date) <= strtotime($today)){  
                 $_SESSION["errmsg"][] = "Due date must be later than today."; $error_flag = true;   
            }               
            
            $connection=Yii::app()->db;                                       
            $query = "select count(id) as billcount from hmo_billing
                        where from_date = '$from_date'";            
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
            foreach($dataReader as $row) { 
                    $billcount = $row["billcount"];
            }
            if (intval($billcount) > 0){
                 $_SESSION["errmsg"][] = "Can't continue, this period is already processed. Consult the system admin if you wish to regenerate this period again."; $error_flag = true;   
            }
            
            if ($error_flag == true){
                $url = $_SERVER["HTTP_HOST"].Yii::app()->getHomeUrl() ;
                $this->redirect('http://'.$url.'/HmoWeekBill/generate?due_date='.$due_date.'&from_date='.$from_date.'&to_date='.$to_date);    
            }else{
                  $this->processGenerate($from_date, $to_date, $due_date);
            }
            
            
            
            
        }else{
            $this->render('generate');     
        }
    } 
    
    public function processGenerate($from_date, $to_date, $due_date){
            $connection=Yii::app()->db;                           
            $url = $_SERVER["HTTP_HOST"].Yii::app()->getHomeUrl() ;
            
            $query = "SELECT distinct hmo_id
                    FROM hmo_form_items a
                    left join hmo_form b
                    on a.hmo_form_id = b.id
                    where entry_date between '$from_date' and '$to_date'";
                    
            
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
            
            $rowcount = $dataReader->getRowCount();
            
            if ($rowcount > 0){
            
                    foreach($dataReader as $row) { 
                        $hmo_id = $row["hmo_id"];
                        $user = Yii::app()->getModule('user')->user();
                        $userid  = $user->id;
                        $profile=Yii::app()->getModule('user')->user()->profile;                
                        $prepared_by = $profile->first_name.' '.$profile->last_name;
                        
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
                                where entry_date between '$from_date 00:00:00' and '$to_date 23:59:59'
                                and hmo_id = $hmo_id";
                        $command=$connection->createCommand($query);    
                        $rowCount = $command->execute();
                        
                        //compute total                                 
                        $query = "select sum(charge_fee) as billtotal from 
                                    hmo_form_items 
                                    where hmo_form_id in ( 
                                    SELECT 
                                    id
                                    FROM hmo_form
                                    where entry_date between '$from_date 00:00:00' and '$to_date 23:59:59'
                                    and hmo_id = $hmo_id
                                     )";
                        $command=$connection->createCommand($query);
                        $dataReader=$command->query();
                    
                        foreach($dataReader as $row) { 
                            $billtotal = $row["billtotal"];
                        }
                        
                        //save total
                        $query = "UPDATE `hmo_billing`
                                    SET bill_total = $billtotal
                                         WHERE id = $hmo_bill_id 
                                    ";
                        $command=$connection->createCommand($query);    
                        $rowCount = $command->execute();                        
                        
                    }                           
                    
                    $this->redirect('http://'.$url.'/HmoBilling/admin');    
            }else{
                $_SESSION["errmsg"][] = "There's no transaction found for this period."; $error_flag = true;                   
                $this->redirect('http://'.$url.'/HmoWeekBill/generate?due_date='.$due_date.'&from_date='.$from_date.'&to_date='.$to_date);    
            }
                //save to log
                
                //prompt user the view
                
                

                
            
        
        
        
    }
}  
?>
