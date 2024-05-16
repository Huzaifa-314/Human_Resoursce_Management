<?php
include "include/db_connection.php";

// Check if leave ID is set and is a valid integer
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $leave_id = $_GET['id'];

    // Delete leave record from the database
    $sql = "DELETE FROM leaves WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $leave_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect to leave.php with success message
    header("Location: leave.php?msg=Leave deleted successfully");
    exit();
} else {
    // Redirect to leave.php with error message if leave ID is not valid
    header("Location: leave.php?msg=Invalid leave ID");
    exit();
}
?>
