<?php

session_start();

include("db_connection.php");
echo "login.php is running";
exit();

//$userID = trim($_POST['UserID']);//
//$password = trim($_POST['password']); //

echo "User ID: " . $_POST['UserID'] . "<br>";
echo "Password: " . $_POST['password'];
exit();

$sql = "SELECT * FROM system_administrator WHERE userID = '$userID'";

$result = mysqli_query($conn, $sql);

echo "Rows found: " . mysqli_num_rows($result);
exit();
//system administrator login//

$sql = "SELECT * FROM system_administrator WHERE userID = '$userID'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){

    $row = mysqli_fetch_assoc($result);

    if($password == $row['password']){

        $_SESSION['userID'] = $row['userID'];
        $_SESSION['role'] = "system_admin";

        header("Location: admin/admin_dashboard.php");
        exit();

    }

}

//school administrator login//
$sql = "SELECT * FROM school_administrator WHERE userID = '$userID'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){

    $row = mysqli_fetch_assoc($result);

    if($password == $row['password']){

        $_SESSION['userID'] = $row['userID'];
        $_SESSION['role'] = "school_admin";

        header("Location: school_admin/dashboard.php");
        exit();

    }

}
//driver login//
$sql = "SELECT * FROM driver WHERE userID = '$userID'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){

    $row = mysqli_fetch_assoc($result);

    if($password == $row['password']){

        $_SESSION['userID'] = $row['userID'];
        $_SESSION['role'] = "driver";

        header("Location: driver/dashboard.php");
        exit();

    }

}

//guardian login//
$sql = "SELECT * FROM guardian WHERE userID = '$userID'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){

    $row = mysqli_fetch_assoc($result);

    if($password == $row['password']){

        $_SESSION['userID'] = $row['userID'];
        $_SESSION['role'] = "guardian";

        header("Location: guardian/dashboard.php");
        exit();

    }

}

//student login//

$sql = "SELECT * FROM student WHERE userID = '$userID'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {

    $row = mysqli_fetch_assoc($result);

    if ($password == $row['password']) {

        $_SESSION['userID'] = $row['userID'];
        $_SESSION['role'] = "student";

        header("Location: student/dashboard.php");
        exit();
    }
}

//no match found for any user type//
echo "Invalid User ID or Password.";