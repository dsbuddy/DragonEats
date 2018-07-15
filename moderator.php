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


$sql = 'SELECT * FROM review';

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
</head>
<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			border-collapse: collapse;
    		border-spacing: 0;
    		width: 100%;
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}
		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}
		table td {
			transition: all .5s;
		}
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			/*min-width: 537px;*/
			width: 60%;
		}
		.data-table th, 
		.data-table td {
			border: 1px solid black;
			padding: 7px 17px;
		}
		/* Table Header */
		.data-table thead th {
			background-color: #000C5E;
			color: #D3B701;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}
		/* Table Body */
		.data-table tbody td {
			color: #000C5E;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}
		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}
		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
				    <a href="https://dragoneats.000webhostapp.com/lab5">
							<center><img src="logo.png" width="50%"></center>
						</a>
					<h1>Remove User</h1>
					<form action="remuser.php" method="post">
							<label for="exampleInputEmail1">User ID</label>
              				<input name="remusername" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter User ID">
							<center><button type="submit" class="btn btn-primary">Submit</button></center>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						
						<br><br>
						<table class="table">
							<thead>
								<tr class="table-primary">
									<th>USERNAME</th>
									<th>REVIEW</th>
									<th>APPROXIMATION</th>
									<th>RATING</th>
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
									echo '<tr class="table-warning">
											<td>'.$username.'</td>
											<td>'.$row['review'].'</td>
											<td>'.$row['approximation'].'</td>
											<td>'.$row['rating'].'</td>
										</tr>';
									$totalApprox += $row['approximation'];
									$total += $row['rating'];
									$no++;
								}?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	      <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	</body>
</html>