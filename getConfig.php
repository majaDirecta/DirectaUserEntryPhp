<?php 
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);

	echo json_encode(getConfig($conn,$json));

	function getConfig($conn,$record){
		$sql = "SELECT * FROM device_config where licenceId = ".$record['licenceId']."";
		$result = $conn->query($sql);
		$configList = array();
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$config  = array();
				$config['rb'] = $row["rb"]; 
				$config['licenceId'] = $row["licenceId"]; 
				$config['updateDate'] = $row["updateDate"]; 
				$config['configName'] = $row["configName"]; 
				$config['configValue'] = $row["configValue"]; 
		   
				array_push($configList,$config);
			}
		} else {
			echo null;
		}
		return $configList;
	}
	$conn->close();
?> 