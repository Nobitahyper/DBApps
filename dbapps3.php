<!DOCTYPE html>
<body>
<form action="dbapps3.php" method="POST">
<input type="text" name="id" placeholder="Student ID" />
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
while(mysqli_stmt_fetch($result)){
    echo " Name: " . $name . " Date of Birth: " . $DOB . " Sex: " . $sex . "<br><br>";
}

// close prepared statement
mysqli_stmt_close($result);
}

mysqli_close($conn);
 ?>

 </body>
 </html>