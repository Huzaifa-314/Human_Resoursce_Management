<?php
include "include/db_connection.php";
$id = $_GET["id"];
$sql = "DELETE FROM `department` WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: departments.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}