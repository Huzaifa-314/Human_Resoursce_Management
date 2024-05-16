<?php
include "include/db_connection.php";

// Check if project ID is set and is a valid integer
if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $document_id = $_GET['id'];

    // Delete document from the database
    $sql = "DELETE FROM documents WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $document_id);
    mysqli_stmt_execute($stmt);

    // Check if the deletion was successful
    if(mysqli_stmt_affected_rows($stmt) > 0) {
        // Redirect to document.php with success message
        header("Location: document.php?msg=document deleted successfully");
        exit();
    } else {
        // Redirect to document.php with error message
        header("Location: document.php?msg=Failed to delete document");
        exit();
    }
} else {
    // Redirect to document.php with error message if document ID is not valid
    header("Location: document.php?msg=Invalid document ID");
    exit();
}
?>
