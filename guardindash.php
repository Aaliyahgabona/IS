<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "student") {
    header("Location: login.html");
    exit();
}

include("db_connection.php");

$userID = $_SESSION['userID'];
$sql = "SELECT guardian.*, guardian.guardian_name 
        FROM guardian 
        join student ON guardian.studentID = student.studentID 
        WHERE  guardian.userID = ?";
        
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$guardian = mysqli_fetch_assoc($result);
?>








<html>

<head> 
    <title>Guardian Dashboard</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h1>Guardian Dashboard</h1>
    
     <p id="Sdetail">Name: Jane Doe<br> ID: 12345 <br>student: John Doe</p>

     <a href="notification.html"><button type="button">Check notifications</button></a>
      <button type="button">Authorize pickup</button> 
      <a href="tracking.html"><button type="button">view tracking</button></a>
</body>
</html>