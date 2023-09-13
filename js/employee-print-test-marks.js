$(document).ready(function() {
    $("#emp_print_test_marks_btn").click(function() {
        // Hide the print button when it is clicked
        $(this).hide();
        $('#print_foot_emp_test').css({
            "display" : "block"
        })
        var printContents = $("#empl_test_marks_div").html();
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        // Restore the original content and show the print button
        document.body.innerHTML = originalContents;
        $("#emp_print_test_marks_btn").show();
        $('#print_foot_emp_test').css({
            "display" : "none"
        })
    });
});
