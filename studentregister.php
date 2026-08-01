<?php
include("db_connection.php");

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

     $studentID = trim($_POST['studentID']);
    $studentName = trim($_POST['studentName']);
    $schoolName = trim($_POST['schoolName']);
    $routeID = trim($_POST['route']);
    $studentUserID = trim($_POST['studentUserID']);
    $studentPassword = trim($_POST['studentPassword']);

    
    $guardianName = trim ($_POST['guardianName']); 
    $guardianPhone = trim($_POST['guardianPhone']);
    $guardianUserID = trim($_POST['guardianUserID']);
    $guardianPassword = trim($_POST['guardianPassword']);

}


    // Insert guardian first
    try {
    $sql = "INSERT INTO guardian (guardian_name, phone_number, userID, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $guardianName, $guardianPhone, $guardianUserID, $guardianPassword);
    mysqli_stmt_execute($stmt);

    $newGuardianID = mysqli_insert_id($conn);

    // Insert student, linked to the new guardian
    $sql = "INSERT INTO student (student_id, student_name, school_name, route_id, guardian_id, userID, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "issiiss", $studentID, $studentName, $schoolName, $routeID, $newGuardianID, $studentUserID, $studentPassword);
    mysqli_stmt_execute($stmt);

$updateSql = "UPDATE guardian SET student_id = ? WHERE guardian_id = ?";
        $updateStmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "ii", $studentID, $newGuardianID);
        mysqli_stmt_execute($updateStmt);


    

    header("Location: login.html");
    exit();
}
catch(mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        $errorMessage = "That Student ID or User ID is already taken. Please choose a different one.";
    } else {
        $errorMessage = "Registration failed. " . $e->getMessage();
    }
}

$routeResult = mysqli_query($conn, "SELECT route_id, route_name FROM route");
?>

<html>
<head>
    <title>Register Student</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <h1>Register Student</h1>

    <?php if ($errorMessage): ?>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
<?php endif; ?>

    <form action="studentregister.php" method="POST">

        <div class="field">
            <label for="studentName">Enter Name</label>
            <input type="text" id="studentName" name="studentName">
            <p id="nameMessage"></p>
        </div>

        <div class="field">
    <label for="studentID">Enter Student ID</label>
    <input type="text" id="studentID" name="studentID">
    <p id="studentIDMessage"></p>
      </div>



        <div class="field">
            <label for="schoolName">Enter School Name</label>
            <input type="text" id="schoolName" name="schoolName">
            <p id="schoolMessage"></p>
        </div>

        <div class="field">
            <label for="route">Select Route</label>
            <select id="route" name="route">
                <option value="">-- Select route --</option>
                <?php while ($r = mysqli_fetch_assoc($routeResult)): ?>
                    <option value="<?php echo $r['route_id']; ?>">
                        <?php echo $r['route_name']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <p id="routeMessage"></p>
        </div>


        <div class="field">
            <label for="studentUserID">Choose Student User ID</label>
            <input type="text" id="studentUserID" name="studentUserID">
            <p id="studentUserIDMessage"></p>
        </div>

        <div class="field">
            <label for="studentPassword">Choose Student Password</label>
            <input type="password" id="studentPassword" name="studentPassword">
            <p id="studentPasswordMessage"></p>
        </div>

        <hr>

        <div class="field">
            <label for="guardianName">Enter Guardian Name</label>
            <input type="text" id="guardianName" name="guardianName">
            <p id="guardianNameMessage"></p>
        </div>





        <div class="field">
            <label for="guardianPhone">Enter Guardian Phone Number</label>
            <input type="text" id="guardianPhone" name="guardianPhone">
            <p id="guardianPhoneMessage"></p>
        </div>

        <div class="field">
            <label for="guardianUserID">Choose Guardian User ID</label>
            <input type="text" id="guardianUserID" name="guardianUserID">
            <p id="guardianUserIDMessage"></p>
        </div>

        <div class="field">
            <label for="guardianPassword">Choose Guardian Password</label>
            <input type="password" id="guardianPassword" name="guardianPassword">
            <p id="guardianPasswordMessage"></p>
        </div>

        <button type="submit">Register</button>
    </form>

        
   

    
</body>
</html>