<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php
// Get current date
$current_date = date("Y-m-d");
?>
<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>
            <div class="span9" id="content">
                <div class="row-fluid">
                    <!-- block -->


                    <?php
                    $count_log = mysqli_query($conn, "SELECT * FROM members");
                    $count = mysqli_num_rows($count_log);

                    ?>
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-book"></i> Your Events</div>
                            <div class="muted pull-right">
                                Number of Events: <span class="badge badge-info"><?php echo $count; ?></span>
                            </div>
                        </div>
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
                                <form action="delete_member.php" method="post">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                                        <script type="text/javascript">
                                            $(document).ready(function(){
                                                $('#delete').tooltip('show');
                                                $('#delete').tooltip('hide');
                                            });
                                        </script>
                                        <?php include('modal_delete.php'); ?>
                                        <thead>
                                            <tr>
                                                <th>Check</th>
                                                <th>Name</th>
                                                <th>Gender</th>
                                                <th>Year</th>
                                                <th>Email</th>
                                                <th>Event Title</th>
                                                <th>Event Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-----------------------------------Content------------------------------------>
                                            <?php
                                            // Fetch fname, lname, gender, and year from session
                                            $fname = $_SESSION['fname'];
                                            $lname = $_SESSION['lname'];
                                            $gender = $_SESSION['gender'];
                                            $year = $_SESSION['year'];

                                            $members_query = mysqli_query($conn, "SELECT * FROM attendance WHERE firstname='$fname' AND lastname='$lname'");
                                            while ($row = mysqli_fetch_array($members_query)) {
                                                $username = $row['id'];
                                                $id = $row['id'];
                                            ?>
                                            <tr <?php if ($row['event_date'] >= $current_date) echo 'style="font-weight:bold; color:blue;"'; ?>>

                                                    <td width="70">
                                                        <input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
                                                    </td>
                                                    <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                                                    <td><?php echo $row['gender']; ?></td>
                                                    <td><?php echo $row['year']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['event_title']; ?></td>
                                                    <td><?php echo $row['event_date']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
            </div>
            <?php include('footer.php'); ?>
        </div>
        <?php include('script.php'); ?>
    </div>
</body>
