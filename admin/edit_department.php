<?php
include "include/db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="style.css"/>

  <title>Department Table Application</title>
</head>

<body>
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
            
            <div class="main_contect_body">
                    <div class= "department_tiltle" >
                        Department Information List
                    </div>

                    <?php
                        include "include/db_connection.php";
                        $id = $_GET["id"]; 

                        if (isset($_POST["submit"])) {
                        $name = $_POST['name'];
                        
                        $sql = "UPDATE `department` SET `name`='$name' WHERE id = $id";

                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            header("Location: departments.php?msg=Data updated successfully");
                        } else {
                            echo "Failed: " . mysqli_error($conn);
                        }
                        }

                         ?>


                        <div class="container">
                            <div class="text-center mb-4">
                            <h3>Edit Department Name</h3>
                            <p class="text-muted">Click update after changing any information</p>
                            </div>

                            <?php
                            $sql = "SELECT * FROM `department` WHERE id = $id LIMIT 1";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            ?>

                            <div class="container d-flex justify-content-center">
                            <form action="" method="post" style="width:50vw; min-width:300px;">
                                <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Enter Department Name</label>
                                    <input type="text" class="form-control" name="name" style="margin-bottom: 20px;" value="<?php echo $row['name'] ?>">
                                </div>
                                <div>
                                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                <a href="index.php" class="btn btn-danger">Cancel</a>
                                </div>
                            </form>
                            </div>
                        </div>




            </div>
       </section>
</body>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
crossorigin="anonymous"></script>
<!-- footer start -->
<?php include ('footer.php'); ?> 
<!-- footer end -->