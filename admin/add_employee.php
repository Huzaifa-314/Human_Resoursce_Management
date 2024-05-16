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

    <title>Add Employee</title>
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
                Add Employee
            </div>

            <?php
            if (isset($_POST["submit"])) {
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $email = $_POST['email'];
                $NID = $_POST['NID'];
                $password = $_POST['password']; // Get the entered password
                $dob = $_POST['dob'];
                $gender = $_POST['gender'];
                // Check if password is empty
                if (empty($password)) {
                    echo "<div class='alert alert-danger' role='alert'>Password cannot be left blank.</div>";
                } else {
                    // Hash the password before insertion
                    $hashed_password = md5($password);
                    
                    // Insert user information
                    $sql = "INSERT INTO `users` (`dob`,`gender`,`first_name`, `last_name`, `email`, `NID`, `password`) 
                            VALUES ('$dob','$gender','$first_name', '$last_name', '$email', '$NID', '$hashed_password')";
                    $result = mysqli_query($conn, $sql);
                
                    if ($result) {
                        header("Location: employee.php?msg=User added successfully");
                    } else {
                        echo "Failed: " . mysqli_error($conn);
                    }
                }
            }
            ?>

            <div class="container mb-5">
                <div class="container">
                    <form action="" method="post" style="width:50vw; min-width:300px;">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Enter First Name</label>
                                <input type="text" class="form-control" name="first_name" style="margin-bottom: 20px;">
                            </div>
                            <div class="col1">
                                <label class="form-label">Enter Last Name</label>
                                <input type="text" class="form-control" name="last_name" style="margin-bottom: 20px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Enter User Email</label>
                                <input type="email" class="form-control" name="email" style="margin-bottom: 20px;">
                            </div>
                            <div class="col5">
                                <label class="form-label">Gender</label>
                                <select class="form-control mb-3" name="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col6">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" style="margin-bottom: 20px;" value="<?php echo $row['dob'] ?>">
                            </div>
                            <div class="col3">
                                <label class="form-label">Select Designation</label>
                                <select class="form-control mb-3" name="department_id">
                                    <?php
                                    $desig = mysqli_query($conn, "SELECT * FROM designation");
                                    while ($desig_row = mysqli_fetch_assoc($desig)) {
                                        ?>
                                        <option value="<?php echo $desig_row['id']; ?>">
                                            <?php echo $desig_row['name']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col1">
                                <label class="form-label">Enter Password</label>
                                <input type="password" class="form-control" name="password" style="margin-bottom: 20px;" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Enter User NID</label>
                                <input type="text" class="form-control" name="NID" style="margin-bottom: 20px;">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary" name="submit">Save</button>
                            <a href="employee.php" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- footer start -->
    <?php include ('footer.php'); ?> 
    <!-- footer end -->
</body>

</html>
