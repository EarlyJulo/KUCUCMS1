<?php
error_reporting(0);
$conn = mysqli_connect('localhost', 'root','', 'cman');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
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

        $query = @mysqli_query($conn,"select * from members where  mobile = '$mobile'  ")or die(mysqli_error());
        $count = mysqli_num_rows($query);

        if ($count > 0){ ?>
        <script>
        alert('This member Already Exists');
        </script>
        <?php
        }else{
        mysqli_query($conn,"insert into members (fname,sname,lname,Gender,Residence,Registration, ministry,mobile,email,year,thumbnail,password,id)
        values('$fname','$sname','$lname','$Gender','$Residence','$Registration','$ministry','$mobile','$email','$year','uploads/none.png','$password','$mobile')")or die(mysqli_error());

$result = mysqli_query($conn, $query);
                // Insert successful
                echo "<script>alert('Member Successfully added');</script>";
            } else {
                // Insert failed
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }

    }
}
?>
