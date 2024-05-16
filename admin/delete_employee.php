<?php
include "include/db_connection.php";

if(isset($_GET["id"])) {
    $id = mysqli_real_escape_string($conn, $_GET["id"]);
    
    // Fetch the user's image filename from the database
    $sql = "SELECT image FROM `users` WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $imageFilename = $row['image'];

        // Construct the path to the image file
        $imagePath = "img/users/$imageFilename";

        // Check if the image file exists before attempting to delete
        if(file_exists($imagePath)) {
            // Attempt to delete the image file
            if(!unlink($imagePath)) {
                // Display an error message if deletion fails
                echo "Failed to delete the image file.";
            }
        } else {
            // Display a message if the image file does not exist
            echo "Image file not found.";
        }
    }

    // Construct the SQL query to delete the user
    $sql = "DELETE FROM `users` WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: employee.php?msg=Data deleted successfully");
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
} else {
    header("Location: employee.php");
    exit();
}
?>
