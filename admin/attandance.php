<?php
include "include/db_connection.php";
// Query to fetch employee attendance data
$query = "SELECT CONCAT(users.first_name, ' ', users.last_name) AS Employee, 
                 COUNT(DISTINCT attendance.date) AS TotalDays,
                 SUM(CASE WHEN attendance.status = 'Absent' THEN 1 ELSE 0 END) AS AbsentClasses,
                 ROUND((SUM(CASE WHEN attendance.status = 'Absent' THEN 1 ELSE 0 END) / COUNT(DISTINCT attendance.date)) * 100, 2) AS AbsentPercentage
          FROM users
          LEFT JOIN attendance ON users.id = attendance.user_id
          GROUP BY users.id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="style.css" />

    <title>Attendance</title>
</head>

<body>
    <?php
    if (!isset($_GET['msg'])) {
    ?>
        <div id="preloader"></div>
    <?php
    }
    ?>
    <!-- Sidebar start -->
    <?php include('sidebar.php'); ?>
    <!-- Sidebar end -->
    <section id="main-content">
        <!-- header start -->
        <?php include('header.php'); ?>
        <!-- header end -->

        <div class="main_contect_body">
            <div class="department_tiltle">
                Attendance
            </div>

            <div class="container">
                <?php
                if (isset($_GET["msg"])) {
                    $msg = $_GET["msg"];
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    '.$msg.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                ?>

                <form class="mb-4" action="take_attendance.php" method="get">
                    <div class="mb-3">
                        <label for="date">Select Date to take attendance:</label>
                        <input type="date" id="date" name="date">
                    </div>
                    <button type="submit" class="btn btn-primary">Take Attendance</button>
                </form>


                                <!-- Table to display attendance report -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Total Days</th>
                                <th>Absent Classes</th>
                                <th>Absent Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through the query result and display data in table rows
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['Employee']}</td>";
                                echo "<td>{$row['TotalDays']}</td>";
                                echo "<td>{$row['AbsentClasses']}</td>";
                                echo "<td>{$row['AbsentPercentage']}%</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- footer start -->
    <?php include('footer.php'); ?>
    <!-- footer end -->
</body>

</html>
