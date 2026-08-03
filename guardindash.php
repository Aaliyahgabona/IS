<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "guardian") {
    header("Location: login.html");
    exit();
}

include("db_connection.php");

$userID = $_SESSION['userID'];
$sql = "SELECT guardian.*, student.student_name 
        FROM guardian 
        join student ON student.guardian_id = guardian.guardian_id 
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
    
     <p id="Sdetail">
        Name: <?php echo $guardian['guardian_name']; ?><br>
        ID: <?php echo $guardian['guardian_id']; ?><br>
        Student: <?php echo $guardian['student_name']; ?>
    </p>

      <a href="notification.html"><button type="button">Check notifications</button></a>
      <button type="button">Authorize pickup</button> 
      <a href="tracking.php"><button type="button">view tracking</button></a>
</body>
</html>