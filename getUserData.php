 <?php
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);

	echo json_encode(getUsers($conn,$json));
	
	function getUsers($conn,$data){
		$sql = "SELECT * FROM user where companyId = '".$data["companyId"]."' AND updateTime > ".$data["lastUpdateTime"]." AND updateTime < ".$data["currentTime"]." ";
		$result = $conn->query($sql);
		$userList = array();
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$user  = array();
				$user['Userid'] = $row["Userid"]; 
				$user['Name'] = $row["Name"]; 
				$user['companyId'] = $row["companyId"]; 
				$user['Cardnum'] = $row["Cardnum"]; 
				$user['active'] = $row["active"]; 
				$user['updateTime'] = $row["updateTime"]; 
		   
				array_push($userList,$user);
			}
		} else {
			echo null;
		}
		return $userList;	   
	}

	$conn->close();
?> 