<?php
session_start();
if (isset($_SESSION["user"])) {
  header("Location: dashboard.php");
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X- UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width= device-width, initial-scale= 1.0">
  <title> Login form </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

</head>
<body>
  <div class="container">
    <?php
    if (isset($_POST["login"])) {
      $email= $_POST["email"];
      $password= $_POST["password"];
      require_once "database.php";
      $sql= "SELECT *FROM users WHERE email= '$email'";
      $result= mysqli_query($conn, $sql);
      $user= mysqli_fetch_array($result, MYSQLI_ASSOC);
      if ($user) {
        if (password_verify($password, $user["password"])) {
          session_start();
          $_SESSION["user"] = "yes";
          header("Location: dashboard.php");
          die();
        }else{
          echo "<div class='alert alert-danger'> Password does not match </div>";
        }
      }else{
        echo "<div class='alert alert-danger'> Email does not match </div>";
      }
    }



    ?>
    <form action= "login.php" method= "POST">
      <div class= "form-group">
        <input type= "email" placeholder="Enter Email" name= "email" class="form-control">
      </div>
      <div class= "form-group">
        <input type= "password" placeholder="Enter Password" name= "password" class="form-control">
      </div>
      <div class= "form-btn">
        <input type="submit" value="Login" name="login" class="btn btn-primary">
      </div>
    </form>
    <div> <p> Not registred yet? <a href="registration.php"> Register</p> </div>


</body>
</html>
