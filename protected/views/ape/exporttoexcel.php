                                              
<?php 
    $_GET;                 
    $criteria=new CDbCriteria();              
    if(empty($_GET)){                    
        $criteria->compare('id',0);
    }
    $criteria->compare('ape_id',$_GET['ApeReports']['ape_id']);
    $criteria->compare('patient_id',$_GET['ApeReports']['patient_id']);
    $criteria->compare('hmo_id',$_GET['ApeReports']['hmo_id']);
    $criteria->compare('client_id',$_GET['ApeReports']['client_id']);
    if(!empty($_GET['to_date']) && !empty($_GET['from_date']))
    {                                                                 
        $criteria->addBetweenCondition('datevisited',date("Y-m-d",strtotime($_GET['from_date'])),date("Y-m-d",strtotime($_GET['to_date'])));      
    }
    $data = ApeReports::model()->findAll($criteria);    
    if($_GET['from_date']){
        $date = $_GET['from_date']."to".$_GET['to_date'];
    } else{
        $date = date("Y-m-d");
    }
    $file="ape_reports-".$date.".xls";                                                   
    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file");                        
?>      

<table border="1">   
<tr>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>COMPANY NAME</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>HMO</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>HMO MEMBER ID</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>MEDILINK NO</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>AVAILMENT DATE</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>NAME</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>EMPID</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>CONTROL NO</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>AGE</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>GENDER</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>HT (in M)</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>WT (in Kgs)</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>BMI</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>BODY BUILT</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>BP</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>CHEST X-RAY</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>CBC</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>FECALYSIS</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>URINALYSIS</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>DRUG TEST</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>ECG</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>PAPSMEAR</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>VISUAL ACUITY</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>AUDIOMETRY</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>PAST MEDICAL/FAMILY/SOCIAL HISTORY</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>PHYSICAL</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>OTHERS1</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>OTHERS2</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>OTHERS3</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>OTHERS4</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>OTHERS5</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>OTHERS6</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>SIGNIFICANT FINDINGS</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>RECOMMENDATIONS</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>CLASSIFICATION</td>
</tr>
<?php
    foreach($data as $d){
        echo "<tr>";      
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->client_name); 
        echo "</td>";     
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->hmo_name); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->hmo_member_id); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->medilink_no); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->datevisited); 
        echo "</td>";
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->patient_name); 
        echo "</td>";    
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->employee_id); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->ape_id); 
        echo "</td>";   
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->age); 
        echo "</td>";   
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->gender); 
        echo "</td>";   
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->ht); 
        echo "</td>";   
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->wt); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->bmi); 
        echo "</td>";    
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->body_built); 
        echo "</td>"; 
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->bp); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->cxr); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->cbc); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->fecalysis); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->urinalysis); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->drugtest); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->ecg); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->papsmear); 
        echo "</td>";
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->visual_acuity); 
        echo "</td>"; 
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->audiometry); 
        echo "</td>"; 
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->past_history); 
        echo "</td>"; 
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->physical_exam); 
        echo "</td>"; 
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->others1); 
        echo "</td>";
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->others2); 
        echo "</td>";
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->others3); 
        echo "</td>";
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->others4); 
        echo "</td>"; 
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->others5); 
        echo "</td>"; 
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->others6); 
        echo "</td>"; 
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->significant_findings); 
        echo "</td>"; 
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->recommendations); 
        echo "</td>"; 
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->classification); 
        echo "</td>";      
        echo "</tr>";
    }     
 ?>     
 </table>
 
 <?php unset($_SESSION['report']); ?>