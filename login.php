<?php


session_start();

include("db_connection.php");

$userID = trim($_POST['userID']);
$password = trim($_POST['password']); 


$sql = "SELECT * FROM system_administrator WHERE userID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);



//system administrator login//

if(mysqli_num_rows($result) == 1){

    $row = mysqli_fetch_assoc($result);

    if($password == $row['password']){

        $_SESSION['userID'] = $row['userID'];
        $_SESSION['role'] = "system_admin";

        header("Location: systemadmin.php");
        exit();

    }
    else {
        echo "Invalid User ID or Password.";
    }

}


//school administrator login//

$sql = "SELECT * FROM school_administrator WHERE userID = '$userID'";
$sql = "SELECT * FROM school_administrator WHERE userID = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if(mysqli_num_rows($result) == 1){

    $row = mysqli_fetch_assoc($result);

    if($password == $row['password']){

        $_SESSION['userID'] = $row['userID'];
        $_SESSION['role'] = "school_admin";

        header("Location: schooladmindash.php");
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

        header("Location: studentdash.php");
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

        header("Location: guardindash.php");
        exit();

    }

}

// driver login//
$sql = "SELECT * FROM driver WHERE userID = '$userID'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){

    $row = mysqli_fetch_assoc($result);

    if($password == $row['password']){

        $_SESSION['userID'] = $row['userID'];
        $_SESSION['role'] = "driver";

        header("Location: driverdash.php");
        exit();

    }

}
?>

