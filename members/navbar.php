<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <span class="brand" href="#">KUCU CMS Members Panel</span>
            </div>
            <!--.nav-collapse -->
            <div class="nav-collapse collapse">
                <ul class="nav pull-right">
                    <?php
                    // Establish database connection
                    include('dbconn.php'); // Assuming connection details are in connection.php
                    // Check if the connection is successful
                    if ($conn) {
                        // Execute query
                        $query = "SELECT * FROM members WHERE id = '$session_id'";
                        $result = mysqli_query($conn, $query);
                        // Check if the query was successful
                        if ($result) {
                            $row = mysqli_fetch_array($result);
                            ?>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                                    <img id="avatar1" class="img-responsive" src="<?php echo $row['thumbnail']; ?>">
                                    &nbsp;<?php echo $row['fname']." ".$row['lname']; ?>
                                    <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="change_password_admin.php">
                                            <i class="icon-cog"></i>&nbsp;Change Password
                                        </a>
                                        <a tabindex="-1" href="#mymodal3" data-toggle="modal">
                                            <i class="icon-picture"></i>&nbsp;Change Picture
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="logout.php">
                                            <i class="icon-signout"></i>&nbsp;Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php
                        } else {
                            // Handle query error
                            echo "Error executing query: " . mysqli_error($conn);
                        }
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        // Handle connection error
                        echo "Error connecting to database: " . mysqli_connect_error();
                    }
                    ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
<?php include('admin_change_picture.php'); ?>
