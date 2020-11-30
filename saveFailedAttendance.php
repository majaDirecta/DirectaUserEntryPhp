 <?php
	require 'connectToDatabase.php';

    $post = file_get_contents('php://input');
    $records = json_decode($post, true);
  
    $counter = 0;
    foreach ($records as $record) {
        $counter++;
        $sql = "INSERT INTO attendance_records (licenceId, Userid, source_user,CheckTime,source_time,CheckType,source_type,data_source, Sensorid)
        VALUES ('".$record['licenceId']."', '".$record['Userid']."', '".$record['source_user']."','".$record['CheckTime']."','".$record['source_time']."','".$record['CheckType']."','".$record['source_type']."','".$record['data_source']."','".$record['Sensorid']."')";
        if (!$conn->query($sql) === TRUE) {
             echo "Error updating record: " . $conn->error;
        } 
    }
    echo "Records saved successfully";

	$conn->close();
?> 