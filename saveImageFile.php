<?php
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);
	
	$imgData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $json['data']));
	file_put_contents('images/'.$json['snapshotName'].'.png', $imgData);
	$sql = "INSERT INTO snapshot_records (fileName,uploadTime)
	VALUES ('".$json['snapshotName']."', '".$json['uploadTime']."')";
	if ($conn->query($sql) === false) {
		exit('{"status":500, "result":"Error: ' . $sql . '<br>' . $conn->error . '"');
	}
	$conn->close();
	echo '{"status":200, "result":"Saved successfully!", "id": '.$json['id'].'}';	
?> 