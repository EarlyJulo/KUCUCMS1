<?php
session_start();
if (isset($_SESSION["user"])) {
  header("Location: index.php");
}
if (isset($_POST["submit"])) {
  $fname = $_POST['fname'];
  $sname = $_POST['sname'];
  $lname = $_POST['lname'];
  $Gender = $_POST['Gender'];
  $Registration = $_POST['Registration'];
  $Residence = $_POST['Residence'];
  $ministry = $_POST['ministry'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $year = $_POST['year'];
  $password = $_POST['password'];
  $passwordRepeat = $_POST["passwordRepeat"];

  $errors = array();

  if (empty($fname) || empty($sname) || empty($lname) || empty($Gender) || empty($Registration) || empty($Residence) || empty($ministry) || empty($mobile) || empty($email) || empty($year) || empty($password) || empty($passwordRepeat)){
    array_push($errors,"All fields are required");
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, "Email is not valid");
  }

  if (strlen($password) < 8) {
    array_push($errors, "Password must be at least 8 characters long");
  }
  if (strlen($mobile) !== 10) {
    array_push($errors, "Mobile number must be 10 digits long");
}

  if ($password !== $passwordRepeat) {
    $errors[] = "Passwords do not match";
  }

  // Check if email already exists in the database
  require_once "database.php";
  $sql = "SELECT * FROM members WHERE email = ?";
  $stmt = mysqli_stmt_init($conn);
  if (mysqli_stmt_prepare($stmt, $sql)) {
      // Prepare statement successful
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      if (mysqli_stmt_num_rows($stmt) > 0) {
          // Email already exists
          array_push($errors, "This email already exists");
      }
  }
  // Check if mobile number already exists in the database
require_once "database.php";
$sql_mobile = "SELECT * FROM members WHERE mobile = ?";
$stmt_mobile = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt_mobile, $sql_mobile)) {
    // Prepare statement successful
    mysqli_stmt_bind_param($stmt_mobile, "s", $mobile);
    mysqli_stmt_execute($stmt_mobile);
    mysqli_stmt_store_result($stmt_mobile);
    if (mysqli_stmt_num_rows($stmt_mobile) > 0) {
        // Mobile number already exists
        array_push($errors, "This mobile number already exists");
    }
    // Check if Registration number already exists in the database
require_once "database.php";
$sql_registration = "SELECT * FROM members WHERE Registration = ?";
$stmt_registration = mysqli_stmt_init($conn);
if (mysqli_stmt_prepare($stmt_registration, $sql_registration)) {
    // Prepare statement successful
    mysqli_stmt_bind_param($stmt_registration, "s", $Registration);
    mysqli_stmt_execute($stmt_registration);
    mysqli_stmt_store_result($stmt_registration);
    if (mysqli_stmt_num_rows($stmt_registration) > 0) {
        // Registration number already exists
        array_push($errors, "This Registration number already exists");
    }
}

}


  if (count($errors) > 0) {
      foreach ($errors as $error) {
          echo "<div class='alert alert-danger'>$error</div>";
      }
  } else {
      // Hash the password before storing it in the database
      // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Use a prepared statement to avoid SQL injection
      $query = "INSERT INTO members (fname, sname, lname, Gender, Residence, Registration, ministry, mobile, email, year, thumbnail, password, id)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $query);
      if ($stmt) {
        $image_path = 'uploads/none.png'; // Assign the value to a variable
        mysqli_stmt_bind_param($stmt, "sssssssssssss", $fname, $sname, $lname, $Gender, $Residence, $Registration, $ministry, $mobile, $email, $year, $image_path, $password, $mobile);
          if (mysqli_stmt_execute($stmt)) {
              // Insert successful
              echo "<script>alert('You are seccessfully registered');</script>";
          } else {
              // Insertfailed
              echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
          }
          mysqli_stmt_close($stmt);
      } else {
          // Statement preparation failed
          die("Prepared statement failed: " . mysqli_error($conn));
      }

  }
}
?>

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
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">


                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1>KUCU CHURCH MANAGEMENT SYSTEM </h1>

            </header>
            <section>
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="login.php" method="POST" autocomplete="on">
                                <h1>Log in</h1>
                                <p>
                                    <label for="username" class="uname" data-icon="u" > Username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="Mobile number"/>
                                </p>
                                <p>
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="Password" />
                                </p>
                                <p class="keeplogin">
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
									<label for="loginkeeping">Keep me logged in</label>
								</p>
                                <p class="login button">
                                    <input type="submit" value="Login"  name="login"/>
								</p>
                <p class="change_link">
Not a member yet?
<a href="#toregister" class="to_register">Register</a>
<!-- Add the admin login button -->
Are you an Admin?
<a href="admin/index.php" class="to_admin_login">Admin Login</a>
</p>

                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="index.php" method="POST" autocomplete="on">
                                <h1> Registration form </h1>
                                <p>
                                    <label for="usernamesignup" class="uname" data-icon="u">First Name</label>
                                    <input id="usernamesignup" name="fname" required="required" type="text" placeholder="e.g Ali" />
                                </p>
                                <p>
                                    <label for="usernamesignup" class="uname" data-icon="u" > Middle Name</label>
                                    <input id="usernamesignup" name="sname" required="required" type="text" placeholder="e.g Chengo"/>
                                </p>
								<p>
                                    <label for="usernamesignup" class="uname" data-icon="u">Last Name</label>
                                    <input id="usernamesignup" name="lname" required="required" type="text" placeholder="e.g Julo" />
                                </p>
								<p>
                                    <label for="usernamesignup" class="uname" data-icon="">Gender</label>

									 <select name="Gender" id="usernamesignup" required="required" type="text">
  <option value="Select Gender">Select Gender</option>
  <option value="Male">Male</option>
  <option value="Female">Female</option>

</select>
                                </p>
								<p>
                                    <label for="usernamesignup" class="uname" data-icon="">Registration number</label>
                                    <input id= "usernamesignup" name="Registration" required="required" type="text" placeholder="e.g J31/3698/2"/>
                                </p>
								<p>
                                    <label for="usernamesignup" class="uname" data-icon="">Residence</label>
                                    <input id="usernamesignup" name="Residence" required="required" type="text" placeholder="e.g Nyayo hostels" />
                                </p>
								<p>
                  <label for="usernamesignup" class="uname" data-icon= "">Year of study</label>
                  <select class="input focused" name="year" id="focusedInput" required="required" type="text">
<option value="">Year of study</option>
<option value="First year">First year</option>
<option value="Second year">Second year</option>
<option value="Third year"> Third year</option>
<option value="Fourth year"> Fourth year</option>
<option value="Fifth year">Fifth year </option>
<option value="Sixth year">Sixth year</option>
</select>
                                </p>
								<p>
                                    <label for="usernamesignup" class="uname" data-icon="">Ministry</label>
                                    <select name="ministry" id="usernamesignup" required="required" type="text">
                                      <option value="">Select ministry</option>
                                      <option value="None">None</option>
                                      <option value="Praise and Worship">Praise and Worship</option>
                                      <option value="Choir">Choir</option>
                                      <option value="CM"> Creative Ministry</option>
                                      <option value="Decoration team">Decoration team</option>
                                      <option value="Ushering">Ushering</option>
                                      <option value="Intercessory">Intercessory</option>
                                      <option value="ICC">Information and Communication Commitee</option>
                                      <option value="Sunday School">Sunday School</option>
                                      <option value="High School">High School Ministry </option>
                                      <option value="Prisons Ministry">Prisons Ministry</option>
                                      <option value="Hospital Ministry">Hospital Ministry</option>
                                      <option value="Evangelistic team"> Evangelistic team</option>

</select>
                                </p>
								 <p>
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                    <input id="emailsignup" name="email" required="required" type="email" placeholder="Email"/>
                                </p>
                                <p>
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Mobile Number </label>
                                    <input id="passwordsignup" name="mobile" required="required" type="text" placeholder="e.g 0793556912"/>
                                </p>
                                <p>
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Password </label>
                                    <input id="passwordsignup_confirm" name="password" required="required" type="password" placeholder="Password"/>
                                </p>
                                <p>
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Confirm password </label>
                                    <input id="passwordsignup_confirm" name="passwordRepeat" required="required" type="password" placeholder="Confirm password"/>
                                </p>
                                <p class="signin button">
									<input type="submit" value="Register" name="submit"/>
								</p>
                                <p class="change_link">
									Already registered ?
									<a href="#tologin" class="to_register"> Go to Login </a>
								</p>
                            </form>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
