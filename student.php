<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content ="IE=edge">
  <meta name="viewport" content = "width=device-width, initial-scale=1.0">
  <title>Classroom Prototype Application</title>
  </head>

<body>

<?php include  "navbar.php";

include "connection.php";
?>

<div><h2>Search Student: </h2></div>

<form action="" method="POST">
<input type="text" name="id" placeholder="Student ID" />
<input type="submit" name="search" class="btn btn-default" value="SEARCH" /><br><br>
</form>
<?php


if(isset($_POST['search'])){
// select all data
$sql = "SELECT * FROM student WHERE student_id = ?";

// prepare statement
$result = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($result, 'i', $id);

$id = $_POST['id'];

// Bind Result set in variables
mysqli_stmt_bind_result($result, $id, $name, $DOB, $sex);


// Execute Prepared statement
mysqli_stmt_execute($result);

// Fetch Single row Data
if(mysqli_stmt_fetch($result)){
    echo " Name: " . $name . "<br/>Date of Birth: " . $DOB . "<br/>Sex: " . $sex . "<br><br>";
}
else {
  echo "ID NOT FOUND";
}
// close prepared statement
mysqli_stmt_close($result);
}

if(isset($_REQUEST['submit'])){
  //checking for empty feild
  if(($_REQUEST['studentid'] == "") || ($_REQUEST['sname'] == "") || ($_REQUEST['birthdate'] == "") || ($_REQUEST['sex'] == "")){
    echo "<hr>Insert value in all fields.. <hr>";
  } else{


// INsert SQL statement
$query = "INSERT INTO student (Student_id, s_name, DOB, Sex) values (?, ?, ?, ?)";


// Prepare statement
$query_result = mysqli_prepare($conn, $query);

if($query_result){
  // Bind variables to Prepare Statement as Parameters
  mysqli_stmt_bind_param($query_result, 'isss', $id, $name, $dob, $sex);

  //Vairables & Values
  $id = $_REQUEST['studentid'];
  $name = $_REQUEST['sname'];
  $dob = $_REQUEST['birthdate'];
  $sex = $_REQUEST['sex'];

  // Execute Prepared Statement
  mysqli_stmt_execute($query_result);

  echo mysqli_stmt_affected_rows($query_result) . "Row inserted <br>" ;
}
else {
  echo "Not Inserted";
}
// close prepared statement
mysqli_stmt_close($query_result);
}
}


?>

<div><h2><br/>Add a new Student:</h2></div>
<form action="" method="POST">
  <div class="form-group">
    <label for="email">Student ID:</label>
    <input type=number name="studentid" placeholder="Student ID (7 digits)" />
  </div>
  <div class="form-group">
    <label for="pwd">Name:</label>
    <input type="text" name="sname" placeholder="Name" />
  </div>
  <div class="form-group">
    <label for="pwd">DOB:</label>
    <input type=date name="birthdate" placeholder="Date" />
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="text" name="sex" placeholder="Sex: M/F" />
  </div>
  <button type="submit" class="btn btn-default" name="submit">Submit</button>
</form>


<?php 
// close connection
mysqli_close($conn);
?>

</body>
</html>
