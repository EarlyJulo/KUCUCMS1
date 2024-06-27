<?php
        include('lib/dbcon.php');
		dbcon();
		session_start();
		$username = $_POST['username'];
		$password = $_POST['password'];
    $admin_id = $_POST['admin_id'];

		/*................................................ admin .....................................................*/
			$query = "SELECT * FROm admin WHERE username='$username' AND password='$password'";
			$result = mysqli_query($conn,$query)or die(mysqli_error());
			$row = mysqli_fetch_array($result);
			$num_row = mysqli_num_rows($result);

      if( $num_row > 0 ) {
  		$_SESSION['id']=$row['admin_id'];
  		echo 'true_admin';


		/*...................................................student ..............................................*/
		$query_student = mysqli_query($conn,"SELECT * FROm student WHERE username='$username' AND password='$password'")or die(mysqli_error());
		$num_row_student = mysqli_num_rows($query_student);
		$row_student = mysqli_fetch_array($query_student);



		}

		?>
