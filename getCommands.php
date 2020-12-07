<?php 
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);
	
	$sql = "SELECT `rb`, `command`, `createTime` FROM commands where createTime > ".$json['lastUpdate']." AND createTime < ".$json['currentTime']."";
	
	$result = $conn->query($sql);
	if (!$result) {exit('{"status": 591, "result":"Query Failed!"}');}	
	
	$array = array();
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			if(json_encode($row)!==false){array_push($array, $row);}	
		}				
	}
	$result->free();
	$conn->close();
	echo json_encode($array);
?> 