$(document).ready(function() {
    $('.get_trai_contents').click(function() {
        var content_id = $(this).val()
        $('#trai_description').load("php/employee-get-training-content.php",{
            "content": content_id
        });
    })
})