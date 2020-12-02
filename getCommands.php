<?php 
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);
	
	$sql = "SELECT `rb`, `command`, `createTime` FROM commands where createTime > ".$json['lastUpdate']." AND createTime < ".$json['currentTime']."";
	$result = $conn->query($sql);
	if (!$result) { die("Query Failed."); }	
	$array = mysqli_fetch_all($result,MYSQLI_ASSOC);	
	$result->free();
	$conn->close();	
	echo json_encode($array);
?> 