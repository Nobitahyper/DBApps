<!DOCTYPE html>
<body>


<style>
  h1{
  background-color: #ffec00; 
  color: purple;
  border: none;
  color: purple;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  float: left;
  cursor: pointer;
  }
  </style>





<form action="gradechecker.php" method="POST">
<input type="text" name="id" placeholder="Enter your student id" />
<input type="submit" name="search" class="btn" value="SEARCH BY ID" />
</form>
<?php
$servername = "localhost";
$username = "root";
$password = "aman";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("conncetion failed: " . $conn->connnect_error);
}
echo "Connected Successfully <hr> <br>";

if(isset($_POST['search'])){
// select all data
$sql = "SELECT * FROM enrolled WHERE student_id = ?";

// prepare statement
$result = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($result, 'i', $id);

$id = $_POST['id'];

// Bind Result set in variables
mysqli_stmt_bind_result($result, $id, $grade, $attendance, $sec_id);


// Execute Prepared statement
mysqli_stmt_execute($result);

// Fetch Single row Data
while(mysqli_stmt_fetch($result)){
    echo " Student ID: " . $id . "<br/>Grade: " . $grade . "<br/>Attendance: " . $attendance .  "<br>Section: " . $sec_id . "<br><br>";
}

// close prepared statement
mysqli_stmt_close($result);
}

mysqli_close($conn);
 ?>

<div class="container">
<h1><a href="grade.php">Back to previous page</a></h1></div>

 </body>
 </html>