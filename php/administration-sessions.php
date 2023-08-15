<?php
    $acting_admin_id = $_SESSION['user_id'];
    $getuserinfos = mysqli_query($server,"SELECT * from users WHERE
        user_id = '$acting_admin_id' AND user_type = 'Administration'
    ");
    $data_user_infos = mysqli_fetch_array($getuserinfos);
    $acting_fn = $data_user_infos['user_fn'];
    $acting_ln = $data_user_infos['user_ln'];
    $acting_username = $data_user_infos['user_name'];
    $acting_email = $data_user_infos['user_email'];
    $acting_userphone = $data_user_infos['user_phone'];
?>