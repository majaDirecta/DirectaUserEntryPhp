<?php
	require 'connectToDatabase.php';
 
    $post = file_get_contents('php://input');
    $json = json_decode($post, true);
	
	$array = array();
	foreach ($json as $record) {
		$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $record['data']));
		file_put_contents('images/'.$record['snapshotName'].'.png', $data);
		$sql = "INSERT INTO snapshot_records (fileName,uploadTime)
		VALUES ('".$record['snapshotName']."', '".$record['uploadTime']."')";
		if ($conn->query($sql) === true) {
			array_push ( $array , $record['id'] );
		} 
	}
	$conn->close();
	
	if(count($array)==0){ exit('{"status":500, "result":"None element has been saved!"'); }
    echo '{"status":200, "result":"Saved successfully!", "ids": '.json_encode($array).'}';	   
	
?> 