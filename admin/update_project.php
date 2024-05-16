<?php
include "include/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if project ID is set and is a valid integer
    if(isset($_POST['id']) && filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
        $project_id = $_POST['id'];
        
        // Retrieve project details from the form
        $projectName = $_POST['projectName'];
        $progress = $_POST['progress'];
        $department = $_POST['department'];
        $description = $_POST['description'];
        $dueDate = $_POST['dueDate'];

        // Update project details in the database
        $sql = "UPDATE Project SET ProjectName=?, Status=?, DepartmentID=?, Description=?, DueDate=? WHERE ID=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $projectName, $progress, $department, $description, $dueDate, $project_id);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: project.php?msg=Project updated successfully");
            exit();
        } else {
            header("Location: project.php?msg=Failed to update project");
            exit();
        }
    } else {
        header("Location: project.php?msg=Invalid project ID");
        exit();
    }
} else {
    header("Location: project.php?msg=Invalid request");
    exit();
}
?>
