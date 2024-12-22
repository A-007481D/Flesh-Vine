
<?php
require_once '../../config/dbconfig.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../../views/login.php");
    exit();
}

$email = $_SESSION['email'];
$userQuery = mysqli_query($DBconnect, "SELECT * FROM users WHERE Email = '$email'");

if (!$userQuery) {
    die('Error: ' . mysqli_error($DBconnect));
}

$user = mysqli_fetch_array($userQuery);

if (!isset($_SESSION['UserID'])) {
    $_SESSION['UserID'] = $user['UserID']; 
}

$bookingsQuery = mysqli_query($DBconnect, "
    SELECT * 
    FROM bookings 
    WHERE UserID = '{$_SESSION['UserID']}'
");

if (!$bookingsQuery) {
    die('Error: ' . mysqli_error($DBconnect));
}

$nextReservationQuery = "
    SELECT BookingDate 
    FROM bookings 
    WHERE UserID = '{$user['UserID']}' AND BookingDate > NOW() 
    ORDER BY BookingDate ASC 
    LIMIT 1; ";

$nextReservationResult = mysqli_query($DBconnect, $nextReservationQuery);
$next_reservation = mysqli_fetch_assoc($nextReservationResult);


$totalReservationsQuery = "
    SELECT COUNT(*) as total 
    FROM bookings 
    WHERE UserID = '{$user['UserID']}'; ";

$totalReservationsResult = mysqli_query($DBconnect, $totalReservationsQuery);
$total_reservations = mysqli_fetch_assoc($totalReservationsResult)['total'];

?>

