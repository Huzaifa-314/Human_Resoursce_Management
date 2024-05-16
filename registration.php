<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>

<?php
if (isset($_POST["submit"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $pass = md5($pass);
    $gender = isset($_POST['gender'])?$_POST['gender']:"Male";
    $dob = $_POST['dob'];

    $errors = array();
    
    if (empty($firstname) OR empty($gender) OR empty($dob) OR empty($lastname) OR empty($email) OR empty($pass) ) {
    array_push($errors,"All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, "Email is not valid");
    }
    if (strlen($pass)<=2) {
    array_push($errors,"Password must be at least 2 charactes long");
    }
    
    require_once "include/db_connection.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0) {
    array_push($errors,"Email already exists!");
    }
    if (count($errors)>0) {
    foreach ($errors as  $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
    }

else{
    $sql = "INSERT INTO users (dob,gender,first_name, last_name , email, password) VALUES (?,?, ?, ?, ?, ? )";
    $stmt = mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
    if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt,"ssssss",$dob,$gender,$firstname, $lastname, $email, $pass);
        mysqli_stmt_execute($stmt);
        header("Location: login.php?success=Registration was successfull");
        exit();
    }else{
        die("Something went wrong");
    }

}
}  
?>   


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login_registerbody">
    <div class="containerlogin ">

        
        
        <form action="registration.php" method="post">
        <div class="profile-img">
                    <img class="login-image" src="https://www.pngall.com/wp-content/uploads/5/Profile.png" alt="">
                </div>
            <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="First Name:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email Address :">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" onfocus="(this.type='date')"
      onblur="(this.type='text')" name="dob" placeholder="Date of Birth :">
            </div>
            <div class="form-group">
            <select class="form-control mb-3" name="gender">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
            </select>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="d-grid gap-2">
                <input type="submit" class="btn btn-dark" value="Register" name="submit" >
            </div>
        </form>
        <div>
        <div><p style="color:white;">Already Registered? <a href="login.php"style="color:black;">Login Here</a></p></div>
      </div>
        
    </div>
</body>
</html>