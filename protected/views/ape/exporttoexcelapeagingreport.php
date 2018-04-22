                                              
<?php 
              
    $criteria=new CDbCriteria();                              
    $criteria->compare('patient_id',$_GET['Ape']['patient_id']);
    $criteria->compare('hmo_id',$_GET['Ape']['hmo_id']);
    $criteria->compare('client_id',$_GET['Ape']['client_id']);      
    $criteria->compare('status',1);      
    $criteria->order = "id DESC";
    $data = Ape::model()->findAll($criteria);                
    $file="ape_aging_reports-".date("Ymd").".xls";                                                   
    header("Content-type: application/vnd.ms-excel");        
    header("Content-Disposition: attachment; filename=$file");
    
                         
?>      

<table border="1">   
<tr>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>APE ID</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>Date Visited</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>Days Pending</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>Patient</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>HMO</td>
<td style='vertical-align:middle; text-align:center; font-weight:bold;'>Company</td> 
</tr>
<?php
    foreach($data as $d){
        echo "<tr>";           
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->id); 
        echo "</td>";      
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->datevisited); 
        echo "</td>";  
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo  floor((time() - strtotime($d->datevisited))/(60*60*24)); 
        echo "</td>";    
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ucwords($d->patient->firstname." ".$d->patient->lastname); 
        echo "</td>";      
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ($d->hmo->name == "No HMO")? "" : ucwords($d->hmo->name); 
        echo "</td>";   
        echo "<td style='vertical-align:middle; text-align:center'>";                                                                              
        echo ($d->client->client_name == "No Company")? "" : ucwords($d->client->client_name); 
        echo "</td>";   
        echo "</tr>";
    }     
 ?>     
 </table>
 