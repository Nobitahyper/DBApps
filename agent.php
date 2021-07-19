<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content ="IE=edge">
  <meta name="viewport" content = "width=device-width, initial-scale=1.0">
  <title>Final Exam</title>
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
    <th>Agent Code</th>
    <th>Agent Name</th>
    <th>Working Area</th>
    <th>Commission</th>
    <th>Phone No</th>
    <th>Country</th>
  </tr>


<?php
$servername = "localhost";
$username = "root";
$password = "aman";
$dbname = "final";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
    die("conncetion failed: " . $conn->connnect_error);
}
echo "Connected Successfully <hr> <br>";

?>

<div><h2>List of Agents: </h2></div>

<?php
$sql = "SELECT * FROM agents";

// Prepared Statement
$result = mysqli_prepare($conn, $sql);

// Bind Result in variables
mysqli_stmt_bind_result($result, $agent_code, $agent_name, $working_area, $commission, $phone_no, $country);

// Execute Prepared Statement
mysqli_stmt_execute($result);

// Fetch all Table Data

  while(mysqli_stmt_fetch($result)){
    echo "<tr><td>" . $agent_code . "</td><td>" . $agent_name . "</td><td>" . $working_area . "</td><td>" . $commission . "</td><td>" . $phone_no . "</td><td>". $country . "</td></tr>";
  }
  echo "</table>";


// close prepared statement
mysqli_stmt_close($result);


if(isset($_REQUEST['submit'])){
    //checking for empty feild
    if(($_REQUEST['acode'] == "") || ($_REQUEST['aname'] == "") || ($_REQUEST['warea'] == "") || ($_REQUEST['com'] == "") || ($_REQUEST['phone'] == "")){
        echo "<hr>Insert value in all fields (country can be null) <hr>";
    } else{
  
  
  // INsert SQL statement
  $query = "INSERT INTO agents (AGENT_CODE, AGENT_NAME, WORKING_AREA, COMMISSION, PHONE_NO, COUNTRY) values (?, ?, ?, ?, ?, ?)";
  
  
  // Prepare statement
  $query_result = mysqli_prepare($conn, $query);
  
  if($query_result){
  // Bind variables to Prepare Statement as Parameters
  mysqli_stmt_bind_param($query_result, 'sssiss', $id, $name, $area, $coms, $phone, $coun);

  //Vairables & Values
  $id = $_REQUEST['acode'];
  $name = $_REQUEST['aname'];
  $area = $_REQUEST['warea'];
  $coms = $_REQUEST['com'];
  $phone = $_REQUEST['phone'];
  $coun = $_REQUEST['conname'];
    
   
  
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

<div><h2><br/>Add a new Agent:</h2></div>
<form action="" method="POST">
  <div class="form-group">
    <label for="email">Agent Code:</label>
    <input type="text" name="acode" placeholder="Agent Code A013"/>
  </div>
  <div class="form-group">
    <label for="pwd">Agent Name:</label>
    <input type="text" name="aname" placeholder="Agent Name: Aman"/>
  </div>
  <div class="form-group">
    <label for="pwd">Working Area:</label>
    <input type="text" name="warea" placeholder="Working City: Bangkok"/>
  </div>
  <div class="form-group">
    <label for="pwd">Commission:</label>
    <input type="text" name="com" placeholder="Comission (0.5): "/>
  </div>
  <div class="form-group">
    <label for="pwd">Phone No:</label>
    <input type="text" name="phone" placeholder="Phone no. xxx-xxxxxxx"/>
  </div>
  <div class="form-group">
    <label for="pwd">Country:</label>
    <input type="text" name="conname" placeholder="Thailand"/>
  </div>
  <button type="submit" class="btn btn-default" name="submit">Submit</button>
</form>
<?php 
// close connection
mysqli_close($conn);
?>

</body>
</html>