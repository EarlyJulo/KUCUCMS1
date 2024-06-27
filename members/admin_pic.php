<?php
// Include database connection file
include('lib/dbcon.php');
// Establish database connection
$db_connection = dbcon();
if (!$db_connection) {
    die('Database connection failed.'); // Add error handling for failed connection
}

// Include session file
include('session.php');

// Check if the 'change' form has been submitted
if (isset($_POST['change'])) {
    // Retrieve and sanitize the uploaded image
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $image_name = addslashes($_FILES['image']['name']);
    $image_size = getimagesize($_FILES['image']['tmp_name']);

    // Move the uploaded image to the 'uploads' directory
    move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES["image"]["name"]);
    $thumbnail = "uploads/" . $_FILES["image"]["name"];

    // Prepare and execute the SQL query to update the admin's thumbnail
    $update_query = "UPDATE members SET thumbnail = ? WHERE id = ?";

    // Error handling for preparing the query
    $stmt = $db_connection->prepare($update_query);
    if (!$stmt) {
        // Query preparation failed, handle the error
        die('Error: ' . $db_connection->error);
    }

    // Bind parameters
    $stmt->bind_param("si", $thumbnail, $session_id);

    // Execute the update query
    if (!$stmt->execute()) {
        // Query execution failed, handle the error
        die('Error executing query: ' . $stmt->error);
    }

    // Redirect to the dashboard after successful update
    header("Location: dashboard.php");
    exit(); // Ensure script execution stops after redirection
}
?>
