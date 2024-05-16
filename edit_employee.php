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

  <title>Edit Employee Information</title>
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
        Edit Employee Information
    </div>

    <?php
    include "include/db_connection.php";
    if(isset($_GET["id"])) {
        $id = mysqli_real_escape_string($conn, $_GET["id"]);

        if (isset($_POST["submit"])) {
            $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $name = $_POST['name'];
            $email = $_POST['email'];
            $NID = $_POST['NID'];
            $desig_id = $_POST['department_id']; // Get the selected designation ID
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];

            // File upload handling
            if(isset($_FILES['image'])){
                $image = $_FILES['image'];
                $image_name = $image['name'];
                $image_tmp = $image['tmp_name'];
                $image_size = $image['size'];
                $image_error = $image['error'];

                // Check if file is uploaded successfully
                if($image_error === 0){
                    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                    $allowed = array('jpg', 'jpeg', 'png');

                    // Check if file type is allowed
                    if(in_array($image_ext, $allowed)){
                        // Check if file size is within limit (2MB)
                        if($image_size <= 2000000){
                            $new_image_name = uniqid('', true). ".". $image_ext;
                            $destination = "images/user/". $new_image_name; // Adjust destination path as per your file structure

                            // Move uploaded file to destination
                            if(move_uploaded_file($image_tmp, $destination)){
                                // Insert product details into database
                                $insert_query = "UPDATE `users` SET `first_name`='$name', `email`='$email', `NID`='$NID', `desig_id`='$desig_id', `image`='$new_image_name',`dob`='$dob',`gender`='$gender' WHERE id = $id";
                                $insert_query_result = mysqli_query($conn, $insert_query);

                                // Check if insertion was successful
                                if($insert_query_result){
                                    // Redirect with success message
                                    header("Location: employee.php?success=Employee successfully updated");
                                    exit();
                                }else{
                                    // Redirect with error message
                                    header("Location: {$current_url}&error=" . mysqli_error($conn));
                                    exit();
                                }
                            }else{
                                // Redirect with error message
                                header("Location: {$current_url}&error=Error uploading image");
                                exit();
                            }
                        }else{
                            // Redirect with error message
                            header("Location: {$current_url}&error=Image size is too big");
                            exit();
                        }
                    }else{
                        // Redirect with error message
                        header("Location: {$current_url}&error=Image type not allowed");
                        exit();
                    }
                } else{
                    // Redirect with error message
                    $insert_query = "UPDATE `users` SET `first_name`='$name', `email`='$email', `NID`='$NID', `desig_id`='$desig_id', `dob`='$dob',`gender`='$gender' WHERE id = $id";
                    $insert_query_result = mysqli_query($conn, $insert_query);
                    // Check if insertion was successful
                    if($insert_query_result){
                        // Redirect with success message
                        header("Location: employee.php?success=Employee successfully updated");
                        exit();
                    }else{
                        // Redirect with error message
                        header("Location: {$current_url}&error=" . mysqli_error($conn));
                        exit();
                    }
                }
            }else{
                // Redirect with error message
                header("Location: {$current_url}&error=No image uploaded");
                exit();
            }
        }

        $sql = "SELECT * FROM `users` WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    }
    ?>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" class="mb-3" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php }
                if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_GET['success']; ?>
                    </div>
                <?php } ?>
                    <div class="col">
                        <label class="form-label">Enter User Name</label>
                        <input type="text" class="form-control" name="name" style="margin-bottom: 20px;" value="<?php echo $row['first_name'] ?>">
                    </div>
                    <div class="col1">
                        <label class="form-label">Enter User Email</label>
                        <input type="text" class="form-control" name="email" style="margin-bottom: 20px;" value="<?php echo $row['email'] ?>">
                    </div>
                    <div class="col5">
                        <label class="form-label">Gender</label>
                        <select class="form-control mb-3" name="gender">
                                <option value="Male" <?php if($row['gender']=="Male") echo 'selected';?>>Male</option>
                                <option value="Female" <?php if($row['gender']=="Female") echo 'selected';?>>Female</option>
                                <option value="Other" <?php if($row['gender']=="Other") echo 'selected';?>>Other</option>
                        </select>
                    </div>
                    <div class="col6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" style="margin-bottom: 20px;" value="<?php echo $row['dob'] ?>">
                    </div>
                    <div class="col2">
                        <label class="form-label">Enter User NID</label>
                        <input type="text" class="form-control" name="NID" style="margin-bottom: 20px;" value="<?php echo $row['NID'] ?>">
                    </div>
                    <div class="col3">
                        <label class="form-label">Select Designation</label>
                        <select class="form-control mb-3" name="department_id">
                            <?php
                            $desig = mysqli_query($conn, "SELECT * FROM designation");
                            while ($desig_row = mysqli_fetch_assoc($desig)) {
                                ?>
                                <option value="<?php echo $desig_row['id']; ?>" <?php if ($row['desig_id'] == $desig_row['id']) echo "selected"; ?>>
                                    <?php echo $desig_row['name']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col4">
                        <label class="form-label">Upload User Image</label>
                        <input type="file" class="form-control" name="image" style="margin-bottom: 20px;">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                    <a href="employee.php" class="btn btn-danger">Cancel</a>
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
