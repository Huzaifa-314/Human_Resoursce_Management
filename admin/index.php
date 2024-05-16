<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

include "include/db_connection.php";

// Retrieve counts from the database
$sql_departments = "SELECT COUNT(*) AS department_count FROM Department";
$result_departments = mysqli_query($conn, $sql_departments);
$row_departments = mysqli_fetch_assoc($result_departments);
$department_count = $row_departments['department_count'];

$sql_projects = "SELECT COUNT(*) AS project_count FROM Project";
$result_projects = mysqli_query($conn, $sql_projects);
$row_projects = mysqli_fetch_assoc($result_projects);
$project_count = $row_projects['project_count'];

$sql_leaves = "SELECT COUNT(*) AS leave_count FROM leaves";
$result_leaves = mysqli_query($conn, $sql_leaves);
$row_leaves = mysqli_fetch_assoc($result_leaves);
$leave_count = $row_leaves['leave_count'];

$sql_employees = "SELECT COUNT(*) AS employee_count FROM users";
$result_employees = mysqli_query($conn, $sql_employees);
$row_employees = mysqli_fetch_assoc($result_employees);
$employee_count = $row_employees['employee_count'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="style.css"/>

</head>

<body >
<?php
if(!isset($_GET['msg'])){
?>
<div id="preloader"></div>
<?php
}
?>

<!-- Sidebar start -->
<?php include ('sidebar.php'); ?> 
<!-- Sidebar end -->

<section id="main-content">
    <!-- header start -->
    <?php include ('header.php'); ?> 
    <!-- header end -->

    <div class="clear"></div>
    <div class="main-content-info container">
        <a href="departments.php" class="card-box">
            <h2 class="cus-num cus-h"><?php echo $department_count; ?></h2>
            <p>Departments</p>
        </a>
        <a href="project.php" class="card-box">
            <h2 class="cus-num cus-pro"><?php echo $project_count; ?></h2>
            <p>Projects</p>
        </a>
        <a href="leave.php" class="card-box">
            <h2 class="cus-num cus-ord"><?php echo $leave_count; ?></h2>
            <p>Leaves</p>
        </a>
        <a href="employee.php" class="card-box">
            <h2 class="cus-num cus-inc"><?php echo $employee_count; ?></h2>
            <p>Employees</p>
        </a>
        <div class="clear"></div>
    </div>
    <div class="content-pro-par container">
        <div class="pro-table">
            <div class="recent-pro">
                <div class="rec-h">
                    <h2>Recent Project</h2>

                </div>

                <div class="rec-btn">
                    <a href="project.php">See All</a>

                </div>
                <div class="clear"></div>
            </div>

            <table style="width: 100%;" class="mb-3">
                <tr>
                    <th>Project Title</th>
                    <th> Department</th>
                    <th> Status</th>
                </tr>
                <?php
                // Retrieve recent projects from the database
                $sql_recent_projects = "SELECT * FROM Project ORDER BY created_date DESC LIMIT 10";
                $result_recent_projects = mysqli_query($conn, $sql_recent_projects);
                while ($row_recent_project = mysqli_fetch_assoc($result_recent_projects)) {
                    echo "<tr>";
                    echo "<td>" . $row_recent_project['ProjectName'] . "</td>";
                    echo "<td>" . $row_recent_project['DepartmentID'] . "</td>";
                    echo "<td>" . $row_recent_project['Status'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</section>
</body>

<!-- footer start -->
<?php include ('footer.php'); ?> 
<!-- footer end -->
