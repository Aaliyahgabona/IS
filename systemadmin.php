
<?php
session_start();
include("db_connection.php");


$userID = $_SESSION['userID'] ;
$sql = "SELECT * FROM system_administrator WHERE userID = '$userID'";
$result = mysqli_query($conn, $sql);
$admin = mysqli_fetch_assoc($result);
?>

<html>

<head> 
    <title>System Admin Dashboard</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h1>System Admin Dashboard</h1>
    <p>Welcome to your dashboard!</p>
        <p id="Sdetail"> ID: <?php echo $admin['userID']; ?> <br>Total school registrations: <?php echo $admin['total_school_registrations']; ?></p>

    
        <a href="schoolregister.html"><button type="button">Register school</button></a> 
        <a href="driverregister.html"><button type="button">Register driver</button></a>
       
</body>
</html>