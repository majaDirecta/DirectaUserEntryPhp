<?php
	require 'connectToDatabase.php';
 
    $post = file_get_contents('php://input');
    $json = json_decode($post, true);

	saveSnapShoots($conn,$json);

	function saveSnapShoots($conn,$records){
		foreach ($records as $record) {
			$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $record['data']));
			file_put_contents('images/'.$record['snapshotName'].'.png', $data);
			$sql = "INSERT INTO snapshot_records (fileName,uploadTime)
			VALUES ('".$record['snapshotName']."', '".$record['uploadTime']."')";
			if (!$conn->query($sql) === TRUE) {
				 echo "Error updating record: " . $conn->error;
			} 
		}
		echo "Records saved successfully";	   
	}
	$conn->close();
?> 