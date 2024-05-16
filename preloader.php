<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Preloader</title>
<style>
/* Preloader styles */
#preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #007b8b;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 1;
    transition: opacity 0.5s ease-out;
}

/* Preloader animation */
#preloader::before,
#preloader::after {
    content: '';
    position: absolute;
    border: 8px solid transparent;
    border-top-color: #f3f3f3; /* Light grey */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
}

#preloader::before {
    animation-delay: -0.2s; /* Delay the animation for smoother effect */
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
</head>
<body>

<!-- Preloader -->
<?php
      if(!isset($_GET['msg'])){
         ?>
            <div id="preloader"></div>
         <?php
      }
   ?>

<!-- Your content goes here -->
<div style="height: 2000px;">
    <!-- Just to make the page scrollable -->
</div>

<!-- Your JavaScript or other HTML content goes here -->

<script>
// Hide preloader after 2 seconds or when the page is fully loaded, whichever is later
document.addEventListener('DOMContentLoaded', function() {
    var preloader = document.getElementById('preloader');
    var preloaderTimeout = setTimeout(function() {
        preloader.style.opacity = '0';
    }, 2000);
});
</script>

</body>
</html>
