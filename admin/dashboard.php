<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="KUCU CMS">
    <meta name="author" content="Ali Julo">
    <link href="bootstrap/css/index_background.css" rel="stylesheet" media="screen"/>

</head>
<?php
// Include necessary files
include('header.php');
include('session.php');
include('navbar.php');
?>

<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <?php
                    // Fetch admin data
                    $query = mysqli_query($conn,"select * from admin where admin_id = '$session_id'") or die(mysqli_error($conn));
                    $row = mysqli_fetch_array($query);
                    ?>
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php
                            // Check if admin data exists
                            if ($row && isset($row['firstname']) && isset($row['lastname'])) {
                                // Output welcome message with admin's first name and last name
                                echo '<img id="avatar1" class="img-responsive" src="' . $row['adminthumbnails'] . '">';
                                echo '<strong> Welcome! ' . $row['firstname'] . ' ' . $row['lastname'] . '</strong>';
                            } else {
                                // Output a default welcome message
                                echo '<strong> Welcome, Admin!</strong>';
                            }
                            ?>
                        </div>
                    </div>
                    <!-- block -->
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-dashboard">&nbsp;</i>Dashboard </div>
                            <div class="muted pull-right"><i class="icon-time"></i>&nbsp;<?php include('time.php'); ?></div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <div class="block-content collapse in">
                                    <div id="page-wrapper">
                                        <?php
                                        // Fetch members count
                                        $student = mysqli_query($conn,"select * from members ")or die(mysqli_error($conn));
                                        $student_count = mysqli_num_rows($student);
                                        ?>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                        <div class="container-fluid">
                                                            <div class="row-fluid">
                                                                <div class="span3"><br/>
                                                                    <i class="fa fa-users fa-5x"></i><br/>
                                                                </div>
                                                                <div class="span8 text-right"><br/>
                                                                    <div class="huge"><?php echo $student_count; ?></div>
                                                                    <div>All members</div><br/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="membersDetail.php">
                                                        <div class="modal-footer">
                                                            <span class="pull-left">View Details</span>
                                                            <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            // Fetch new members count
                                            $new = mysqli_query($conn,"SELECT * FROM members WHERE DATE_SUB(STR_TO_DATE(date, '%Y-%m-%d'), INTERVAL YEAR(CURDATE())-YEAR(STR_TO_DATE(date, '%Y-%m-%d')) YEAR) BETWEEN CURDATE() AND DATE_SUB(CURDATE(), INTERVAL -2 DAY)") or die(mysqli_error($conn));
                                            $new_count = mysqli_num_rows($new);
                                            ?>
                                            <div class="span6">
                                                <div class="panel panel-green">
                                                    <div class="panel-heading">
                                                        <div class="container-fluid">
                                                            <div class="row-fluid">
                                                                <div class="span3"><br/>
                                                                    <i class="fa fa-plus-circle fa-5x" aria-hidden="true"></i><br/>
                                                                </div>
                                                                <div class="span8 text-right"><br/>
                                                                    <div class="huge"><?php echo $new_count;?></div>
                                                                    <div>New members</div><br/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="add_members.php">
                                                        <div class="modal-footer">
                                                            <span class="pull-left">Add member</span>
                                                            <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        // Fetch attendance count
                                        $attendance = mysqli_query($conn,"SELECT * FROM attendance") or die(mysqli_error($conn));
                                        $attendance_count = mysqli_num_rows($attendance);
                                        ?>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div class="panel panel-yellow">
                                                    <div class="panel-heading">
                                                        <div class="container-fluid">
                                                            <div class="row-fluid">
                                                                <div class="span3"><br/>
                                                                    <i class="fa fa-book fa-5x"></i><br/>
                                                                </div>
                                                                <div class="span8 text-right"><br/>
                                                                    <div class="huge"><?php echo $attendance_count; ?></div>
                                                                    <div>Total Attendances</div><br/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="attendanceDetails.php">
                                                        <div class="modal-footer">
                                                            <span class="pull-left">View All</span>
                                                            <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php
                                            // Fetch event count
                                            $new = mysqli_query($conn,"SELECT * FROM event") or die(mysqli_error($conn));
                                            $new_count = mysqli_num_rows($new);
                                            ?>
                                            <div class="span6">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                        <div class="container-fluid">
                                                            <div class="row-fluid">
                                                                <div class="span3"><br/>
                                                                    <i class="fa fa-trophy fa-5x" aria-hidden="true"></i><br/>
                                                                </div>
                                                                <div class="span8 text-right"><br/>
                                                                    <div class="huge"><?php echo $new_count;?></div>
                                                                    <div>All Events</div><br/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="EventsDetails.php">
                                                        <div class="modal-footer">
                                                            <span class="pull-left">View All</span>
                                                            <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include('footer.php'); ?>
            </div>
        </div>
    </div>
    <?php include('script.php'); ?>
</body>

</html>
