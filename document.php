<?php
include "include/db_connection.php";
session_start();
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
        Documents
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

        <a class="add_department" href="add_document.php" class="btn btn-primary mb-3"><i class="fa-solid fa-plus"></i>Add New Document</a>

        <table class="table table-hover text-center">
          <thead class="table-primary">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Title</th>
              <th scope="col">File</th>
              <th scope="col">Description</th>
              <th scope="col">Project</th>
              <th scope="col">Action</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $no = 1;
            $user_id = $_SESSION['id'];
            $sql = "SELECT doc.*, p.*
            FROM documents doc 
            INNER JOIN project p ON doc.project_id = p.ID
            INNER JOIN department dept ON p.DepartmentID = dept.id
            INNER JOIN designation des ON des.department_id = dept.id
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
                  <?php echo $row["title"] ?>
                </td>
                <td>
                  <?php echo $row["file"] ?>
                </td>
                <td>
                  <?php echo $row["description"] ?>
                </td>
                <td>
                  <?php echo $row["ProjectName"] ?>
                </td>
                <td>
                  <a href="admin/uploads/documents/<?php echo $row["file"] ?>" target="_blank" class="link-primary"><i class="fas fa-download"></i></a>
                  <a href="edit_document.php?id=<?php echo $row["id"] ?>" class="link-primary"><i class="fa-solid fa-pen-to-square fs-5"></i></a>

                </td>
              </tr>
            <?php
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Bootstrap -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
      <!-- footer start -->
      <?php include('footer.php'); ?>
      <!-- footer end -->
</body>

</html>