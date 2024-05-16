
<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

$successMessage = "";
if (isset($_GET['success'])) {
    $successMessage = "<div class='alert alert-success'>".$_GET["success"]."</div>";
}
?>

<?php
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $pass = $_POST["password"];
    require_once "include/db_connection.php";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($user) {
        $pass = md5($pass);
        if ( $pass == $user["password"]) {
            session_start();
            $_SESSION["user"] = "yes";
            $_SESSION["id"] = $user["id"];
            header("Location: index.php");
            die();
        } else {
            echo "<div class='alert alert-danger'>Password does not match</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Email does not match</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login_registerbody">
    <div class="containerlogin">
      <form action="login.php" method="post">

                <div class="profile-img">
                    <img class="login-image" src="https://www.pngall.com/wp-content/uploads/5/Profile.png" alt="">
                </div>
        <div><center><h3 class="mb-4">User Login</h3></center></div>

          <?php echo $successMessage; ?>
        <div class="form-group">
            <input type="email" placeholder="Enter Your Email:" name="email" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="Enter Your Password:" name="password" class="form-control">
        </div>
        <div class="d-grid gap-2">
            <input type="submit" class="btn btn-dark" value="Login" name="login" >
        </div>
      </form> 

       <div>
        <p style="color:white;">Not registered yet? <a href="registration.php" style="color:black;">Register here</a></p>
    </div>
    </div>
</body>
</html>