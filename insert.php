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
else{
    echo "Connected Successfully <hr> <br>";
}

$id = $_POST['studentid'];
$name = $_POST['sname'];
$date = $_POST['birthdate'];
$sex = $_POST['sex'];

 $sql = "INSERT INTO student (student_id, s_name, DOB, Sex) values
 ($id, '$name', '$date','$sex');";
$result = mysqli_query($conn, $sql);

header("Location: student.php?insert=success");
?>
