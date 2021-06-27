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

$id = $_POST['ccode'];
$name = $_POST['cname'];

 $sql = "INSERT INTO course (course_code, course_name) values
 ('$id', '$name');";
$result = mysqli_query($conn, $sql);

header("Location: course.php?insert=success");
?>