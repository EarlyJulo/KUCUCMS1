<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="KUCU CMS">
    <meta name="author" content="Ali Julo">
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/index_background.css" rel="stylesheet" media="screen"/>
</head>
<?php
include('header.php');
include('session.php');
?>
<body>
    <?php include('navbar.php') ?>
    <div class="container-fluid">
        <div class="row-fluid">
          <?php include('navbar.php') ?>
              <div class="container-fluid">
                  <div class="row-fluid">
             <?php include('sidebar.php'); ?>
                      <div class="span9" id="content">
                          <div class="row-fluid">
                         <?php $query= mysqli_query($conn,"select * from members where id = '$session_id'")or die(mysqli_error());
                     $row = mysqli_fetch_array($query);
                     ?>
                          <div class="col-lg-12">
                            <div class="alert alert-success alert-dismissable">
                               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <img id="avatar1" class="img-responsive" src="<?php echo $row['thumbnail']; ?>"><strong> Welcome! <?php echo $user_row['fname']." ".$user_row['lname'];  ?></strong>
                            </div>
                          </div>
                    <!-- Dashboard content -->
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-dashboard">&nbsp;</i> Dashboard </div>
                            <div class="muted pull-right"><i class="icon-time"></i>&nbsp;<?php include('time.php'); ?></div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <!-- Tithes -->
                                <div class="block-content collapse in">
                                    <div id="page-wrapper">
                                        <?php
                                      /*  $result = mysqli_query($conn,"select *, SUM(Amount) AS value_sum from tithe where na='$session_id' ");
                                        $row = mysqli_fetch_assoc($result);
                                        $sum = $row['value_sum'];
                                        */
                                        ?>
                                        <?php
                                        $count_members2=mysqli_query($conn,"SELECT *
                                                                             FROM  event
                                                                             WHERE  DATE_ADD(STR_TO_DATE(Date, '%Y-%m-%d'), INTERVAL YEAR(CURDATE())-YEAR(STR_TO_DATE(Date, '%Y-%m-%d')) YEAR)
                                                                                    BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)");
                                        $counts = mysqli_num_rows($count_members2);
                                        ?>
                                        <div class="span6">
                                            <div class="panel panel-green">
                                                <!-- Panel Heading -->
                                                <div class="panel-heading">
                                                    <!-- Panel Content -->
                                                    <div class="container-fluid">
                                                        <div class="row-fluid">
                                                            <div class="span3"><br/>
                                                                <i class="fa fa-calendar fa-5x"></i><br/>
                                                            </div>
                                                            <div class="span8 text-right"><br/>
                                                                <div class="huge"><?php echo  $counts; ?></div>
                                                                <div> Upcoming Events </div><br/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Panel Footer -->
                                                <a href="events.php">
                                                    <div class="modal-footer">
                                                        <span class="pull-left">View</span>
                                                        <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>


                                        <?php

// Fetch fname and lname from session
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];

// Query to select records from attendance table
$count_members2 = mysqli_query($conn, "SELECT * FROM attendance WHERE firstname='$fname' AND lastname='$lname'");
$counts = mysqli_num_rows($count_members2);
?>
<div class="span6">
    <div class="panel panel-primary">
        <!-- Panel Heading -->
        <div class="panel-heading">
            <!-- Panel Content -->
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span3"><br/>
                        <i class="fa fa-book fa-5x"></i><br/>
                    </div>
                    <div class="span8 text-right"><br/>
                        <div class="huge"><?php echo $counts; ?></div>
                        <div> Your Confirmed Events </div><br/>
                    </div>
                </div>
            </div>
        </div>
        <!-- Panel Footer -->
        <a href="Confirmed_events.php">
            <div class="modal-footer">
                <span class="pull-left">View</span>
                <span class="pull-right"><i class="icon-chevron-right"></i></span>
                <div class="clearfix"></div>
            </div>
        </a>
    </div>
</div>
