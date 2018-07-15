<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.php");
}
?>

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

$un = $_SESSION['username'];

$conn2 = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn2) {
  die ('Failed to connect to MySQL: ' . mysqli_connect_error());  
}

$sql99 = "SELECT name FROM users WHERE username = '$un'";
$query99 = mysqli_query($conn2, $sql99);
if (!$query99) {
  die ('SQL Error: ' . mysqli_error($conn2));
}
$row99 = mysqli_fetch_array($query99);

$sql = 'SELECT AVG(rating) AS average_hans FROM review WHERE hall="handschumacher"';
$query = mysqli_query($conn, $sql);
if (!$query) {
  die ('SQL Error: ' . mysqli_error($conn));
}
$row = mysqli_fetch_array($query);

$sql2 = 'SELECT AVG(rating) AS average_urban FROM review WHERE hall="urban"';
$query2 = mysqli_query($conn, $sql2);
if (!$query2) {
  die ('SQL Error: ' . mysqli_error($conn));
}
$row2 = mysqli_fetch_array($query2);

$sql3 = 'SELECT AVG(rating) AS average_northside FROM review WHERE hall="northside"';
$query3 = mysqli_query($conn, $sql3);
if (!$query3) {
  die ('SQL Error: ' . mysqli_error($conn));
}
$row3 = mysqli_fetch_array($query3);

$sql4 = 'SELECT AVG(approximation) AS approx_hans FROM review WHERE hall="handschumacher"';
$query4 = mysqli_query($conn, $sql4);
if (!$query4) {
  die ('SQL Error: ' . mysqli_error($conn));
}
$row4 = mysqli_fetch_array($query4);

$sql5 = 'SELECT AVG(approximation) AS approx_urban FROM review WHERE hall="urban"';
$query5 = mysqli_query($conn, $sql5);
if (!$query5) {
  die ('SQL Error: ' . mysqli_error($conn));
}
$row5 = mysqli_fetch_array($query5);

$sql6 = 'SELECT AVG(approximation) AS approx_northside FROM review WHERE hall="northside"';
$query6 = mysqli_query($conn, $sql6);
if (!$query6) {
  die ('SQL Error: ' . mysqli_error($conn));
}
$row6 = mysqli_fetch_array($query6);
?>
<!DOCTYPE html>
<html>
<head>
  <title>DragonEats</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" type="text/css" href="tableStyle.css">
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
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="header">
          <a href="https://dragoneats.000webhostapp.com/week8">
              <center><img width="40%" src="https://dragoneats.000webhostapp.com/lab5/logo.png"></center>
            </a>
          <h2>Home Page</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="content" width="100%">
      <div class="row">
        <div class="col-md-12"> 
          <!-- notification message -->
          <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success" >
              <h3>
                <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
                ?>
              </h3>
            </div>
          <?php endif ?>

          <!-- logged in user information -->
          <?php  if (isset($_SESSION['username'])) : ?>
            <p>Welcome <strong><?php echo $row99['name']?></strong></p>
          <?php endif ?>
          <?php
          if ($_SESSION['username'] == 'moderator') {
            echo '<center><h1><a href="https://dragoneats.000webhostapp.com/lab5/moderator.php" style="color: white;"><span class="label label-default">Moderate</span></a></h1><br></center>';
          }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <center><table id="dashboard" class="tableDashboard" width="100%">
            <tr>
              <td><strong>Dining Hall</strong></td>
              <td><strong>Average Rating</strong></td>
              <td><strong>Current Capacity</strong></td>
            </tr>
            <tr>
              <td><a href="hans.php/username=<?php echo $_SESSION['username'] ?>/!name=<?php echo $row99['name'] ?>"><span class="label label-primary">Handschumacher</span></a></td>
              <td>10</td>
              <td>10</td>
            </tr>
            <tr>
              <td><a href="urban.php/username=<?php echo $_SESSION['username'] ?>/!name=<?php echo $row99['name'] ?>"><span class="label label-primary">Urban Eatery</span></a></td>
              <td>10</td>
              <td>10</td>
            </tr>
            <tr>
              <td><a href="northside.php/username=<?php echo $_SESSION['username'] ?>/!name=<?php echo $row99['name'] ?>"><span class="label label-primary">Northside</span></a></td>
              <td>10</td>
              <td>10</td>
            </tr>
          </table>
        </center>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <center><h3><a href="friend.php/username=<?php echo $_SESSION['username'] ?>"><span class="label label-warning">Friends</span></a></h3></center>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <center><h3><a href="index.php?logout='1'" style="color: white;"><span class="label label-danger">Logout</span></a></h3></center>
        </div>
      </div>
    </div>  
  </div>



  <script type="text/javascript">

    var username = '<?php echo $_SESSION['username']; ?>';
    var name = '<?php echo $row99['name']?>';
    console.log(name);


    var hans = '<?php echo $row['average_hans']; ?>';
    var hansPercent = ((hans/10) * 100).toFixed(0) + '%'
    var row1 = document.getElementById("dashboard").rows[1].cells;
    row1[1].innerHTML = hansPercent;
    var urban = '<?php echo $row2['average_urban']; ?>';
    var urbanPercent = ((urban/10) * 100).toFixed(0) + '%'
    var row1 = document.getElementById("dashboard").rows[2].cells;
    row1[1].innerHTML = urbanPercent;
    var northside = '<?php echo $row3['average_northside']; ?>';
    var northsidePercent = ((northside/10) * 100).toFixed(0) + '%'
    var row1 = document.getElementById("dashboard").rows[3].cells;
    row1[1].innerHTML = northsidePercent;


    var hansApprox = '<?php echo $row4['approx_hans']; ?>';
    var hansApproximation = (hansApprox*1).toFixed(0) + ' People';
    var row1 = document.getElementById("dashboard").rows[1].cells;
    row1[2].innerHTML = hansApproximation;
    var urbanApprox = '<?php echo $row5['approx_urban']; ?>';
    var urbanApproximation = (urbanApprox*1).toFixed(0) + ' People';
    var row1 = document.getElementById("dashboard").rows[2].cells;
    row1[2].innerHTML = urbanApproximation;
    var northsideApprox = '<?php echo $row6['approx_northside']; ?>';
    var northsideApproximation = (northsideApprox*1).toFixed(0) + ' People';
    var row1 = document.getElementById("dashboard").rows[3].cells;
    row1[2].innerHTML = northsideApproximation;


  </script>
</body>
</html>