<?php 
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);

	getConfig($conn,$json);
	function getConfig($conn,$records){
		foreach ($records as $record) {
		   $sql = "UPDATE device_config SET licenceId=".$record['licenceId'].",updateDate=".$record['updateDate'].",configName='".$record['configName']."',configValue='".$record['configValue']."' where licenceId =".$record['licenceId']." and configName='".$record['configName']."' ";
			if (!$conn->query($sql) === TRUE) {
				 //echo "Error updating record: " . $conn->error;
			} 
		}
		echo "Record updated successfully";
	}
	$conn->close();
?> 