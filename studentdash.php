<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== "student") {
    header("Location: login.html");
    exit();
}

include("db_connection.php");

$userID = $_SESSION['userID'];
$sql = "SELECT student.*, guardian.guardian_name , bus.bus_details
        FROM student 
          JOIN guardian ON student.guardian_id = guardian.guardian_id 
        LEFT JOIN bus ON student.route_id = bus.route_id
        WHERE student.userID = ?";
        
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);
?>







<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <h1>Student Dashboard</h1>
    <p>Welcome Back!</p>

    <p id="Sdetail">
        Name: <?php echo $student['student_name']; ?><br>
        ID: <?php echo $student['student_id']; ?><br>
        Guardian: <?php echo $student['guardian_name']; ?><br>
        Bus details: <?php echo $student['bus_details'] ?? 'No bus assigned yet'; ?>
    </p>

     
      <button type="button">Confirm boarding</button>

</body>
</html>