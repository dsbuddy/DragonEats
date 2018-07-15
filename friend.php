

<?php
//Establish connection information
$servername = "localhost";
$username = "id5026401_root";
$password = "12345678";
$dbname = "id5026401_test";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
}

// print_r($_SERVER);

$url = $_SERVER;

// $query=parse_url($url);


$myusername = substr($url['PATH_INFO'], 10);

// print_r($myusername);

$conn2 = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn2) {
  die ('Failed to connect to MySQL: ' . mysqli_connect_error());  
}


$sql99 = 'SELECT friends FROM users WHERE username = "'.$myusername.'"';
// $sql99 = "SELECT friends FROM users WHERE username = '".$myusername."'";
$query99 = mysqli_query($conn2, $sql99);
if (!$query99) {
  die ('SQL Error: ' . mysqli_error($conn2));
}


$row99 = mysqli_fetch_array($query99);
$friends = $row99['friends'];
$friendsExplode = explode("??",$friends);

$checkFriends = "(";


foreach ($friendsExplode as &$value) {
	if ($value == "") {

	} else {
    	$checkFriends = $checkFriends.'"'.$value.'", ';
	}
}

$checkFriends = substr($checkFriends, 0, strlen($checkFriends)-2).')';




$sql = 'SELECT * FROM review WHERE username in '.$checkFriends.'';

$query = mysqli_query($conn, $sql);
if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}




?>

<html lang="en">
<head>
	<title>DragonEats</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="tableStyle.css">
</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<a href="https://dragoneats.000webhostapp.com/week8">
                            <center><img width="50%" src="https://dragoneats.000webhostapp.com/lab5/logo.png"></center>
						</a>
						<center><h1><span class="badge badge-pill badge-default">My Friends</span></h1></center>
						<br><br>
						<table class="table" id="tableCheck">
							<thead>
								<tr class="table-primary">
									<th>USERNAME</th>
									<th>NAME</th>
									<th>HALL</th>
									<th>REVIEW</th>
									<th>APPROXIMATION</th>
									<th>RATING</th>
									<th>DATE</th>
								</tr>
							</thead>
							<tbody>
								<?php
								while ($row = mysqli_fetch_array($query))
								{
									$username  = $row['username'];
									$today = date("Y-m-d");
									echo '<tr class="table-warning">
											<td>'.$username.'</td>
											<td>'.$row['name'].'</td>
											<td>'.$row['hall'].'</td>
											<td>'.$row['review'].'</td>
											<td>'.$row['approximation'].'</td>
											<td>'.$row['rating'].'</td>
											<td>'.$today.'</td>
										</tr>';
								}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	    <div class="container-fluid">
	    	<center><button id="enterReview"onclick="toggleReview()" class="btn btn-primary">Add a Friend</button></center>
	      <div id="submitReview" class="row">
	        <div class="col-md-12">
	          <form action="https://dragoneats.000webhostapp.com/week8/addFriend.php" method="post">
	          	<input type="hidden" id="currentUserName" name="currun">
	            <center><h1>Add a Friend</h1></center>

	            <!--Add User ID-->
	            <div class="form-group">
	              <label for="exampleInputEmail1">User ID</label>
	              <input name="addusername" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter User ID">
	              <small id="emailHelp" class="form-text text-muted">Their User ID is their alphanumeric school ID (ex: abc123)</small>
	            </div>
	            <center><button type="submit" onclick="toggleReview()" class="btn btn-primary">Submit</button></center>
	            </form>
	          </div>
	        </div>
	      </div>

	      <style>

			#submitReview {
				display: none;
			}
	      </style>

	      


	      <script>
	      	





	      	function toggleReview() {
	      		var x = document.getElementById("submitReview");
	      		var y = document.getElementById("enterReview");
	      		if (x.style.display == "block") {
	      			x.style.display = "none";
	      			y.style.display = "block";
	      		} else {
	      			x.style.display = "block";
	      			y.style.display = "none";
	      		}
	      	}

	      	// var x = document.getElementById("myTable").rows[0].cells;
    		// x[0].innerHTML = "NEW CONTENT";

    		var table = document.getElementById("tableCheck");

    		for (var i = 0, row; row = table.rows[i]; i++) {
			   //iterate through rows
			   //rows would be accessed using the "row" variable assigned in the for loop
			   for (var j = 0, col; col = row.cells[j]; j++) {
			     	if (j == 2 && i != 0) {
				     	text = row.cells[j].innerHTML;
				     	textTransformed = text.substring(0, 1).toUpperCase() + text.substring(1);
				     	console.log(textTransformed);
				     	row.cells[j].innerHTML = textTransformed;
			     		
			     	}
			     //iterate through columns
			     //columns would be accessed using the "col" variable assigned in the for loop
			   }  
			}

		  	// text = document.getElementById("changeCase").data();
		  	// console.log(text);
		  	// text2 = document.getElementById("changeCase").data;
		  	// console.log(text2);



		  	// textTransformed = text.substring(0, 1);
		  	// console.log(textTransformed);
		  	// document.getElementById("changeCase").value = textTransformed;
	      </script>

	      <script> 
		  	var stuff = window.location.href.split('username=')[1];
		  	console.log(stuff);
		  	var username = stuff.substring(0)
		  	// var nameTemp = stuff.split('/!name=')[1];
		  	// var name = nameTemp.replace("%20", " ");
		  	document.getElementById("currentUserName").value = username;
		  	// var friends = '<?php echo $myusername; ?>';
		  	// console.log(friends);
		  	console.log(username);
		</script>

	      <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	</body>
</html>