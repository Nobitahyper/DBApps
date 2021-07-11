<!DOCTYPE html>
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

<div><h2><br>Check your grade</h2></div>

<form action="" method="POST">
<input type="text" name="id" placeholder="Enter your student id" />
<input type="submit" name="search" class="btn" value="Search" />
</form>

<?php

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

// Store Result
mysqli_stmt_store_result($result);

// Fetch all data
if(mysqli_stmt_num_rows($result) > 0){
    while(mysqli_stmt_fetch($result)){
        echo "Student ID: " . $id . "<br/>Grade: " . $grade . "<br/>Attendance: " . $attendance .  "<br>Section: " . $sec_id . "<br><br>";
        }
}else {
    echo "This ID hasn't been enrolled in any section yet.";
}

// Free Result
mysqli_stmt_free_result($result);

// close prepared statement
mysqli_stmt_close($result);
}

mysqli_close($conn);
 ?>

 </body>
 </html>
