<?php
include "include/db_connection.php";
session_start();

// Check if leave ID is set and is a valid integer
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $leave_id = $_GET['id'];

    // Retrieve leave details from the database
    $sql = "SELECT l.*, u.first_name, u.last_name 
            FROM leaves l 
            INNER JOIN users u ON l.user_id = u.id
            WHERE l.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $leave_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if leave exists
    if (mysqli_num_rows($result) > 0) {
        $leave = mysqli_fetch_assoc($result);
    } else {
        // Redirect to leave.php with error message if leave does not exist
        header("Location: leave.php?msg=Leave not found");
        exit();
    }
} else {
    // Redirect to leave.php with error message if leave ID is not valid
    header("Location: leave.php?msg=Invalid leave ID");
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
                <h2>Leave Details</h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Leave ID</th>
                            <td><?php echo $leave['id']; ?></td>
                        </tr>
                        <tr>
                            <th>User</th>
                            <td><?php echo $leave['first_name'] . ' ' . $leave['last_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td><?php echo $leave['subject']; ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?php echo $leave['description']; ?></td>
                        </tr>
                        <tr>
                            <th>Attachment</th>
                            <td>
                                <?php if (!empty($leave['attachment'])) : ?>
                                    <a href="uploads/documents/<?php echo $leave['attachment']; ?>" target="_blank">
                                        <?php echo $leave['attachment']; ?>
                                    </a>
                                <?php else : ?>
                                    No attachment
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?php echo $leave['status']; ?></td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td><?php echo $leave['date']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <a href="leave.php" class="mb-3 btn btn-primary">Back</a>

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
