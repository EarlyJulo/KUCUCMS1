<?php
//Start session
session_start();
//Check whether the session variable SESS_mEmBER_ID is present or not
if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
	header("location:".host()."../index.php");
    exit();
}
$session_id=$_SESSION['id'];
$user_query = mysqli_query($conn,"select * from admin where admin_id = '$session_id'")or die(mysqli_error());
$user_row = mysqli_fetch_array($user_query);

// Check if $user_row is not null and if the 'username' key exists
if ($user_row !== null && isset($user_row['username'])) {
    $admin_username = $user_row['username'];
    // Now you can use $admin_username safely
} else {
    // Handle the case where $user_row is null or the 'username' key is missing
    // You can assign a default value to $admin_username or output an error message
}

?>
