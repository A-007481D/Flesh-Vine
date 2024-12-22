<?php 
require_once '../config/dbconfig.php';

$errMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($DBconnect, $_POST['email']);
    $password = $_POST['password'];

    $infoCheck = "SELECT * FROM users WHERE Email = '$email'";
    $result = mysqli_query($DBconnect, $infoCheck);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['Password'])) {
            session_start();
            $_SESSION['email'] = $row['Email'];
            $_SESSION['role'] = $row['RoleID']; 

            if ($row['RoleID'] == 1) { 
                header("Location: ../views/admin/dashboard.php");
                exit();
            } elseif ($row['RoleID'] == 2) { 
                header("Location: ../views/home.php");
                exit();
            } else {
                $errMsg = "Invalid user role.";
            }
        } else {
            $errMsg = "Incorrect email or password.";
        }
    } else {
        $errMsg = "Incorrect email or password.";
    }
}


?>



