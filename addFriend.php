<?php
//Establish connection information
$servername = "localhost";
$username = "id5026401_root";
$password = "12345678";
$dbname = "id5026401_test";

//Establish connection
$connection = new mysqli($servername, $username, $password, $dbname);
$currentusername = $_POST["currun"];
$usernameadd = $_POST["addusername"];
$usernameadd = "??" . $usernameadd;
// print_r($currentusername);
// if ($output->num_rows == 1) {
// 	die("Username already taken.");
// }
if ($usernameadd != '') {
	$insertreqest = "UPDATE users SET friends = CONCAT(friends, '$usernameadd') WHERE username = '$currentusername';";
	if (mysqli_query($connection, $insertreqest)) {
		sleep(1);
		header("location: {$_SERVER['HTTP_REFERER']}");
		exit;
	}
	else {
		echo "Error: " . $insertreqest . "<br>" . mysqli_error($connection);
	}
}
?>