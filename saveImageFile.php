<?php
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);

	saveImage($conn,$json);
	//echo json_encode();
	function saveImage($conn,$data){
        $imgData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data['data']));
        file_put_contents('images/'.$data['snapshotName'].'.png', $imgData);
        $sql = "INSERT INTO snapshot_records (fileName,uploadTime)
        VALUES ('".$data['snapshotName']."', '".$data['uploadTime']."')";
        if (!$conn->query($sql) === TRUE) {
             echo "Error updating record: " . $conn->error;
        } 
	}
	$conn->close();
?> 