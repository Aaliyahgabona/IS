<?php
session_start();

if (!isset($_SESSION['userID']) || $_SESSION['role'] !== 'school_admin') {
    header("Location: login.html");
    exit();
}
include("db_connection.php");


$userID = $_SESSION['userID'] ;
$sql = "SELECT * FROM school_administrator WHERE userID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$schoolAdmin = mysqli_fetch_assoc($result);

?>


<html>
<head> 
    <title>School Admin Dashboard</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h1>School Admin Dashboard</h1>
    <p>Welcome to your dashboard!</p>
    <p id="Sdetail">
        Admin ID: <?php echo $schoolAdmin['admin_id']; ?><br>
        Total Students: <?php echo $schoolAdmin['total students registered']; ?><br>
        School: <?php echo $schoolAdmin['school_name']; ?>
    </p>
     

     <a href="updateroute.html"><button type="button">Update route</button></a>

     <a href="studentregister.html"><button type="button">add student</button></a> 

     <a href="makepayment.html"><button type="button">make payment</button></a>
</body>
</html>
