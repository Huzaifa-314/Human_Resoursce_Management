<?php
include "include/db_connection.php";
session_start();

// Check if user ID is set and is a valid integer
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['id'];

    // Retrieve user details from the database
    $sql = "SELECT u.*, d.name AS department_name, des.name AS designation_name, p.ProjectName
    FROM users u
    LEFT JOIN designation des ON u.desig_id = des.id
    LEFT JOIN department d ON des.department_id = d.id
    LEFT JOIN project p ON u.id = p.DepartmentID
    WHERE u.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        // Redirect to dashboard.php with error message if user does not exist
        header("Location: logout.php");
        exit();
    }
} else {
    // Redirect to dashboard.php with error message if user ID is not valid
    header("Location: login.php?success=Login First");
    exit();
}
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

    <title>Leave</title>
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
                Leave Information
            </div>

            <div class="container">
                <?php
                if (isset($_GET["msg"])) {
                    $msg = $_GET["msg"];
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  ' . $msg . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                ?>
        <div class="row">
            <!-- Left side: User details -->
            <div class="col-md-6">
                <h2>User Details</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td><?php echo $user['id']; ?></td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td><?php echo $user['first_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td><?php echo $user['last_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $user['email']; ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo $user['gender']; ?></td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td><?php echo $user['dob']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Right side: Additional information -->
            <div class="col-md-6">
                <h2>Additional Information</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Department</th>
                            <td><?php echo $user['department_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td><?php echo $user['designation_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Assigned Project</th>
                            <td>
                            <table class="table table-hover text-center">
                                <tbody>
                                    <?php
                                    $user_id=$_SESSION['id'];

                                    $no = 1;
                                    $sql = "SELECT p.*, d.name AS department_name 
                                    FROM project p 
                                    INNER JOIN department d ON p.DepartmentID = d.ID
                                    INNER JOIN designation des ON d.id = des.department_id
                                    INNER JOIN users u ON des.id = u.desig_id
                                    WHERE u.id = $user_id;
                                    ";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td>
                                        <?php echo $no; ?>
                                        </td>
                                        <td>
                                        <?php echo $row["ProjectName"] ?>
                                        </td>
                                        <td>
                                        <a href="view_project.php?id=<?php echo $row["ID"] ?>" class="link-primary"><i class="fas fa-eye"></i></a>
                                        <a href="edit_project.php?id=<?php echo $row["ID"] ?>" class="link-primary"><i class="fa-solid fa-pen-to-square fs-5"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $no++;
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
