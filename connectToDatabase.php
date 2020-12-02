 <?php
	$ini_array = parse_ini_file("configs/config_dev.ini"); //change it to config_dev.ini, config_test.ini, config_prod.ini

	$servername = $ini_array['servername'];
	$username = $ini_array['username'];
	$password = $ini_array['password'];
	$dbname = $ini_array['dbname'];
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	// Check connection
	if ($conn->connect_error) {
		exit('{"status": 590, "result":"SQL connection failed!"}');
	}
?> 