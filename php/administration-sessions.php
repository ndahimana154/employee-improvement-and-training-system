<?php
    $acting_admin_id = $_SESSION['user_id'];
    $getuserinfos = mysqli_query($server,"SELECT * from users WHERE
        user_id = '$acting_admin_id' AND user_type = 'Administration'
    ");
?>