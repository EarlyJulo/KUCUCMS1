<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["mobile"])) {
    // Retrieve user information from the session
    $user_mobile = $_SESSION["mobile"];

    // Fetch user information from the database based on the mobile number
    include('dbconn.php');

    // Prepare the SQL query with a placeholder for the mobile number
    $user_query = mysqli_prepare($conn, "SELECT fname, lname, gender, ministry, year, email FROM members WHERE mobile = ?");

    // Bind the mobile number parameter
    mysqli_stmt_bind_param($user_query, "s", $user_mobile);

    // Execute the query
    mysqli_stmt_execute($user_query);

    // Get the result set
    $user_result = mysqli_stmt_get_result($user_query);

    if ($user_result && mysqli_num_rows($user_result) > 0) {
        // User information fetched successfully
        $user_row = mysqli_fetch_assoc($user_result);
        $firstname = $user_row['fname'];
        $lastname = $user_row['lname'];
        $gender = $user_row['gender'];
        $ministry = $user_row['ministry'];
        $year = $user_row['year']; // Fetch 'year' column
        $email = $user_row['email']; // Fetch 'email' column

        // Retrieve event title from AJAX request
        $event_title = $_POST['event_title'];

        // Retrieve event date from the 'event' table
        $event_date_query = mysqli_prepare($conn, "SELECT Date FROM event WHERE Title = ?");
        mysqli_stmt_bind_param($event_date_query, "s", $event_title);
        mysqli_stmt_execute($event_date_query);
        mysqli_stmt_bind_result($event_date_query, $event_date);
        mysqli_stmt_fetch($event_date_query);
        mysqli_stmt_close($event_date_query);

        // Bind the mobile number from session
        $mobile_number = $user_mobile;

        // Insert user, event name, and event date into the attendance table
        $attendance_query = mysqli_prepare($conn, "INSERT INTO attendance (firstname, lastname, mobile_number, gender, ministry, year, email, event_title, event_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($attendance_query, "ssssissss", $firstname, $lastname, $mobile_number, $gender, $ministry, $year, $email, $event_title, $event_date);
        mysqli_stmt_execute($attendance_query);

        if (mysqli_stmt_affected_rows($attendance_query) > 0) {
            echo "Attendance recorded successfully.";
        } else {
            echo "Error recording attendance.";
        }

        mysqli_stmt_close($attendance_query);
    } else {
        // Error retrieving user information from the database
        echo 'Error: Unable to retrieve user information from the database';
    }

    mysqli_close($conn);

} else {
    // User is not logged in
    echo "User is not logged in.";
}
?>
