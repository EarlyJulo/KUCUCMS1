<?php
// Start session
session_start();

// Check whether the session variable SESS_mEmBER_ID is present or not
if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
    // Redirect to the login page if the session variable is not set
    header("location: " . host() . "../index.php");
    exit();
}

// Include the necessary files and initialize database connection
include('dbconn.php');

// Fetch user information from the database based on the session ID
$session_id = $_SESSION['id'];
$user_query = mysqli_query($conn, "SELECT * FROM members WHERE id = '$session_id'") or die(mysqli_error($conn));
$user_row = mysqli_fetch_array($user_query);

// Check if user information is fetched successfully
if ($user_row) {
    // Set the session variable with the user's mobile number
    $_SESSION["mobile"] = $user_row['mobile'];
    $_SESSION["id"] = $user_row['id'];

} else {
    // If user information is not found, redirect to the login page
    header("location: " . host() . "../index.php");
    exit();
}

// Close database connection
mysqli_close($conn);
?>
