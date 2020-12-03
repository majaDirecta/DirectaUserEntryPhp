 <?php
	require 'connectToDatabase.php';
 
    $post = file_get_contents('php://input');
    $json = json_decode($post, true);
 
	$sql = "INSERT INTO checkinout (licenceId, Userid, source_user,CheckTime,source_time,CheckType,source_type,data_source, Sensorid)
		VALUES ('".$json['licenceId']."', '".$json['Userid']."', '".$json['source_user']."','".$json['CheckTime']."','".$json['source_time']."','".$json['CheckType']."','".$json['source_type']."','".$json['data_source']."','".$json['Sensorid']."')";

	if ($conn->query($sql) === false) {
		exit('{"status":500, "result":"Error: ' . $sql . '<br>' . $conn->error . '"');
	}
	
	echo '{"status":200, "result":"Saved successfully!", "id": '.$json['Logid'].'}';
	$conn->close();
?> 