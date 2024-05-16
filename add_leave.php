<?php
include "include/db_connection.php";
session_start();

// Retrieve list of employees from the database
$sql = "SELECT *
FROM users";
$result = mysqli_query($conn, $sql);
$employees = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Initialize variables
$subject = $description = $attachment = $date = "";
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $subject = $_POST["subject"];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $user_id = $_SESSION['id'];
    
    // Check if attachment file is uploaded
    if ($_FILES["attachment"]["error"] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["attachment"]["tmp_name"];
        $attachment = "admin/uploads/documents/" . basename($_FILES["attachment"]["name"]);
        $attachment_name = $_FILES["attachment"]["name"];
        move_uploaded_file($tmp_name, $attachment);
    }

    // Insert leave application into database
    $sql = "INSERT INTO leaves (user_id, subject, description, attachment, status, date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql); // Assuming you have user session maintained
    $status = 'Pending'; // Default status for new leave applications
    mysqli_stmt_bind_param($stmt, "isssss", $user_id, $subject, $description, $attachment_name, $status, $date);
    
    if (mysqli_stmt_execute($stmt)) {
        $msg = "Leave application submitted successfully.";
        header("Location: leave.php?msg=$msg");
        exit();
    } else {
        $errors['sql_error'] = "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
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
    <title>Add Project</title>


    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/casqeu6w548ze6nb3mgxbsvxboniwtyjfd5blecu279ylzoh/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });
    </script>
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
                Issue Leave
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

                <form method="post" enctype="multipart/form-data">
                    <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error) : ?>
                                <p><?php echo $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject:</label>
                        <input type="text" id="subject" name="subject" class="form-control" value="<?php echo $subject; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea id="description" name="description" class="form-control"><?php echo $description; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="attachment" class="form-label">Attachment:</label>
                        <input type="file" id="attachment" name="attachment" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date:</label>
                        <input type="date" id="date" name="date" class="form-control" value="<?php echo $date; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
