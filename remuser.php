<?php
//Establish connection information
$servername = "localhost";
$username = "id5026401_root";
$password = "12345678";
$dbname = "id5026401_test";

$usernamerem = $_POST["remusername"];
//Establish connection
$connection = new mysqli($servername, $username, $password, $dbname);

if ($usernamerem != '') {
	$insertreqest = "DELETE FROM review WHERE username='$usernamerem'";
	if (mysqli_query($connection, $insertreqest)) {
		sleep(1);
		header("location: {$_SERVER['HTTP_REFERER']}");
// 		exit;
	}
	else {
		echo "Error: " . $insertreqest . "<br>" . mysqli_error($connection);
	}
	$insertreqest2 = "DELETE FROM users WHERE username='$usernamerem'";
	if (mysqli_query($connection, $insertreqest2)) {
		sleep(1);
		header("location: {$_SERVER['HTTP_REFERER']}");
		exit;
	}
	else {
		echo "Error: " . $insertreqest2 . "<br>" . mysqli_error($connection);
	}
}



?>