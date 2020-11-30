 <?php
	require 'connectToDatabase.php';
	
	$post = file_get_contents('php://input');
    $json = json_decode($post, true);
	
	echo json_encode(activateDevice($conn,$json));
	
	function activateDevice($conn,$data){
		$sql = "SELECT * FROM licences where rb = ".$data["rb"]."";
		$result = $conn->query($sql);
		$LicenceList = array();
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				if($row["activated"] == 0) {
					$sqlUpdate = "UPDATE licences SET mobileUID='".$data["mobileUID"]."', activated =".true.", activation_time = ".round(microtime(true) * 1000)." WHERE rb=".$data["rb"]."";
					if ($conn->query($sqlUpdate ) === TRUE) {
						$licence  = array();
						$licence['rb'] = $row["rb"]; 
						$licence['companyId'] = $row["companyId"]; 
						array_push($LicenceList,$licence);
						return $LicenceList;
					} else {
						echo "Update problem";
					}
				}else{
					echo null;
				}
			}
		} else {
			// echo $data["rb"];
		} 
	}
	$conn->close();
?> 