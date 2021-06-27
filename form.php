<!DOCTYPE html>
<body>
<?php include  "navbar.php" ?>
<form action="insert.php" method="POST">
<input type=number name="studentid" placeholder="Student ID (7 digits)" required/><br/>
<input type="text" name="sname" placeholder="Name" required/><br/>
<input type=date name="birthdate" placeholder="Date" /><br/>
<input type="text" name="sex" placeholder="Sex: M/F" /><br/>
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

    $sql = "INSERT INTO student (student_id, s_name, DOB, Sex) values
            (4176829, 'Tony Stark', '2000-01-02','M');";
    $result = mysqli_query($conn, $sql);




mysqli_close($conn);
 ?>

 </body>
 </html>
