<?php
$connection=Yii::app()->db;           
 if ($_POST){
            //validate date
            $from_date = $_POST["from_date"];
            $to_date = $_POST["to_date"];
            $due_date = $_POST["due_date"];
            $today = date("Y-m-d",time()); 
            $error_flag = false;
            
            session_start();    
}
 
 ?>
 
 <h3>Generate Billing For Period: <span style="color:royalblue;">
 
 <?= $from_date ?></span> to <span style="color:royalblue;"><?= $to_date ?></span></h3>
 
 <br/><br/>
        
<div style="font-size:14px;font-weight:bold;">Processed HMO in this period</div>
<?php
//get processed HMOs
$query = "select a.hmo_id, b.name from hmo_billing a
            left join hmo b 
            on a.hmo_id = b.id
            where a.from_date = '$from_date'
            order by b.name";

$command=$connection->createCommand($query);
$dataReader=$command->query();

$done_ids = array();
if (count($dataReader) > 0){
    foreach($dataReader as $row) { 
        $done_ids[] = $row["hmo_id"];
        echo $row["name"]." -- OK!<br/>";
    }
}


if (count($done_ids)==0){
    echo "<p>No processed HMO yet in this period</p>";
}
  
?>
<br/>
<hr/><br/>
<form action="<?= Yii::app()->createAbsoluteUrl('HmoWeekBill/Generate/Process',array()) ?>" onsubmit="return submitThis();" method="post">
<input type="hidden" name="from_date" value="<?= $from_date?>" />
<input type="hidden" name="to_date" value="<?= $to_date?>" />
<input type="hidden" name="due_date" value="<?= $due_date?>" />

<div style="color:royalblue;font-size:14px;font-weight:bold;">Available not yet processed HMOs</div>
<?php
//get processed HMOs     
if (count($done_ids)>0){                                            
        $done_ids = implode(",",$done_ids);
        $query = "SELECT a.id, a.name FROM hmo a WHERE a.id not in ($done_ids) order by a.name ASC";
}else{
    $query = "SELECT a.id, a.name FROM hmo a order by a.name ASC";    
}
$command=$connection->createCommand($query);
$dataReader=$command->query();
?>
<table>
    <tr>
        <th>Check</th>
        <th>HMO Name</th>
    </tr>
<?php
$avail_ids = array();
foreach($dataReader as $row) { 
        $avail_ids[] = $row["id"];
        echo "<tr>
                <td>
                    <input type='checkbox' name='procids[]' value='".$row["id"]."' />
                </td>
                <td>
                    ".$row["name"]."
                </td>               
            </tr>    
              ";
        
}
?>
</table>
<?php
if (count($avail_ids )==0){
    echo "<p>No more HMO to process in this period</p>";
}
?>                                                               

<input type="submit" value="   CONFIRM GENERATE BILLING   "  />
</form>