<?php

class HmoBillingController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		 return array(
            'rights', // perform access control for CRUD operations
        );
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
    
    public function actionExportToExcelcategory(){
        $this->actionPrintbillingcategory(true);
    }
    
    public function actionExportToExcel(){
        $this->actionPrintBilling(true);
    }
    
    public function actionPrintBilling($to_excel = false)
    {
        if($_GET){
            $connection=Yii::app()->db; 
            $billing_id =  $_GET["id"];
            $billing = HmoBilling::model()->findByPk((int)$billing_id );             
            $hmo = Hmo::model()->findByPk($billing->hmo_id);
            
            $hmo_add = $hmo->street1."<br/>".$hmo->street2.", ".$hmo->barangay."<br/>".$hmo->city.", ".$hmo->province;
            $url = Yii::app()->getBasePath() ;         
            $print = implode("", file(Yii::app()->getBasePath().'/html/hmobilling.html'));
            $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';

            $settings = Settings::model()->findByPk(1);   
            $print = str_replace("[bacoor_address_html]",$settings->bacoor_address_html,$print);
            $print = str_replace("[dasma_address_html]",$settings->dasma_address_html,$print);
            $print = str_replace("[address]",$settings->address,$print);

            $print = str_replace("[logopath]",$logo,$print);
            $print = str_replace("[HMO]",$hmo->name,$print);
            
            $print = str_replace("[HMO_add]",$hmo_add,$print);                        
            $print = str_replace("[date_prepared]",date("Y-M-d",strtotime($billing->date_prepared) ), $print);                        
            $print = str_replace("[due_date]",date("Y-M-d",strtotime($billing->date_due) ),$print);                                    
            
            //SOA No.
            $print = str_replace("[soa_no]","WPD-".$billing_id,$print);
            
            //get the bill items
            $bill_items = "";             
            /*$query = "select a.avail_date,   
                        b.payto,
                        a.patient_name,
                        b.claim_doctor_name,
                        b.diagnosis,
                        b.med_service,
                        b.charge_type,
                        b.charge_fee
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id";  */
                        
             $query = "select a.itemid,
                        b.avail_date,
                        b.patient_name,
                        a.payto,
                        a.claim_doctor_name,
                        a.diagnosis,
                        a.med_service,
                        a.service_type,
                        a.req_doctor,
                        a.charge_type,
                        a.charge_fee

                         from hmo_form_items a
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        where a.hmo_form_id in 
                        (
                        select id from hmo_form where
                        hmo_billing_id = $billing_id
                        )
                        order by a.itemid asc";
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
            foreach($dataReader as $row) { 
                $holder = "<tr>";
                    $holder .= "<td>".$row["avail_date"]."</td>";
                    $holder .= "<td>".$row["patient_name"]."</td>";
                    $holder .= "<td>".$row["claim_doctor_name"]."</td>";
                    $holder .= "<td>".$row["diagnosis"]."</td>";
                    $holder .= "<td>".$row["med_service"]."</td>";                    
                    
                    if ($row["charge_type"] == "CCHARGE" ){
                        $holder .= "<td class='money' >".number_format($row["charge_fee"], 2)."</td>";
                        $holder .= "<td class='money' >&nbsp;</td>";
                        $holder .= "<td class='money' >&nbsp;</td>";
                        
                    }else if ($row["charge_type"] == "PROCEDURE" ){                        
                        $holder .= "<td class='money' >&nbsp;</td>";
                        $holder .= "<td class='money'>".number_format($row["charge_fee"], 2)."</td>";
                        $holder .= "<td class='money'>&nbsp;</td>";
                        
                    } else if ($row["charge_type"] == "PROF_FEE" ){
                        $holder .= "<td class='money'>&nbsp;</td>";                        
                        $holder .= "<td class='money'>&nbsp;</td>";
                        $holder .= "<td class='money' >".number_format($row["charge_fee"], 2)."</td>";                        
                    }
                    
                $holder .= "</tr>";
                $bill_items.= $holder;
                
            }            
            
            //compute clinic charge total
            $query = "select sum(b.charge_fee) as clinic_charge_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id 
                        and b.charge_type = 'CCHARGE'";                                                                              
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $clinic_charge_sum = number_format($row["clinic_charge_sum"],2);
            }
            $print = str_replace("[cc]",$clinic_charge_sum,$print);    
            
            //compute doctors procedure total
            $query = "select sum(b.charge_fee) as doc_proc_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id 
                        and b.charge_type = 'PROCEDURE'";                                                                              
                                                                     
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $doc_proc_sum = number_format($row["doc_proc_sum"],2);
            }
            $print = str_replace("[dp]",$doc_proc_sum,$print);    
            
            //compute prof fee total
            $query = "select sum(b.charge_fee) as prof_fee_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id 
                        and b.charge_type = 'PROF_FEE'";     
                                                         
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $prof_fee_sum = number_format($row["prof_fee_sum"],2);
            }
            $print = str_replace("[pf]",$prof_fee_sum,$print);
            
            
            //compute total  
            $query = "select sum(b.charge_fee) as billtotal 
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id ";                                    
            
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $billtotal = number_format($row["billtotal"],2);
            }
            $print = str_replace("[gt]",$billtotal,$print);                              
            
            $print = str_replace("[bill_items]",$bill_items, $print);                                    
            
            /*$profile = Profile::model()->findByAttributes(array("user_id"=>$billing->by_userid));
            $prepared_by = $profile->first_name.' '.$profile->last_name;                     
            */
            $command=$connection->createCommand("select * from hmo_form_items_category where hmo_billing_id = $billing_id");
            $dataReader=$command->query();

            $aes = $ape = $lab = $raa = $rmap = $others = $med = $meddx = $medcx = 0;
            $aesc = $apec = $labc = $raac = $rmapc = $othersc = $medc = $meddxc = $medcxc = 0;

            $daes = $dape = $dlab = $draa = $drmap = $dothers = $dmed = $dmeddx = $dmedcx = 0;
            $daesc = $dapec = $dlabc = $draac = $drmapc = $dothersc = $dmedc = $dmeddxc = $dmedcxc = 0;

            foreach($dataReader as $row) { 
                if($row['category'] != "Annual Physical Exam") {
                        $adder = $this->countCategories($row['med_service']);
                }else{
                    if(substr($row['med_service'], 0, 5) == "Basic"){
                        $adder = 1;
                    }else{
                        $adder = $this->countCategories($row['med_service']);
                    }
                }
                if($row['payto'] == 'DOCTOR'){
                    switch($row['category']){
                        case 'Aesthetics': $daes = $daes + $adder; $daesc = $daesc + $row['amount']; break;
                        case 'Annual Physical Exam': $dape = $dape + $adder; $dapec = $dapec + $row['amount']; break;
                        case 'Laboratory': $dlab = $dlab + $adder; $dlabc = $dlabc + $row['amount']; break;
                        case 'Consultation': $dmed = $dmed + $adder; $dmedc = $dmedc + $row['amount']; break;
                        case 'Medical':
                        case 'Medical Clinic': $dmed = $dmed + $adder; $dmedc = $dmedc + $row['amount']; break;
                        case 'Clinic Procedure':$dmed = $dmed + $adder; $dmedc = $dmedc + $row['amount']; break;
                        //case 'Clinic Procedure':$dmedcx++; $dmedcxc = $dmedcxc + $row['amount'];break;
                        case 'Doctors Procedure':
                        case 'Doctors and Procedures': $dmeddx = $dmeddx + $adder; $dmeddxc = $dmeddxc + $row['amount']; break;
                        case 'Radiology and Ancillary': $draa = $draa + $adder; $draac = $draac + $row['amount']; break;
                        case 'Rehabilitation Medicine And Physical Therapy': $draa = $draa + $adder; $drmapc = $drmapc + $row['amount']; break;
                        default: $dothers = $dothers + $adder; $dothersc = $dothersc + $row['amount']; break;
                    }
                }else{
                    switch($row['category']){
                        case 'Aesthetics': $aes = $aes + $adder; $aesc = $aesc + $row['amount']; break;
                        case 'Annual Physical Exam': $ape = $ape + $adder; $apec = $apec + $row['amount']; break;
                        case 'Laboratory': $lab = $lab + $adder; $labc = $labc + $row['amount']; break;
                        case 'Consultation': $med = $med + $adder; $medc = $medc + $row['amount']; break;
                        case 'Medical':
                        case 'Medical Clinic': $med = $med + $adder; $medc = $medc + $row['amount']; break;
                        case 'Clinic Procedure': $med = $med + $adder; $medc = $medc + $row['amount']; break;
                        //case 'Clinic Procedure':$medcx++; $medcxc = $medcxc + $row['amount'];break;
                        case 'Doctors Procedure':
                        case 'Doctors and Procedures': $meddx = $meddx + $adder; $meddxc = $meddxc + $row['amount']; break;
                        case 'Radiology and Ancillary': $raa = $raa + $adder; $raac = $raac + $row['amount']; break;
                        case 'Rehabilitation Medicine And Physical Therapy': $rmap = $rmap + $adder; $rmapc = $rmapc + $row['amount']; break;
                        default: $others = $others + $adder; $othersc = $othersc + $row['amount']; break;
                    }                
                }

            }

            // get total count and amount of uncategorized items 
            $command = $connection->createCommand("select id from hmo_form where hmo_billing_id = $billing_id");
            $dataReaderCatHF = $command->query();
            $additionalOthersAmount = 0;
            $additionalOthersCount = 0;
            foreach($dataReaderCatHF as $rowHF) { 
                $idHF = $rowHF['id'];
                $command = $connection->createCommand("select itemid,charge_fee from hmo_form_items where hmo_form_id = $idHF and is_categorized = 0");
                $dataReaderCatHFI = $command->query();
                if($dataReaderCatHFI){
                    foreach ($dataReaderCatHFI as $rowHFI) {
                        $additionalOthersAmount = $additionalOthersAmount+$rowHFI['charge_fee'];
                        $additionalOthersCount++;
                    }
                }
            }
            $others = $others + $additionalOthersCount;
            $othersc = $othersc + $additionalOthersAmount;

            // compute values in category
            $catTotal = $aes+$ape+$lab+$raa+$rmap+$med+$meddx+$medcx+$others;
            $catTotalc = $aesc+$apec+$labc+$raac+$rmapc+$medc+$meddxc+$medcxc+$othersc; 
            $dcatTotal = $daes+$dape+$dlab+$draa+$drmap+$dmed+$dmeddx+$dmedcx+$dothers;
            $dcatTotalc = $daesc+$dapec+$dlabc+$draac+$drmapc+$dmedc+$dmeddxc+$dmedcxc+$dothersc; 

            //$catTotal = $catTotal + $dcatTotal;
            $catTotalc = $catTotalc + $dcatTotalc;
            $catTotalc = number_format($catTotalc,2);

            $aesc = $aesc + $daesc; $aesc = number_format($aesc,2);
            $apec = $apec + $dapec; $apec = number_format($apec,2);
            $labc = $labc + $dlabc; $labc = number_format($labc,2);
            $medc = $medc + $dmedc; $medc = number_format($medc,2);
            $meddxc = $meddxc + $dmeddxc; $meddxc = number_format($meddxc,2);
            $medcxc = $medcxc + $dmedcxc; $medcxc = number_format($medcxc,2);
            $raac = $raac + $draac; $raac = number_format($raac,2);
            $rmapc = $rmapc + $drmapc; $rmapc = number_format($rmapc,2);
            $othersc = $othersc + $dothersc; $othersc = number_format($othersc,2);

            $daesc = number_format($daesc,2);
            $dapec = number_format($dapec,2);
            $dlabc = number_format($dlabc,2);
            $dmedc = number_format($dmedc,2);
            $dmeddxc = number_format($dmeddxc,2);
            $dmedcxc = number_format($dmedcxc,2);
            $draac = number_format($draac,2);
            $drmapc = number_format($drmapc,2);
            $dothersc = number_format($dothersc,2);

            $category_content = "<tr><td>Aesthetics</td><td align='right'>$aes</td><td align='right'>$daes</td><td align='right'>$aesc</td></tr>";
            $category_content .= "<tr><td>Annual Physical Exam</td><td align='right'>$ape</td><td align='right'>$dape</td><td align='right'>$apec</td></tr>";
            $category_content .= "<tr><td>Doctors and Procedures</td><td align='right'>$meddx</td><td align='right'>$dmeddx</td><td align='right'>$meddxc</td></tr>";
            $category_content .= "<tr><td>Laboratory</td><td align='right'>$lab</td><td align='right'>$dlab</td><td align='right'>$labc</td></tr>";
            $category_content .= "<tr><td>Medical Clinic</td><td align='right'>$med</td><td align='right'>$dmed</td><td align='right'>$medc</td></tr>";
            //$category_content .= "<tr><td>Medical </td><td align='right'>$medcx</td><td></td><td align='right'>$medcxc</td></tr>";
            $category_content .= "<tr><td>Radiology and Ancillary</td><td align='right'>$raa</td><td align='right'>$draa</td><td align='right'>$raac</td></tr>";
            $category_content .= "<tr><td>Rehabilitation Medicine And Physical Therapy</td><td align='right'>$rmap</td><td align='right'>$drmap</td><td align='right'>$rmapc</td></tr>";
            $category_content .= "<tr><td>Others</td><td align='right'>$others</td><td align='right'>$dothers</td><td align='right'>$othersc</td></tr>";
            $category_content .= "<tr><td><b>Total</b></td><td align='right'><b>$catTotal</b></td><td align='right'>$dcatTotal</td><td align='right'><b>$catTotalc</b></td></tr>";
            $print = str_replace("[category_content]",$category_content,$print);

            $profile=Yii::app()->getModule('user')->user()->profile;                
            $prepared_by = $profile->first_name.' '.$profile->last_name;
            $print = str_replace("[preparedy_by]",$prepared_by,$print);
            
            if ($to_excel == true){
                    $filename = "HMO_Billing_$billing_id.xls";
                    header("Content-Disposition: attachment; filename=\"$filename\""); 
                    header("Content-Type: application/vnd.ms-excel");
                    echo $print;
            }else{
                echo "<button class='noprint' onclick=\"window.location = '../exporttoexcel/$billing_id'\" value='' >Export to Excel</button><br>";
                echo "<button style='margin:5px 0px 0px 0px;' class='noprint' onclick=\"window.print()\" value='' >Print</button>";
                //<input class="noprint" type="button" value="Print" onclick="window.print()">
                echo $print;
            }
            
        }
    } 

    public function actionPrintbillingcategory($to_excel = false)
    {
        if($_GET){
            $connection=Yii::app()->db; 
            $billing_id =  $_GET["id"];
            $billing = HmoBilling::model()->findByPk((int)$billing_id );             
            $hmo = Hmo::model()->findByPk($billing->hmo_id);
            
            $hmo_add = $hmo->street1."<br/>".$hmo->street2.", ".$hmo->barangay."<br/>".$hmo->city.", ".$hmo->province;
            $url = Yii::app()->getBasePath() ;         
            $print = implode("", file(Yii::app()->getBasePath().'/html/hmobilling.category.html'));
            $logo = 'http://'.$_SERVER["HTTP_HOST"].'/images/printdiagresult/wpprintlogo.png';

            $settings = Settings::model()->findByPk(1);   
            $print = str_replace("[bacoor_address_html]",$settings->bacoor_address_html,$print);
            $print = str_replace("[dasma_address_html]",$settings->dasma_address_html,$print);
            $print = str_replace("[address]",$settings->address,$print);

            $print = str_replace("[logopath]",$logo,$print);
            $print = str_replace("[HMO]",$hmo->name,$print);
            
            $print = str_replace("[HMO_add]",$hmo_add,$print);                        
            $print = str_replace("[date_prepared]",date("Y-M-d",strtotime($billing->date_prepared) ), $print);                        
            $print = str_replace("[due_date]",date("Y-M-d",strtotime($billing->date_due) ),$print);                                    
            
            //SOA No.
            $print = str_replace("[soa_no]","WPD-".$billing_id,$print);
            
            //get the bill items
            $bill_items = "";             
            /*$query = "select a.avail_date,   
                        b.payto,
                        a.patient_name,
                        b.claim_doctor_name,
                        b.diagnosis,
                        b.med_service,
                        b.charge_type,
                        b.charge_fee
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id";  */
            $hom_form_ids_arr = array();
            $command=$connection->createCommand("select id from hmo_form where hmo_billing_id = $billing_id");
            $dataReaderIns=$command->query();
            if($dataReaderIns){
                foreach($dataReaderIns as $rowIns){
                    $hom_form_ids_arr[] = $rowIns["id"];
                }
            }
            $hom_form_ids_string = implode(",",$hom_form_ids_arr);
                        
             $query = "select a.itemid,
                        b.avail_date,
                        b.patient_name,
                        a.payto,
                        a.claim_doctor_name,
                        a.diagnosis,
                        a.med_service,
                        a.service_type,
                        a.req_doctor,
                        a.charge_type,
                        a.charge_fee,
                        a.is_categorized

                         from hmo_form_items a
                        left join hmo_form b
                        on a.hmo_form_id = b.id
                        where a.hmo_form_id in 
                        (
                            $hom_form_ids_string
                        )
                        order by a.itemid asc";
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
            $aesT = $apeT = $medT = $radT = $labT = $ptT = $othT = $docT = 0;

            $aes = $ape = $lab = $raa = $rmap = $others = $med = $meddx = $medcx = 0;
            $aesc = $apec = $labc = $raac = $rmapc = $othersc = $medc = $meddxc = $medcxc = 0;

            $daes = $dape = $dlab = $draa = $drmap = $dothers = $dmed = $dmeddx = $dmedcx = 0;
            $daesc = $dapec = $dlabc = $draac = $drmapc = $dothersc = $dmedc = $dmeddxc = $dmedcxc = 0;

            foreach($dataReader as $row) { 
                $holder = "<tr>";
                    $holder .= "<td>".$row["avail_date"]."</td>";
                    $holder .= "<td>".$row["patient_name"]."</td>";
                    $holder .= "<td>".$row["claim_doctor_name"]."</td>";
                    $holder .= "<td>".$row["diagnosis"]."</td>";
                    $holder .= "<td>".$row["med_service"]."</td>";  

                    $apeR = $medR = $radR = $labR = $ptR = $othR = $docR = 0;
                    $is_categorized = $row['is_categorized'];
                    if($is_categorized == 1){
                        $command=$connection->createCommand("select hmo_form_item_id,amount,category,payto from hmo_form_items_category where hmo_form_item_id = ".$row['itemid']);
                        $dataReaderHFIC=$command->query();
                        if($dataReaderHFIC){
                            foreach ($dataReaderHFIC as $rowHFIC) {
                                $adder = 0;
                                if($rowHFIC['category'] != "Annual Physical Exam") {
                                    $adder = $this->countCategories($rowHFIC['med_service']);
                                }else{
                                    if(substr($row['med_service'], 0, 5) == "Basic"){
                                        $adder = 1;
                                    }else{
                                        $adder = $this->countCategories($rowHFIC['med_service']);
                                    }
                                }

                                switch($rowHFIC["category"]){
                                    case "Aesthetics":
                                        $apeR = $apeR+$rowHFIC["amount"];
                                        if($rowHFIC['payto']=='DOCTOR'){$daesc=$daesc+$adder;}else{$aesc=$aesc+$adder;}
                                        break;
                                    case "Annual Physical Exam":
                                        $apeR = $apeR+$rowHFIC["amount"];
                                        if($rowHFIC['payto']=='DOCTOR'){$dapec=$dapec+$adder;}else{$apec=$apec+$adder;}
                                        break;
                                    case "Laboratory":
                                        $labR = $labR+$rowHFIC["amount"];
                                        if($rowHFIC['payto']=='DOCTOR'){$dlabc=$dlabc+$adder;}else{$labc=$labc+$adder;}
                                        break;
                                    case "Consultation":
                                    case "Medical":
                                    case "Medical Clinic":
                                    case "Clinic Procedure":
                                        $medR = $medR+$rowHFIC["amount"];
                                        if($rowHFIC['payto']=='DOCTOR'){$dmedc=$dmedc+$adder;}else{$medc=$medc+$adder;}
                                        break;
                                    case "Radiology and Ancillary":
                                        $radR = $radR+$rowHFIC["amount"];
                                        if($rowHFIC['payto']=='DOCTOR'){$draac=$draac+$adder;}else{$raac=$raac+$adder;}
                                        break;
                                    case "Doctors Procedure":
                                    case "Doctors and Procedures":
                                        $docR = $docR+$rowHFIC["amount"];
                                        if($rowHFIC['payto']=='DOCTOR'){$dmeddxc=$dmeddxc+$adder;}else{$meddxc=$meddxc+$adder;}
                                        break;
                                    case "Rehabilitation Medicine And Physical Therapy":
                                        $ptR = $ptR+$rowHFIC["amount"];
                                        if($rowHFIC['payto']=='DOCTOR'){$drmapc=$drmapc+$adder;}else{$rmapc=$rmapc+$adder;}
                                        break;
                                    default:
                                        $othR = $othR+$rowHFIC["amount"];
                                        if($rowHFIC['payto']=='DOCTOR'){$dothersc=$dothersc+$adder;}else{$othersc=$othersc+$adder;}
                                        break;
                                }
                            }
                        }
                    }else{
                        $oth = $oth+$row["charge_fee"];
                    }

                    // totals
                    $aesT = $aesT+$aesR;
                    $apeT = $apeT+$apeR;
                    $medT = $medT+$medR;
                    $radT = $radT+$radR;
                    $labT = $labT+$labR;
                    $ptT = $ptT+$ptR;
                    $docT = $docT+$docR;
                    $othT = $othT+$othR;

                    // items
                    if($aesR != 0) { $aesR = number_format($aesR,2); }else{ $aesR = ""; }
                    if($apeR != 0) { $apeR = number_format($apeR,2); }else{ $apeR = ""; }
                    if($medR != 0) { $medR = number_format($medR,2); }else{ $medR = ""; }
                    if($radR != 0) { $radR = number_format($radR,2); }else{ $radR = ""; }
                    if($labR != 0) { $labR = number_format($labR,2); }else{ $labR = ""; }
                    if($ptR != 0) { $ptR = number_format($ptR,2); }else{ $ptR = ""; }
                    if($docR != 0) { $docR = number_format($docR,2); }else{ $docR = ""; }
                    if($othR != 0) { $othR = number_format($othR,2); }else{ $othR = ""; }

                    $holder .= "<td class='money'>$apeR</td>";  
                    $holder .= "<td class='money'>$docR</td>";  
                    $holder .= "<td class='money'>$labR</td>";  
                    $holder .= "<td class='money'>$medR</td>"; 
                    $holder .= "<td class='money'>$radR</td>"; 
                    $holder .= "<td class='money'>$ptR</td>";   
                    $holder .= "<td class='money'>$othR</td>";  

                    
                    if ($row["charge_type"] == "CCHARGE" ){
                        $holder .= "<td class='money' >".number_format($row["charge_fee"], 2)."</td>";
                        $holder .= "<td class='money' >&nbsp;</td>";
                        $holder .= "<td class='money' >&nbsp;</td>";
                        
                    }else if ($row["charge_type"] == "PROCEDURE" ){                        
                        $holder .= "<td class='money'>&nbsp;</td>";
                        $holder .= "<td class='money'>".number_format($row["charge_fee"], 2)."</td>";
                        $holder .= "<td class='money'>&nbsp;</td>";
                        
                    } else if ($row["charge_type"] == "PROF_FEE" ){
                        $holder .= "<td class='money'>&nbsp;</td>";                        
                        $holder .= "<td class='money'>&nbsp;</td>";
                        $holder .= "<td class='money' >".number_format($row["charge_fee"], 2)."</td>";                        
                    }
                    
                $holder .= "</tr>";
                $bill_items.= $holder;
                
            }    

            $cgT = $aesT + $apeT + $medT + $radT + $labT + $ptT + $othT + $docT;
            if($cgT != 0) { $cgT = number_format($cgT,2); }else{ $cgT = ""; }
            $print = str_replace("[cgt]",$cgT,$print);  

            if($aesT != 0) { $aesT = number_format($aesT,2); }else{ $aesT = "0.00"; }
            if($apeT != 0) { $apeT = number_format($apeT,2); }else{ $apeT = "0.00"; }
            if($medT != 0) { $medT = number_format($medT,2); }else{ $medT = "0.00"; }
            if($radT != 0) { $radT = number_format($radT,2); }else{ $radT = "0.00"; }
            if($labT != 0) { $labT = number_format($labT,2); }else{ $labT = "0.00"; }
            if($ptT != 0) { $ptT = number_format($ptT,2); }else{ $ptT = "0.00"; }
            if($docT != 0) { $docT = number_format($docT,2); }else{ $docT = "0.00"; }
            if($othT != 0) { $othT = number_format($othT,2); }else{ $othT = "0.00"; }
            $print = str_replace("[ape]",$apeT,$print);   
            $print = str_replace("[med]",$medT,$print);    
            $print = str_replace("[rad]",$radT,$print);    
            $print = str_replace("[lab]",$labT,$print);    
            $print = str_replace("[pt]",$ptT,$print);     
            $print = str_replace("[doc]",$docT,$print);  
            $print = str_replace("[oth]",$othT,$print);     
            
            //compute clinic charge total
            $query = "select sum(b.charge_fee) as clinic_charge_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id 
                        and b.charge_type = 'CCHARGE'";                                                                              
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $clinic_charge_sum = number_format($row["clinic_charge_sum"],2);
            }
            $print = str_replace("[cc]",$clinic_charge_sum,$print);    
            
            //compute doctors procedure total
            $query = "select sum(b.charge_fee) as doc_proc_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id 
                        and b.charge_type = 'PROCEDURE'";                                                                              
                                                                     
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $doc_proc_sum = number_format($row["doc_proc_sum"],2);
            }
            $print = str_replace("[dp]",$doc_proc_sum,$print);    
            
            //compute prof fee total
            $query = "select sum(b.charge_fee) as prof_fee_sum
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id 
                        and b.charge_type = 'PROF_FEE'";     
                                                         
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $prof_fee_sum = number_format($row["prof_fee_sum"],2);
            }
            $print = str_replace("[pf]",$prof_fee_sum,$print);
            
            
            //compute total  
            $query = "select sum(b.charge_fee) as billtotal 
                        from hmo_form a
                        left join hmo_form_items b
                        on a.id = b.hmo_form_id
                        where a.hmo_billing_id = $billing_id ";                                    
            
            $command=$connection->createCommand($query);
            $dataReader=$command->query();
        
            foreach($dataReader as $row) { 
                $billtotal = number_format($row["billtotal"],2);
            }
            $print = str_replace("[gt]",$billtotal,$print);                              
            
            $print = str_replace("[bill_items]",$bill_items, $print);  

            $profile=Yii::app()->getModule('user')->user()->profile;                
            $prepared_by = $profile->first_name.' '.$profile->last_name;
            $print = str_replace("[preparedy_by]",$prepared_by,$print);

            // compute values in category
            $catTotalc = $aes+$ape+$lab+$raa+$rmap+$med+$meddx+$medcx+$others;
            $catTotal = $aesc+$apec+$labc+$raac+$rmapc+$medc+$meddxc+$medcxc+$othersc; 
            $dcatTotalc = $daes+$dape+$dlab+$draa+$drmap+$dmed+$dmeddx+$dmedcx+$dothers;
            $dcatTotal = $daesc+$dapec+$dlabc+$draac+$drmapc+$dmedc+$dmeddxc+$dmedcxc+$dothersc; 

            //$catTotal = $catTotal + $dcatTotal;
            $catTotalc = $catTotalc + $dcatTotalc;
            $catTotalc = number_format($catTotalc,2);

            $aes = $aes + $daes; $aes = number_format($aes,2);
            $ape = $ape + $dape; $ape = number_format($ape,2);
            $lab = $lab + $dlab; $lab = number_format($lab,2);
            $med = $med + $dmed; $med = number_format($med,2);
            $meddx = $meddx + $dmeddx; $meddx = number_format($meddx,2);
            //$medcx = $medcx + $dmedcx; $medcx = number_format($medcx,2);
            $raa = $raa + $draa; $raa = number_format($raa,2);
            $rmap = $rmap + $drmap; $rmap = number_format($rmap,2);
            $others = $others + $dothers; $others = number_format($others,2);

            /*$daesc = number_format($daesc,2);
            $dapec = number_format($dapec,2);
            $dlabc = number_format($dlabc,2);
            $dmedc = number_format($dmedc,2);
            $dmeddxc = number_format($dmeddxc,2);
            $dmedcxc = number_format($dmedcxc,2);
            $draac = number_format($draac,2);
            $drmapc = number_format($drmapc,2);
            $dothersc = number_format($dothersc,2);*/

            $category_content = "<tr><td>Aesthetics</td><td align='right'>$aesc</td><td align='right'>$daesc</td><td align='right'>$aesT</td></tr>";
            $category_content .= "<tr><td>Annual Physical Exam</td><td align='right'>$apec</td><td align='right'>$dapec</td><td align='right'>$apeT</td></tr>";
            $category_content .= "<tr><td>Doctors and Procedures</td><td align='right'>$meddxc</td><td align='right'>$dmeddxc</td><td align='right'>$docT</td></tr>";
            $category_content .= "<tr><td>Laboratory</td><td align='right'>$labc</td><td align='right'>$dlabc</td><td align='right'>$labT</td></tr>";
            $category_content .= "<tr><td>Medical Clinic</td><td align='right'>$medc</td><td align='right'>$dmedc</td><td align='right'>$medT</td></tr>";
            //$category_content .= "<tr><td>Medical </td><td align='right'>$medcx</td><td></td><td align='right'>$medcxc</td></tr>";
            $category_content .= "<tr><td>Radiology and Ancillary</td><td align='right'>$raac</td><td align='right'>$draac</td><td align='right'>$radT</td></tr>";
            $category_content .= "<tr><td>Rehabilitation Medicine And Physical Therapy</td><td align='right'>$rmapc</td><td align='right'>$drmapc</td><td align='right'>$ptT</td></tr>";
            $category_content .= "<tr><td>Others</td><td align='right'>$othersc</td><td align='right'>$dothersc</td><td align='right'>$othT</td></tr>";
            $category_content .= "<tr><td><b>Total</b></td><td align='right'><b>$catTotal</b></td><td align='right'>$dcatTotal</td><td align='right'><b>$cgT</b></td></tr>";
            $print = str_replace("[category_content]",$category_content,$print);
            
            if ($to_excel == true){
                    $filename = "HMO_Billing_Category_$billing_id.xls";
                    header("Content-Disposition: attachment; filename=\"$filename\""); 
                    header("Content-Type: application/vnd.ms-excel");
                    echo $print;
            }else{
                echo "<button class='noprint' onclick=\"window.location = '../exporttoexcelcategory/$billing_id'\" value='' >Export to Excel</button><br>";
                echo "<button style='margin:5px 0px 0px 0px;' class='noprint' onclick=\"window.print()\" value='' >Print</button>";
                //<input class="noprint" type="button" value="Print" onclick="window.print()">
                echo $print;
            }
            
        }
    } 

    public function countCategories($med_service){
        $med_service_arr = explode("+",$med_service);
        return count($med_service_arr);
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new HmoBilling;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HmoBilling']))
		{
			$model->attributes=$_POST['HmoBilling'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['HmoBilling']))
		{
			$model->attributes=$_POST['HmoBilling'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('HmoBilling');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new HmoBilling('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['HmoBilling']))
			$model->attributes=$_GET['HmoBilling'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=HmoBilling::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='hmo-billing-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
     
}