 <?php
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);
	
	$sql = "SELECT `Userid`, `Name`, `companyId`, `CardnumMobile` AS `Cardnum`,`active`,`updateTime` FROM userinfo WHERE companyId = ".$json['companyId'];
	
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
	if(count($array)==0){exit('{"status": 204, "result":"No content!"}');}
	echo '{"status": 200, "result":'.json_encode($array).'}';
?>