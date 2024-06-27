<?php include('header.php'); ?>
<?php include('session.php'); ?>
<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <!-- block -->
                    <div class="empty"></div>

                    <?php
                    // Fetching the selected date range
                    $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : '';
                    $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : '';

                    // Query for counting filtered attendance records
                    if (!empty($startDate) && !empty($endDate)) {
                        $count_log = mysqli_query($conn, "SELECT COUNT(*) AS count FROM attendance WHERE event_date BETWEEN '$startDate' AND '$endDate'");
                    } else {
                        $count_log = mysqli_query($conn, "SELECT COUNT(*) AS count FROM attendance");
                    }

                    // Getting the count of filtered attendance records
                    $count_row = mysqli_fetch_assoc($count_log);
                    $count = $count_row['count'];
                    ?>
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-user"></i>Total Events Attendance</div>
                            <div class="muted pull-right">
                                Records of Attendance: <span class="badge badge-info"><?php echo $count; ?></span>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="empty">
                                    <div class="pull-right">
                                        <a href="print_attendanceDetails.php" class="btn btn-info" id="print" data-placement="left" title="Click to Print"><i class="icon-print icon-large"></i> Print List</a>
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#print').tooltip('show');
                                                $('#print').tooltip('hide');
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span12">
                                <div class="row-fluid">
                                    <div class="span6">
                                        <form action="attendanceDetails.php" method="post">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">
                                    </div>
                                    <div class="span6">
                                            <label for="end_date">End Date:</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    </form>
                                </div>
                                <hr>
                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                                    <thead>
                                        <tr>
                                            <th>Check</th>
                                            <th>Name</th>
                                            <th>Mobile Number</th>
                                            <th>Gender</th>
                                            <th>Year</th>
                                            <th>Email</th>
                                            <th>Event Title</th>
                                            <th>Event Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Query for attendance records with or without date range filter
                                        if (!empty($startDate) && !empty($endDate)) {
                                            $attendance_query = mysqli_query($conn, "SELECT * FROM attendance WHERE event_date BETWEEN '$startDate' AND '$endDate'") or die(mysqli_error());
                                        } else {
                                            $attendance_query = mysqli_query($conn, "SELECT * FROM attendance") or die(mysqli_error());
                                        }

                                        // Displaying filtered attendance records
                                        while ($row = mysqli_fetch_array($attendance_query)) {
                                            $id = $row['id'];
                                        ?>
                                            <tr>
                                                <td width="70">
                                                    <input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
                                                </td>
                                                <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                                <td><?php echo $row['mobile_number']; ?></td>
                                                <td><?php echo $row['gender']; ?></td>
                                                <td><?php echo $row['year']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['event_title']; ?></td>
                                                <td><?php echo $row['event_date']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </div>
    <?php include('script.php'); ?>
</body>
