$(document).ready(function() {
    $("#printButton").click(function() {
        // Hide the button before printing
        $('.head').hide();
        $(this).hide();
        // Print the certificate
        window.print();
        // Show the button after printing (optional)
        $(this).show();
        $('.head').show();
    });
});