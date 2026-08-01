<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "driver") {
    header("Location: login.html");
    exit();
}

include("db_connection.php");

$userID = $_SESSION['userID'];
$sql = "SELECT driver.*, bus.bus_details 
        FROM driver
         LEFT JOIN bus ON bus.driver_id = driver.driver_id 
        WHERE driver.userID = ?";
        
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$driver = mysqli_fetch_assoc($result);
?>




<html>
<head> 
    <title>Driver Dashboard</title>
    <link rel="stylesheet" href="styl.css">
</head>

<body>
    <h1>Driver Dashboard</h1>
    
    <p id="Sdetail">
    Name: <?php echo $driver['driver_name']; ?><br>
    ID: <?php echo $driver['driver_id']; ?><br>
    Bus details: <?php echo $driver['bus_details'] ?? 'No bus assigned yet'; ?>
</p>
     <button type="button">Start trip</button> 
      <button type="button">End trip</button> 
      <button type="button">report incident</button>
</body>
</html>