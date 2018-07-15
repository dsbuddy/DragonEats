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


$sql = 'SELECT * FROM review WHERE hall="northside"';

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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="
	sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
						<center><h1><span class="badge badge-pill badge-default">Northside Dining Hall Review</span></h1></center>
						<br><br>
						<table class="table">
							<thead>
								<tr class="table-primary">
									<th>USERNAME</th>
									<th>NAME</th>
									<th>REVIEW</th>
									<th>APPROXIMATION</th>
									<th>RATING</th>
									<th>DATE</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no 	= 1;
								$total 	= 0;
								$totalApprox = 0;
								while ($row = mysqli_fetch_array($query))
								{
									$username  = $row['username'];
									$today = date("Y-m-d");
									echo '<tr class="table-warning">
											<td>'.$username.'</td>
											<td>'.$row['name'].'</td>
											<td>'.$row['review'].'</td>
											<td>'.$row['approximation'].'</td>
											<td>'.$row['rating'].'</td>
											<td>'.$today.'</td>
										</tr>';
									$totalApprox += $row['approximation'];
									$total += $row['rating'];
									$no++;
								}?>
							</tbody>
							<tfoot>
								<tr class="table-secondary">
									<th colspan="3">AVERAGE</th>
									<th><?=number_format($totalApprox/($no-1),0)?></th>
									<th><?=number_format((($total/($no-1))*10),2)."%"?></th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	    <div class="container-fluid">
	    	<center><button id="enterReview"onclick="toggleReview()" class="btn btn-primary">Enter a Review</button></center>
	      <div id="submitReview" class="row">
	        <div class="col-md-12">
	          <form action="https://dragoneats.000webhostapp.com/lab5/addNorthside.php" method="post">
	            <center><h1>Submit a Review for Northside</h1></center>

	            <!--Add User ID-->
	            <div class="form-group">
	              <label for="exampleInputEmail1">User ID</label>
	              <input name="addusername" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter User ID">
	              <small id="emailHelp" class="form-text text-muted">Your User ID is your alphanumeric school ID (ex: abc123)</small>
	            </div>

	            <!--Add Name-->
	            <div class="form-group">
	              <label for="exampleInputEmail2">Name</label>
	              <input name="addname" type="text" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Enter Name">
	            </div>

	            <!--Add Rating-->   
	            <div class="form-group">
	              <label for="exampleSelect1">Dining Hall Rating</label>
	              <select name="rating" class="form-control" id="exampleSelect1">
	                <option>1</option>
	                <option>2</option>
	                <option>3</option>
	                <option>4</option>
	                <option>5</option>
	                <option>6</option>
	                <option>7</option>
	                <option>8</option>
	                <option>9</option>
	                <option>10</option>
	              </select>
	            </div>

	            <!--Add Descriptive Review-->   
	            <div class="form-group">
	              <label for="exampleTextarea">Descriptive Review</label>
	              <textarea name="review" class="form-control" id="exampleTextarea" rows="3"></textarea>
	            </div>

	            <!--Add Approximation-->   
	            <div class="form-group">
	              <label for="example-number-input">Approximate Amount of People</label>
	                <input name="approximation" class="form-control" type="number" value="50" id="example-number-input">
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
	      	var stuff = window.location.href.split('username=')[1];
	      	console.log(stuff);
	      	var username = stuff.substring(0, stuff.indexOf('/!'))
	      	var nameTemp = stuff.split('/!name=')[1];
	      	var name = nameTemp.replace("%20", " ");

	      	document.getElementById("exampleInputEmail1").value = username;
	      	document.getElementById("exampleInputEmail2").value = name;
	      	console.log(username);
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
	      </script>

	      <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	</body>
</html>