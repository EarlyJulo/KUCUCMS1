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
                    // Enable error reporting
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);

                    // Counting total members
                    $count_log = mysqli_query($conn, "SELECT * FROM members");
                    $count = mysqli_num_rows($count_log);

                    // Counting female members
                    $female_count_query = mysqli_query($conn, "SELECT COUNT(*) as female_count FROM members WHERE Gender = 'Female'");
                    $female_count_data = mysqli_fetch_assoc($female_count_query);
                    $female_count = $female_count_data['female_count'];

                    // Counting male members
                    $male_count_query = mysqli_query($conn, "SELECT COUNT(*) as male_count FROM members WHERE Gender = 'Male'");
                    $male_count_data = mysqli_fetch_assoc($male_count_query);
                    $male_count = $male_count_data['male_count'];
                    ?>
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-user"></i> KUCU Members</div>
                            <div class="muted pull-right">
                                Number of members: <span class="badge badge-info"><?php echo $count; ?></span>
                                | Female: <span class="badge badge-info"><?php echo $female_count; ?></span>
                                | Male: <span class="badge badge-info"><?php echo $male_count; ?></span>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="empty">
                                    <div class="pull-right">
                                        <a href="print_members.php" class="btn btn-info" id="print" data-placement="left" title="Click to Print"><i class="icon-print icon-large"></i> Print List</a>
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
                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                                    <a data-placement="right" title="Click to Delete checked item" data-toggle="modal" href="#delete_member" id="delete"  class="btn btn-danger" name=""><i class="icon-trash icon-large"> Delete</i></a>
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
                                            <th>Residence</th>
                                            <th>Reg. No.</th>
                                            <th>Ministry</th>
                                            <th>Mobile No.</th>
                                            <th>Year</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $members_query = mysqli_query($conn, "SELECT * FROM members") or die(mysqli_error());

                                        // Displaying members
                                        while ($row = mysqli_fetch_array($members_query)) {
                                            $id = $row['id'];
                                        ?>
                                            <tr>
                                                <td width="70">
                                                    <input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
                                                </td>
                                                <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                                <td><?php echo $row['Gender']; ?></td>
                                                <td><?php echo $row['Residence']; ?></td>
                                                <td><?php echo $row['Registration']; ?></td>
                                                <td><?php echo $row['ministry']; ?></td>
                                                <td><?php echo $row['mobile']; ?></td>
                                                <td><?php echo $row['year']; ?></td>
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
