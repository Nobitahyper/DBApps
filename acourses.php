<!DOCTYPE html>
<html>

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


<body>
<?php include  "navbar.php" ?>
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

$sql = "SELECT * FROM course;";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);
if ($resultcheck > 0){
    while ($row = mysqli_fetch_assoc($result)){
        echo $row['course_code'] . "         " . $row['course_name'] . "<br>";
    }
}

?>
<div class="container">
<h1><a href="course.php">Back to previous page</a></h1></div>
</body>
</html>
