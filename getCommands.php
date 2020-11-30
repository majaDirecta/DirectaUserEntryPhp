<?php 
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);

	echo json_encode(getCommands($conn,$json));

	function getCommands($conn,$record){
		$sql = "SELECT * FROM commands where createTime > ".$record['lastUpdate']." AND createTime < ".$record['currentTime']."";
		$result = $conn->query($sql);
		$commandList = array();
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$command  = array();
				$command['rb'] = $row["rb"]; 
				$command['command'] = $row["command"]; 
				$command['createTime'] = $row["createTime"]; 
		   
				array_push($commandList,$command);
			}
		} else {
			echo null;
		}
		return $commandList;
	}
	$conn->close();
?> 