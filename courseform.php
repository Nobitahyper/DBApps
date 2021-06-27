<!DOCTYPE html>
<body>
<form action="insertcourse.php" method="POST">
<input type="text" name="ccode" placeholder="COSC 1..9" required/><br/>
<input type="text" name="cname" placeholder="Course Name" required/><br/>
<input type="submit" name="search" class="btn" value="Insert" />
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
else{
    echo "Connected Successfully <hr> <br>";
}


mysqli_close($conn);
 ?>

 </body>
 </html>