<?php
include "include/db_connection.php";

// Check if salary ID is set and is a valid integer
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $salaryId = $_GET['id'];

    // Delete salary from the database
    $sql = "DELETE FROM salary WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $salaryId);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: salary.php?msg=Salary deleted successfully");
        exit();
    } else {
        header("Location: salary.php?msg=Failed to delete salary");
        exit();
    }
} else {
    // Redirect to salary.php with error message if salary ID is not valid
    header("Location: salary.php?msg=Invalid salary ID");
    exit();
}
?>
