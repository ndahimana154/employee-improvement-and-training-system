<?php
    if (!isset($_SESSION['unique_id'])) {
        header("location: professional-sign-in.php");

    }
    else {
        $acting_professional_id = $_SESSION['profe_id'];
        // Update professionals status
        $update = mysqli_query($server,"UPDATE professionals
            SET professional_status = 'Online'
            WHERE professional_id = '$acting_professional_id'
        ");
        $acting_training_unique_id = $_SESSION['unique_id'];
        // Get employees information
        $get_emp_info = mysqli_fetch_array(mysqli_query($server,"SELECT * from professionals
            WHERE professional_id = '$acting_professional_id'
        "));
        $acting_professional_ln = $get_emp_info['professional_ln'];
        $acting_professional_fn = $get_emp_info['professional_fn'];
        $acting_professional_phone = $get_emp_info['professional_phone'];
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

        // Get the professional unique id
        $get_profff = mysqli_fetch_array(mysqli_query($server,"SELECT * from  training_professionals
            WHERE professional = '$acting_professional_id'
            AND unique_id = '$acting_training_unique_id'
        "));
        $acting_professional_training = $get_profff['training'];
        // Get the training infos
        $get_training = mysqli_query($server,"SELECT * from trainings
            WHERE training_id = '$training'
        ");
        $data_training = mysqli_fetch_array($get_training);
        $acting_training_topic = $data_training['training_topic'];

        $actingtraining_contents = mysqli_query($server,"SELECT * from empl_trainings_conent_completion
            WHERE training = '$training'
        ");

        $acting_employees_num = mysqli_query($server,"SELECT * from users 
            WHERE department = '$training_depart'
            AND user_state !='Not Working'
            ");
    }       
?>