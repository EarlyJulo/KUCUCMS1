<?php
session_start();
if (isset($_SESSION["user"])) {
  header("Location: index.php");
}
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content ="IE=edge">
       <meta name="viewport" content = "width= device-width, initial-scale = 1.0">
       <title>Registration Form</title>
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
       <link rel="stylesheet" href="style.css">

  </head>
  <body>
    <div class="container">
      <?php
      if (isset($_POST["submit"])) {
        $fname = $_POST['fname'];
        $sname = $_POST['sname'];
        $lname = $_POST['lname'];
        $Gender = $_POST['gender'];
        $Registration = $_POST['Registration'];
        $residence = $_POST['residence'];
        $ministry = $_POST['ministry'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $year = $_POST['year'];
        $password = $_POST['password'];
        $passwordRepeat =$_POST['passwordRepeat'];


        $errors= array();

        if (empty($fname) OR empty($sname) OR empty($lname) OR empty($gender) OR empty($Registration) OR empty($residence) OR empty($ministry) OR empty($mobile)  OR empty($email) OR empty($year) OR empty($password)){
          array_push($errors,"All fields are required");
        }
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
          array_push($errors,"Email is not valid");
        }
        if (strlen($password)< 8) {
          array_push($errors,"Password must be at least 8 characters long");
        }
        if ($password!== $passwordRepeat) {
          array_push($errors,"Password does not match");
        } 
        require_once "database.php";
        $sql= " SELECT * FROM members WHERE email= '$email'";
        $result= mysqli_query($conn, $sql);
        $rowCount= mysqli_num_rows($result);
        if ($rowCount>0) {
          array_push($errors, "This email already exists");
        }
        if (count($errors)> 0) {
          foreach ($errors as $errors) {
            echo "<div class='alert alert-danger'> $errors </div>";
          }
        }else{
          //we will insert the data into the database.
          $sql= "INSERT INTO users (fname, sname,lname,Gender,Registration,Residence,ministry,mobile, email, password, reg_no, year) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
          $stmt= mysqli_stmt_init($conn);
          $prepareStmt= mysqli_stmt_prepare($stmt, $sql);
          if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt,"ssssssssssss", $fname, $sname, $lname, $Gender,$Registration, $Residence, $ministry, $mobile, $email, $password, $reg_no, $year);
            mysqli_stmt_execute($stmt);
            echo "<div class= 'alert alert-success'> You are successfully registered.</div>";
          } else{
            die("Something went wrong");
          }
        }
      }
      ?>
      <form action="registration.php" method="POST">
        <div class="form-group">
          <input type="text" class="form-control" name="fname" placeholder="First Name">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="sname" placeholder="Middle name">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="lname" placeholder="Last name">
        </div>
        <div class="form-group">
        <select class="input focused" name="gender" id="focusedInput" required="required" type="text">
              <option value="Select Gender">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
          </select>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="reg_no" placeholder="Registration number">
        </div>
        <div class="form-group">
          <label for="options">Year of study</label>
             <select id="options" name="year">
                 <option value="First year"> First year </option>
                 <option value="Second year"> Second year </option>
                 <option value="Third year"> Third year </option>
                 <option value="Fpurth year"> Fourth year </option>
                 <option value="Fofth year"> Fifth year </option>
                 <option value="Sixth year"> Sixth year </option>
            </select>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="repeat_password" placeholder="Confirm Password">
        </div>
        <div class="form-btn">
          <input type="submit" class="btn btn-primary" value="Register" name="submit">
        </div>
      </form>
      <div>
        <div> <p> Already registred? <a href="login.php"> Login here </p> </div>
      </div>
    </div>

  </body>
  </html>
