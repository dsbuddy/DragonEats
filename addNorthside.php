<?php
//Establish connection information
$servername = "localhost";
$username = "id5026401_root";
$password = "12345678";
$dbname = "id5026401_test";

//Establish connection
$connection = new mysqli($servername, $username, $password, $dbname);
$usernameadd = $_POST["addusername"];
$nameadd = $_POST["addname"];
$reviewadd = $_POST["review"];
$ratingadd = $_POST["rating"];
$approximationadd = $_POST["approximation"];
$halladd = "northside";
if ($approximationadd <= 0) {
	$approximationadd = 1;
}
// if ($output->num_rows == 1) {
// 	die("Username already taken.");
// }
if ($usernameadd != '') {
	$insertreqest = "INSERT INTO review (hall, username, name, review, rating, approximation) VALUES ('$halladd', '$usernameadd', '$nameadd', '$reviewadd', '$ratingadd', '$approximationadd')";
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



