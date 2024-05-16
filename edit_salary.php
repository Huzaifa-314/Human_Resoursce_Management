<?php
include "include/db_connection.php";

// Check if salary ID is set and is a valid integer
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $salaryId = $_GET['id'];

    // Retrieve salary data from the database
    $sql = "SELECT s.*, u.first_name, u.last_name FROM salary s JOIN users u ON u.id=s.user_id WHERE s.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $salaryId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $salary = mysqli_fetch_assoc($result);

    if (!$salary) {
        header("Location: salary.php?msg=Salary not found");
        exit();
    }
} else {
    // Redirect to salary.php with error message if salary ID is not valid
    header("Location: salary.php?msg=Invalid salary ID");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $amount = $_POST['amount'];

    // Update salary data in the database
    $sql = "UPDATE salary SET amount = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "di", $amount, $salaryId);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        header("Location: salary.php?msg=Salary updated successfully");
        exit();
    } else {
        header("Location: edit_salary.php?id=$salaryId&msg=Failed to update salary");
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

  <title>Salary</title>
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
        Edit Salary
      </div>

      <div class="container mb-3">
            <?php
            if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ' . $msg . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            }
            ?>

            <form method="post" action="">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <div><h2>
                        <?php echo $salary['first_name']." ".$salary['last_name']; ?>
                    </h2></div>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Salary</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $salary['amount']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Salary</button>
            </form>
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
