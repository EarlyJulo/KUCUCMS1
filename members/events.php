<?php include('header.php'); ?>
<?php include('session.php'); ?>
<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>

            <div class="span9" id="content">
                <div class="row-fluid">
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('#add').tooltip('show');
                            $('#add').tooltip('hide');
                        });
                    </script>
                    <div id="sc" align="center"><image src="images/kucu logo.png" width="45%" height="45%"/></div>
                    <?php
                    $count_members = mysqli_query($conn, "SELECT *
                        FROM  event
                        WHERE  DATE_ADD(STR_TO_DATE(Date, '%Y-%m-%d'), INTERVAL YEAR(CURDATE())-YEAR(STR_TO_DATE(Date, '%Y-%m-%d')) YEAR)
                        BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)");
                    $count = mysqli_num_rows($count_members);
                    ?>
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-reorder icon-large"></i>Upcoming Events</div>
                            <div class="muted pull-right">
                                Upcoming Events <span class="badge badge-info"><?php echo $count; ?></span>
                            </div>
                        </div>

                        <h4 id="sc">members List
                            <div align="right" id="sc">Date:
                                <?php
                                $date = new DateTime();
                                echo $date->format('l, F jS, Y');
                                ?></div>
                        </h4>


                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="empty">
                                    <div class="pull-right">
                                        <script type="text/javascript">
                                            $(document).ready(function(){
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
                                <form action="" method="post">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th>TITLE</th>
                                                <th>DATE </th>
                                                <th>DESCRIPTION</th>
                                                <th>ACTION</th> <!-- New column for the button -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $members_query = mysqli_query($conn, "SELECT event.*, attendance.mobile_number
                                                FROM event
                                                LEFT JOIN attendance ON event.Title = attendance.event_title AND attendance.mobile_number = '".$_SESSION['mobile']."'
                                                WHERE  DATE_ADD(STR_TO_DATE(Date, '%Y-%m-%d'), INTERVAL YEAR(CURDATE())-YEAR(STR_TO_DATE(Date, '%Y-%m-%d')) YEAR)
                                                BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)") or die(mysqli_error());
                                            while ($row = mysqli_fetch_array($members_query)) {
                                                $username = $row['id'];
                                            ?>
                                            <tr>
                                                <td><?php echo $row['Title']; ?></td>
                                                <td><?php echo $row['Date']; ?></td>
                                                <td><?php echo $row['content']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['mobile_number']) {
                                                        // User has confirmed attendance, display the cancel button
                                                        ?>
                                                        <button class="btn btn-danger cancelAttendance" data-event-title="<?php echo $row['Title']; ?>">
                                                            Cancel Attendance
                                                        </button>
                                                        <?php
                                                    } else {
                                                        // User hasn't confirmed attendance, display the confirmation button
                                                        ?>
                                                        <button class="btn btn-primary confirmAttendance" data-event-title="<?php echo $row['Title']; ?>">
                                                            Confirm Attendance
                                                        </button>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('footer.php'); ?>
        </div>
    </div>
    <?php include('script.php'); ?>
    <script>
        $(document).ready(function() {
            // Function to handle confirming attendance
            $('.confirmAttendance').click(function() {
                var eventTitle = $(this).data('event-title'); // Get the event title from the button
                var button = $(this);

                // Send AJAX request to update attendance status
                $.ajax({
                    url: 'update_attendance.php',
                    type: 'POST',
                    data: { event_title: eventTitle }, // Send event title to PHP script
                    success: function(response) {
                        // Toggle button text and class based on response
                        if (response === 'confirmed') {
                            button.text('Cancel Attendance').removeClass('btn-primary').addClass('btn-danger');
                        } else if (response === 'cancelled') {
                            button.text('Confirm Attendance').removeClass('btn-danger').addClass('btn-primary');
                        } else {
                            alert('AJAX says: ' + response);
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            // Function to handle canceling attendance
            $('.cancelAttendance').click(function() {
                var eventTitle = $(this).data('event-title'); // Get the event title from the button
                var button = $(this);

                // Send AJAX request to delete attendance record
                $.ajax({
                    url: 'delete_attendance.php',
                    type: 'POST',
                    data: { event_title: eventTitle }, // Send event title to PHP script
                    success: function(response) {
                        if (response === 'success') {
                            // Reset button text and class
                            button.text('Confirm Attendance').removeClass('btn-danger').addClass('btn-primary');
                        } else {
                            alert('An issue occurred with the AJAX request: ' + response);
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>
