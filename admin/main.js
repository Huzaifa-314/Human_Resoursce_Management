// preloader code
document.addEventListener('DOMContentLoaded', function() {
    var preloader = document.getElementById('preloader');
    var preloaderTimeout = setTimeout(function() {
        preloader.style.display = 'none';
    }, 0);
});

// sweet alert
// Select the div with class "alert-success"
var alertDiv = document.querySelector('.alert-success');

// Check if the div exists
if(alertDiv) {
    // Get the text content of the div
    var message = alertDiv.textContent.trim();

    // Inject the SweetAlert script tag
    var sweetAlertScript = document.createElement('script');
    sweetAlertScript.src = "https://cdn.jsdelivr.net/npm/sweetalert2@11";
    sweetAlertScript.onload = function() {
        // SweetAlert is loaded, now inject the script to fire the alert
        var swalScript = document.createElement('script');
        swalScript.innerHTML = "Swal.fire('" + message + "');";
        document.body.appendChild(swalScript);
    };

    // Append the SweetAlert script tag to the document head
    document.head.appendChild(sweetAlertScript);
}

// remove get variable after once
// Check if the page was loaded by a reload action
if (performance.navigation.type === 1) {
    // Get the current URL
    var url = new URL(window.location.href);
    
    // Check if the 'msg' parameter exists in the URL
    if (url.searchParams.has('msg')) {
        // Remove the 'msg' parameter from the URL
        url.searchParams.delete('msg');
        
        // Construct the new URL without the 'msg' parameter
        var newUrl = url.toString();
        
        // Redirect the user to the new URL
        window.location.href = newUrl;
    }
}


