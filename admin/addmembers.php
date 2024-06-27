
  <div class="row-fluid">
                        <!-- block -->
 <div class="block">
 <div class="navbar navbar-inner block-header">
<div class="muted pull-left"><i class="icon-plus-sign icon-large"> Register New member</i></div>
</div>
<div class="block-content collapse in">
                                <div class="span12">

								 <!--------------------form------------------->
								<form method="post">
					<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="fname" id="focusedInput" type="text" placeholder = "First Name" required>
                                   </p>
                                 </div>
                                  </div>
								  </p>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="sname" id="focusedInput" type="text" placeholder = "Middlename" required>
                                   </p>
                                 </div>
                                  </div>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="lname" id="focusedInput" type="text" placeholder = "Last name" required>
                                   </p>
                                 </div>
                                  </div>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                      <select class="input focused" name="gender" id="focusedInput" required="required" type="text">
                                            <option value="Select Gender">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>

                                        </select>
                                   </p>
                                 </div>
                                  </div>
                                  <p>
                                    <div class="controls">
                                     <p>
                                       <input class="input focused" name="residence" id="focusedInput" type="text" placeholder = "Residence" required>
                                     </p>
                                   </div>
                                    </div>
                    </p>

								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="Registration" id="focusedInput" type="text" placeholder = "Registration" required>
                                   </p>
                                 </div>
                                  </div>
								  </p>
								<div class="control-group">
                                <p> <div class="controls">
                                   <p>
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
                                 </div>
                                  </div>
								  </p>

	<div class="control-group">
  <p> <div class="controls">
                                   <p>
                                    <select class="input focused" name="ministry" id="focusedInput" required="required" type="text">
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
                                 </div>
                                  </div>
								  </p>

									<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="mobile" id="focusedInput" type="text" placeholder = "mobile number" required>
                                   </p>
                                 </div>
                                  </div>
								  </p>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="email" id="focusedInput" type="email" placeholder = "Email" >
                                   </p>
                                 </div>
                                  </div>
								  </p>

								  </p>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="password" id="focusedInput" type="password" placeholder = "password " required>
                                   </p>
                                 </div>
                                  </div>
								  </p>
                                    </div>



										<div class="control-group">
                                          <div class="controls">
 <button name="save" class="btn btn-info" id="save" data-placement="right" title="Click to Save"><i class="icon-plus-sign icon-large"> Save</i></button>
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
                                          </div>
                                        </div>
                                </form>

								</div>
                            </div>
                        </div>
                        <!-- /block -->

<?php
if (isset($_POST['save'])){
$fname = $_POST['fname'];
$sname = $_POST['sname'];
$lname = $_POST['lname'];
$Gender = $_POST['gender'];
$Residence= $_POST['residence'];
$Registration = $_POST['Registration'];
$ministry = $_POST['ministry'];
$mobile= $_POST['mobile'];
$email= $_POST['email'];
$year=$_POST['year'];
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

mysqli_query($conn,"insert into activity_log (date,username,action) values(NOW(),'$admin_username','Added member $mobile')")or die(mysqli_error());
?>
<script>
window.location = "add_members.php";
$.jGrowl("member Successfully added", { header: 'member add' });
</script>
<?php
}
}
?>
