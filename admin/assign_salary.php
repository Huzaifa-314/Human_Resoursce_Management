<?php
include "include/db_connection.php";

// Retrieve list of employees from the database
$sql = "SELECT u.*
FROM users u
LEFT JOIN salary s ON u.id = s.user_id
WHERE s.user_id IS NULL;
";
$result = mysqli_query($conn, $sql);
$employees = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $employeeId = $_POST['employee'];
    $amount = $_POST['amount'];

    // Insert the salary data into the database
    $sql = "INSERT INTO salary (user_id, amount) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "id", $employeeId, $amount);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: salary.php?msg=Salary assigned successfully");
        exit();
    } else {
        header("Location: assign_salary.php?msg=Failed to assign salary");
        exit();
    }
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

  <title>Document</title>
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
                Assign Salary
            </div>

            <div class="container mb-3">
                <?php
                if (isset($_GET["msg"])) {
                    $msg = $_GET["msg"];
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            ' . $msg . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                }
                ?>

                <form method="post" action="">
                    <div class="mb-3">
                        <label for="employee" class="form-label">Select Employee</label>
                        <select class="form-select" id="employee" name="employee" required>
                            <option value="" selected disabled>Select an employee</option>
                            <?php foreach ($employees as $employee) : ?>
                                <option value="<?php echo $employee['id']; ?>"><?php echo $employee['first_name'] . ' ' . $employee['last_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Assign Salary</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
