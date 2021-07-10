<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content ="IE=edge">
  <meta name="viewport" content = "width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style type="text/css">
  table{
    border-collapse: collapse;
    width: 100%;
    color: #d96459;
    font-family: monospace;
    font-size: 25px;
    text-align: left;
  }
 
  th {
    background-color: #588c7e;
    color: white;
  }
  tr:nth-child(even) {background-color: #f2f2f2}
  </style>
  </head>

<body>

<table>
  <tr>
    <th>Course Code</th>
    <th>Course Name</th>
  </tr>


<?php include  "navbar.php";

$servername = "localhost";
$username = "root";
$password = "aman";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("conncetion failed: " . $conn->connnect_error);
}
echo "Connected Successfully <hr> <br>";
?>

<div><h2>Available Courses: </h2></div>

<?php
$sql = "SELECT * FROM course";

// Prepared Statement
$result = mysqli_prepare($conn, $sql);

// Bind Result in variables
mysqli_stmt_bind_result($result, $c_code, $c_name);

// Execute Prepared Statement
mysqli_stmt_execute($result);

// Fetch all Table Data

  while(mysqli_stmt_fetch($result)){
    echo "<tr><td>" . $c_code . "</td><td>" . $c_name . "</td></tr>";
  }
  echo "</table>";


// close prepared statement
mysqli_stmt_close($result);


if(isset($_REQUEST['submit'])){
  //checking for empty feild
  if(($_REQUEST['ccode'] == "") || ($_REQUEST['cname'] == "")){
    echo "<hr> Insert value in all fields.. <hr>";
  } else{


// Insert SQL statement
$query = "INSERT INTO course (course_code, course_name) values (?, ?)";


// Prepare statement
$query_result = mysqli_prepare($conn, $query);

if($query_result){
  // Bind variables to Prepare Statement as Parameters
  mysqli_stmt_bind_param($query_result, 'ss', $code, $name);

  //Vairables & Values
  $code = $_REQUEST['ccode'];
  $name = $_REQUEST['cname'];

  // Execute Prepared Statement
  mysqli_stmt_execute($query_result);

  echo mysqli_stmt_affected_rows($query_result) . " Row inserted <br>" ;
}
else {
  echo "Not Inserted";
}
// close prepared statement
mysqli_stmt_close($query_result);
}
}
?>


<div><h2><br/>Add a new Course:</h2></div>
<form action="" method="POST">
  <div class="form-group">
    <label for="email">Course Code:</label>
    <input type="text" name="ccode" placeholder="COSC 1..9"/>
  </div>
  <div class="form-group">
    <label for="pwd">Course Name:</label>
    <input type="text" name="cname" placeholder="Course Name"/>
  </div>
  <button type="submit" class="btn btn-default" name="submit">Submit</button>
</form>


<?php 
// close connection
mysqli_close($conn);
?>

</table>
</body>
</html>
