<?php
include "include/db_connection.php";

?>
<?php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Retrieve form data
    $projectName = $_POST['projectName'];
    $progress = $_POST['progress'];
    $department = $_POST['department'];
    $description = $_POST['description'];
    $dueDate = $_POST['dueDate'];

    // Prepare and execute the SQL statement to insert data into the database
    $sql = "INSERT INTO Project (ProjectName, Status, DepartmentID, Description, DueDate) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssiss", $projectName, $progress, $department, $description, $dueDate);
    $result = mysqli_stmt_execute($stmt);

    if($result){
        header("Location: project.php?msg=Project added successfully");
        exit();
    }else{
        header("Location: add_project.php?msg=Failed to add project");
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
                Add Project
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
                        <label for="projectName" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="projectName" name="projectName" required>
                    </div>
                    <div class="mb-3">
                        <label for="progress" class="form-label">Status</label>
                        <select class="form-select" id="progress" name="progress" required>
                            <option value="" selected disabled>Select Status</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                            <option value="Not started">Not started</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" id="department" name="department" required>
                            <option value="" selected disabled>Select Department</option>
                            <?php
                            // Fetch departments from the database
                            $departments_query = "SELECT * FROM Department";
                            $departments_result = mysqli_query($conn, $departments_query);
                            if (mysqli_num_rows($departments_result) > 0) {
                                while ($row = mysqli_fetch_assoc($departments_result)) {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name'];?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="dueDate" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="dueDate" name="dueDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Project</button>
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
