<?php
$connect = mysql_connect("localhost","root","");
$db = mysql_select_db("wpemrdb");
mysql_query('TRUNCATE TABLE friend;');
$query = "SELECT id FROM auth_users ORDER BY id asc";
$query = mysql_query($query);
while($row = mysql_fetch_assoc($query)){
	$user_id[] = $row;
}
echo "<pre>";
print_r($user_id);
$count = count($user_id);
foreach($user_id as $rows){

for($i = 0; $i < $count; $i++){

echo "user_id : ". $user_id[$i]['id'] ."<br/>";

echo "id : ".$rows['id']."<br/>";
echo "count : ".$count."<br/>"; 

//if($rows['id']!=$user_id[$i]['id']){
$query = "INSERT INTO friend(user_id, friend_user_id) VALUES(".$rows['id'].",".$user_id[$i]['id'] .")";
//echo $query;
$query = mysql_query($query);
}

//}

}
?>
