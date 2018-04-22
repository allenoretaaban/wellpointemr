<?php
	$id = $_GET['id'];

	// Create connection
	$conn = new mysqli("localhost", "root", "", "wpemrdb");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT id FROM auth_users";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo $row["id"]."<br>";
			$friend_id = $row["id"];
			$sql = "INSERT INTO friend (user_id,friend_user_id) VALUES ($id, $friend_id)";
			if ($conn->query($sql) === TRUE) {
				echo "User $id added to friend $friend_id<br>";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	} else {
		echo "0 results";
	}
	$conn->close();
?>