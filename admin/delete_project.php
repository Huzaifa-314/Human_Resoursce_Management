<?php
include "include/db_connection.php";

// Check if project ID is set and is a valid integer
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $project_id = $_GET['id'];

    // Delete project from the database
    $sql = "DELETE FROM Project WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $project_id);
    mysqli_stmt_execute($stmt);

    // Check if the deletion was successful
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        // Redirect to project.php with success message
        header("Location: project.php?msg=Project deleted successfully");
        exit();
    } else {
        // Redirect to project.php with error message
        header("Location: project.php?msg=Failed to delete project");
        exit();
    }
} else {
    // Redirect to project.php with error message if project ID is not valid
    header("Location: project.php?msg=Invalid project ID");
    exit();
}
?>
