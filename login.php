<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>KUCU CMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="KUCU CMS" />
        <meta name="keywords" content="KUCU CMS,Member registration" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style3.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
		<body>




			<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
if (isset($_POST["login"])) {
    $host = "localhost";
    $uname = "root";
    $pas = "";
    $db_name = "cman";
    $tbl_name = "members";

    $conn = mysqli_connect("$host", "$uname", "$pas") or die("cannot connect");
    mysqli_select_db($conn, "$db_name") or die("cannot select db");

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the database
    $check_username_query = mysqli_query($conn, "SELECT * FROM members WHERE mobile='$username'");
    $username_exists = mysqli_num_rows($check_username_query);

    if ($username_exists > 0) {
        // Username exists, proceed with login
        $login_query = mysqli_query($conn, "SELECT * FROM members WHERE mobile='$username' AND password='$password'");
        $count = mysqli_num_rows($login_query);
        $row = mysqli_fetch_array($login_query);

        if ($count > 0) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['keyu'] = $row['keyu'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['mobile'] = $row['mobile'];
            $_SESSION['Residence'] = $row['Residence'];
            $_SESSION['Registration'] = $row['Registration'];
            $_SESSION['ministry'] = $row['ministry'];
            $_SESSION['year'] = $row['year'];
            $_SESSION['email'] = $row['email'];

            header('location: members/dashboard.php');
            exit(); // Make sure to exit after redirection

						// Check if both username and password are incorrect
								$check_both_query = mysqli_query($conn, "SELECT * FROM members WHERE mobile='$username' AND password='$password'");
								$both_exists = mysqli_num_rows($check_both_query);

								if ($both_exists == 0) {
										// Both username and password are incorrect
										echo "<script>alert('Wrong Username and Password');</script>";
										echo "<script>window.location='index.php';</script>";
										exit();
								} 


        } else {
            // Password is incorrect
            echo "<script>alert('Wrong password'); window.location='index.php';</script>";
            exit(); // Make sure to exit after redirection
        }
    } else {
        // Username does not exist
        echo "<script>alert('Username does not exist'); window.location='index.php';</script>";
        exit(); // Make sure to exit after redirection
    }

}
?>



</body>
