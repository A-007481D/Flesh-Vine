<?php
require_once '../../config/dbconfig.php';

session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] != 1) {
    header("Location: login.php");
    exit();
}

$pending_requests_query = "SELECT COUNT(*) AS pending_requests FROM bookings WHERE status = 'pending'";
$approved_today_query = "SELECT COUNT(*) AS approved_today FROM bookings WHERE status = 'approved' AND DATE(BookingDate) = CURDATE()";
$approved_tomorrow_query = "SELECT COUNT(*) AS approved_tomorrow FROM bookings WHERE status = 'approved' AND DATE(BookingDate) = CURDATE() + INTERVAL 1 DAY";
$next_client_query = "SELECT * FROM bookings WHERE status = 'approved' AND BookingDate < NOW() ORDER BY BookingDate ASC LIMIT 1";
$total_users_query = "SELECT COUNT(*) AS total_users FROM users";

$pending_requests_result = mysqli_query($DBconnect, $pending_requests_query);
$approved_today_result = mysqli_query($DBconnect, $approved_today_query);
$approved_tomorrow_result = mysqli_query($DBconnect, $approved_tomorrow_query);
$next_client_result = mysqli_query($DBconnect, $next_client_query);
$total_users_result = mysqli_query($DBconnect, $total_users_query);

$pending_requests = mysqli_fetch_assoc($pending_requests_result)['pending_requests'];
$approved_today = mysqli_fetch_assoc($approved_today_result)['approved_today'];
$approved_tomorrow = mysqli_fetch_assoc($approved_tomorrow_result)['approved_tomorrow'];
$next_client = mysqli_fetch_assoc($next_client_result);
$total_users = mysqli_fetch_assoc($total_users_result)['total_users'];

$pending_bookings_query = "SELECT * FROM bookings WHERE status = 'pending'";
$pending_bookings = mysqli_query($DBconnect, $pending_bookings_query);

?>
