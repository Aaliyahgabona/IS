
<?php

include("db_connection.php");

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {





    $schoolName = trim($_POST['schoolName']);
    $userID = trim($_POST['userID']);
    $password = trim($_POST['password']);
    $totalStudents = trim($_POST['totalStudents']);

    try {
        $sql = "INSERT INTO school_administrator (school_name, userID, password, `total students registered`) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $schoolName, $userID, $password, $totalStudents);
        
        mysqli_stmt_execute($stmt);
echo "Bind succeeded<br>";
        header("Location: login.html");
        exit();

    } catch (\Throwable $e) {
        $errorMessage = "Error: " . $e->getMessage();
        echo $errorMessage;
    }
}
?>




<html>
<head> 
    <title>System Admin Registration</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <h1>School Registration</h1>

 
        <form action="schoolregister.php" method="POST">

        <div class="field">
            <label for="schoolName">Enter School Name</label>
            <input type="text" id="schoolName" name="schoolName">
            <p id="schoolMessage"></p>
        </div>

        <div class="field">
            <label for="totalStudents">Enter Total Students Registered</label>
            <input type="number" id="totalStudents" name="totalStudents">
            <p id="totalStudentsMessage"></p>
        </div>

        <div class="field">
            <label for="userID">Choose schoolAdministrator User ID</label>
            <input type="text" id="userID" name="userID">
            <p id="userIDMessage"></p>
        </div>

        <div class="field">
            <label for="password">Choose Password</label>
            <input type="password" id="password" name="password">
            <p id="passwordMessage"></p>
        </div>

        <button type="submit">Register</button>
    </form>

             
        
    
</body>
       
</html>