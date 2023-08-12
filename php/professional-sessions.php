<?php
    if (!isset($_SESSION['unique_id'])) {
        header("location: professional-sign-in.php");

    }
    else {
        $acting_professional_id = $_SESSION['profe_id'];
        $acting_training_unique_id = $_SESSION['unique_id'];
        // Get employees information
        $get_emp_info = mysqli_fetch_array(mysqli_query($server,"SELECT * from professionals
            WHERE professional_id = '$acting_professional_id'
        "));
        $acting_professional_email = $get_emp_info['professional_email'];
        // Get the professional training
        $get_trrrr = mysqli_fetch_array(mysqli_query($server,"SELECT * from 
            training_professionals
            WHERE professional = '$acting_professional_id'
            AND unique_id = '$acting_training_unique_id'
        "));
        $training = $get_trrrr['training'];
        // Get the department id
        $get_training_department = mysqli_fetch_array(mysqli_query($server,"SELECT * from
            trainings WHERE training_id = '$training'
        "));
        $training_depart = $get_training_department['training_depart'];
    }
?>