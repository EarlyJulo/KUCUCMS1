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
                    

                    <?php
                    $count_log=mysqli_query($conn,"select * from event");
                    $count = mysqli_num_rows($count_log);

                    ?>
                    <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left"><i class="icon-book"></i> Events</div>
                            <div class="muted pull-right">
                                Number of Events: <span class="badge badge-info"><?php  echo $count; ?></span>
                            </div>
                        </div>
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <div class="empty">
                                    <div class="pull-right">
                                        <a href="print_EventsDetails.php" class="btn btn-info" id="print" data-placement="left" title="Click to Print"><i class="icon-print icon-large"></i> Print List</a>
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
                                <form action="EventsDetails.php" method="post">
                                    <div class="form-group">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                                <hr>
                                <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
                                    <thead>
                                        <tr>
                                            <th>Check</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Content</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_POST['start_date']) && isset($_POST['end_date'])){
                                            $start_date = $_POST['start_date'];
                                            $end_date = $_POST['end_date'];
                                            $members_query = mysqli_query($conn,"SELECT * FROM event WHERE Date BETWEEN '$start_date' AND '$end_date'")or die(mysqli_error());
                                        } else {
                                            $members_query = mysqli_query($conn,"SELECT * FROM event")or die(mysqli_error());
                                        }
                                        while($row = mysqli_fetch_array($members_query)){
                                            $username = $row['id'];
                                            $id= $row['id'];
                                        ?>
                                        <tr>
                                            <td width="70">
                                                <input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
                                            </td>
                                            <td><?php echo $row['Title']; ?></td>
                                            <td><?php echo $row['Date']; ?></td>
                                            <td><?php echo $row['content']; ?></td>
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
        <?php include('script.php'); ?>
    </div>
</body>
