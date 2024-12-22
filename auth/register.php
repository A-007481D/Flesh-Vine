<?php
require_once '../config/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $F_name = $_POST['firstname'];
  $L_name = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['confirm_password'];
  $role_id = 2;

  $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

  $email_check = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($DBconnect, $email_check);


  if (mysqli_num_rows($result) > 0) {
    echo "email already exists";
  } else {
    $insertData = "INSERT INTO users (FirstName, LastName, Email, Password, RoleID)
       VALUES ('$F_name', '$L_name', '$email', '$hashed_pwd', $role_id) ";
    if (mysqli_query($DBconnect, $insertData)) {
      echo "registration successful!";
    } else {
      echo "Error: " . mysqli_error($DBconnect);
    }
  }
}

?>
