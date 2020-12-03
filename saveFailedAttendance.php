 <?php
	require 'connectToDatabase.php';

    $post = file_get_contents('php://input');
    $json = json_decode($post, true);
  
	$array = array();
    foreach ($json as $record) {
        $sql = "INSERT INTO checkinout (licenceId, Userid, source_user,CheckTime,source_time,CheckType,source_type,data_source, Sensorid)
        VALUES ('".$record['licenceId']."', '".$record['Userid']."', '".$record['source_user']."','".$record['CheckTime']."','".$record['source_time']."','".$record['CheckType']."','".$record['source_type']."','".$record['data_source']."','".$record['Sensorid']."')";
        if ($conn->query($sql) === true) {
			array_push ( $array , $record['Logid'] );
        } 
    }
	$conn->close();
	
	if(count($array)==0){ exit('{"status":500, "result":"None element has been saved!"'); }
    echo '{"status":200, "result":"Saved successfully!", "ids": '.json_encode($array).'}';
?> 