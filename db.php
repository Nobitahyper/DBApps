<!DOCTYPE html>
<html lang = "en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "aman";
$dbname = "student";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("conncetion failed: " . $conn->connnect_error);
}

$sql = "SELECT s_name, DOB, sex FROM student WHERE student_id = 4176828";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<br> Name: ". $row["s_name"]. " - Date of birth: ". $row["DOB"]. " - Sex: ". $row["sex"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<form action="demo.php" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
Comment: <input type="text" name="comment"><br>
<input type="submit">
</form>


</body>
</html>
