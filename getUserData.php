 <?php
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);

	$sql = "SELECT `Userid`, `Name`, `companyId`, `CardnumMobile` AS `Cardnum`,`active`,`updateTime` FROM userinfo where companyId = ".$json["companyId"]." AND updateTime >= ".$json["lastUpdateTime"]." AND updateTime < ".$json["currentTime"]." ";
	$result = $conn->query($sql);
	if (!$result) {exit('{"status": 591, "result":"Query Failed!"}');}	
	$array = mysqli_fetch_all($result,MYSQLI_ASSOC);	
	$result->free();
	$conn->close();	
	if(count($array)==0){exit('{"status": 204, "result":"No content!"}');}
	echo '{"status": 200, "result":'.json_encode($array).'}';
?> 