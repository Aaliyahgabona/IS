 <?php
 include("db_connection.php");

 $errorMessage = "";

 if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $drivername = trim($_POST['name']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $userID = trim($_POST['userID']);
    $password = trim($_POST['password']);
    $busdetails = trim($_POST['busdetails']);

    try {
        $sql = "INSERT INTO driver (driver_name, phone_number, userID, password, bus_details) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $drivername, $phoneNumber, $userID, $password, $busdetails);
        mysqli_stmt_execute($stmt);

        header("Location: login.html");
        exit();

    } catch (\Throwable $e) {
        if (method_exists($e, 'getCode') && $e->getCode() == 1062) {
            $errorMessage = "That User ID is already taken. Please choose a different one.";
        } else {
            $errorMessage = "Registration failed: " . $e->getMessage();
        }
    }
}
 
 
 
 ?>
 <html>
<head> 
    <title>Driver Registration</title>  
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <h1>Driver Registration</h1>

     <?php if ($errorMessage): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form action="driverregister.php" method="POST">
             <div class="field">
                <label for="name">Enter Name</label>
                <input type="text" id="name" name="name">
                <p id = "nameMesage"></p>
             </div>

              <div class="field">
                <label for="userID">choose userID</label>
                <input type="text" id="userID" name="userID">
                <p id = "userIDMessage"></p>
              </div>

               <div class="field">
                <label for="bus">Enter Bus details</label>
                <input type="text" id="bus" name="busdetails">
                <p id = "busMesage"></p>
               </div>

                <div class="field">
                <label for="phone">Enter Phone number</label>
                <input type="text" id="phone" name="phoneNumber">
                <p id = "phoneMesage"></p>    
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