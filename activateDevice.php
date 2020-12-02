 <?php
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);
	
	$sql = "SELECT count(*) AS `total` FROM licences WHERE rb = ".$json["rb"]." AND companyId = ".$json["companyId"]." AND activated = 1";
	$result = $conn->query($sql)->fetch_array();
	if( $result['total'] > 0) { exit('{"status": 290, "result":"Already activated!"}'); }
	
	$sql = "SELECT count(*) AS `total` FROM licences WHERE rb = ".$json["rb"]." AND companyId = ".$json["companyId"]."";
	$result = $conn->query($sql)->fetch_array();
	if( $result['total'] == 0) { exit('{"status": 291, "result":"Do not exist!"}'); }
	
	$sql = "UPDATE licences SET mobileUID='".$json["mobileUID"]."', activated =true, activation_time = ".round(microtime(true) * 1000)." WHERE rb=".$json["rb"]." AND companyId = ".$json["companyId"]."";
	if ($conn->query($sql) === false) {
		exit('{"status": 292, "result":"Error on update!"}');
	}
	$conn->close();
	echo '{"status": 200, "result":'.json_encode($json).'}';	
?> 