<?php
    session_start();
    include("connection.php");
    include("employee-sessions.php");
    if (isset($_POST['contents'])) {
        $content = $_POST['contents'];
        $get_content_info = mysqli_fetch_array(mysqli_query($server,"SELECT * from training_contents
            WHERE training_content_id = '$content'
        "));
        $training = $get_content_info['training'];
        $check_content_info = mysqli_query($server,"SELECT * from empl_trainings_conent_completion
        WHERE employee='$acting_employee_id'
        AND training = '$training'
        AND content = '$content'
        AND status = 'Completed'
        ");
        if (mysqli_num_rows($check_content_info) > 0) {
            ?>
            <p class="alert alert-danger">
                You have already completed that course.
            </p>
            <?php
        }
        else {
            $mark =mysqli_query($server,"INSERT into empl_trainings_conent_completion 
            values(null,$acting_employee_id,$training,$content,'Completed',now())
            ");
            if (!$mark) {
                ?>
                <p class="alert alert-danger">
                    The content is not marked.
                </p>
                <?php
            }
            else {
                ?>
                <p class="alert alert-success">
                    The conent is marked as complete.
                </p>
                <?php
                heade
            }
        }
    }
?>
