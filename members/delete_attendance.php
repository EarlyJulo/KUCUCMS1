<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["mobile"])) {
    // Retrieve user information from the session
    $user_mobile = $_SESSION["mobile"];

    // Check if the event title is provided
    if (isset($_POST['event_title'])) {
        // Sanitize the event title
        $event_title = $_POST['event_title'];

        // Include database connection
        include('dbconn.php');

        // Delete attendance record for the user and event title
        $delete_query = mysqli_prepare($conn, "DELETE FROM attendance WHERE event_title = ? AND mobile_number = ?");
        mysqli_stmt_bind_param($delete_query, "ss", $event_title, $user_mobile);

        // Execute the query
        mysqli_stmt_execute($delete_query);

        // Check if any row was affected
        if (mysqli_stmt_affected_rows($delete_query) > 0) {
            echo "success";
        } else {
            echo "Error deleting attendance record.";
        }

        // Close the statement
        mysqli_stmt_close($delete_query);

        // Close the database connection
        mysqli_close($conn);
    } else {
        // Event title not provided
        echo "Error: Event title not provided.";
    }
} else {
    // User is not logged in
    echo "User is not logged in.";
}
?>
