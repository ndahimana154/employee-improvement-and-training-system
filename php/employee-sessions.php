<?php
    $acting_employee_id = $_SESSION['employee_id'];
    // Get the employee usernames
    $get_infos = mysqli_fetch_array(mysqli_query($server,"SELECT * from users
        WHERE user_id = '$acting_employee_id'
    "));
    $acting_employee_email = $get_infos['user_email'];
    $acting_employee_usern = $_SESSION['employee_username'];
    $acting_employee_fn = $get_infos['user_fn'];
    $acting_employee_ln = $get_infos['user_ln'];
    $acting_employee_phone = $get_infos['user_phone'];
    $acting_employee_type = $_SESSION['employee_type'];
    if (!isset($_SESSION['employee_id'])) {
        header("location: user-login.php");
    }
    elseif ($acting_employee_type != 'Employee') {
        header("location: user-login.php");
    }
    // Get the employee department
    $get_employee_depart_id = mysqli_fetch_array(mysqli_query($server,"SELECT * from users WHERE user_id='$acting_employee_id'"));
    $employee_acting_depart_id = $get_employee_depart_id['department'];
    $get_depart_name = mysqli_fetch_array(mysqli_query($server,"SELECT * from departments WHERE depart_id = '$employee_acting_depart_id'"));
    $acting_employee_depart_name = $get_depart_name['depart_name'];
    $current_timestamp =  date('Y-m-d H:i');
?>