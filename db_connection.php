
<?php
$servername = "localhost";
$user = "root";
$password = "";
$dbname = "is_project";

// Create connection
$conn = new mysqli($servername, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$userID = trim($_POST['userID']);
$password = trim($_POST['password']);
echo "User ID: " . $userID . "<br>";

$sql = "SELECT * FROM system_administrator WHERE userID = '$userID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    if ($password == $row['password']) {
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['role'] = "system_admin";
        header("Location: systemadmin.html");
        exit();
    }
    else {
        echo "User ID or Password is incorrect.";
    }
    
}
    

}
 

?>