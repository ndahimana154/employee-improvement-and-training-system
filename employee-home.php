<?php   
    session_start();
    include("php/connection.php");
    include("php/employee-sessions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Training System</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link Font-awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="">
    <!-- Header -->
    <?php
        include("php/employee-header.php");
    ?>
    <!-- Display trainings -->
    <section class="bg-light">
    <div class="container">
        <h2>
            ACHIEVEMENTS AND PROGRESS
        </h2>
        <div class="row">
            <?php
                $get_all_trainings = mysqli_query($server,"SELECT * from
                    trainings WHERE
                    training_depart = '$employee_acting_depart_id'
                    -- AND
                    ORDER BY training_start DESC,
                    training_end DESC,
                    training_topic ASC
                ");
                if (mysqli_num_rows($get_all_trainings) < 1) {
                    ?>
                    <p class="alert alert-danger">
                        No trainings available!
                    </p>
                    <?php
                }
                while($data_get_all_trainings = mysqli_fetch_array($get_all_trainings)) {
                    ?>
                    <div class="col-md-6">
                        <div class="mb-3 border bg-white" style="display: flex;">
                            <img src="trainings/covers/<?php echo $data_get_all_trainings['training_cover']; ?>" style="width: 200px;">
                            <div class="p-3" style="flex: 1;">
                                <h5 class="card-title">
                                    <?php echo $data_get_all_trainings['training_topic']; ?>
                                </h5>
                                <p>
                                    <?php
                                        $training_id = $data_get_all_trainings['training_id'];
                                        $get_professional = mysqli_query($server,"SELECT * from training_professionals
                                            WHERE training = '$training_id'
                                        ");
                                        if (mysqli_num_rows($get_professional) < 1) {
                                            echo"No professional";
                                        }
                                        else {
                                            $data_get_professional_id = mysqli_fetch_array($get_professional);
                                            $professional_id = $data_get_professional_id['professional'];
                                            $data_get_profe_info = mysqli_fetch_array(mysqli_query($server,"SELECT * from professionals
                                                WHERE professional_id = '$professional_id'
                                            "));
                                            echo $data_get_profe_info['professional_email'];
                                        }
                                    ?>
                                </p>
                                <p class="font-weight-bold">
                                    <i class="fa fa-clock"></i>
                                    <?php
                                        echo $data_get_all_trainings['training_start']." - ".$data_get_all_trainings['training_end'];
                                    ?>
                                </p>
                                <p class="font-weight-bold text-primary">
                                    <?php echo $data_get_all_trainings['training_status']; ?>
                                </p>
                                <?php
                                    $get_total_contents = mysqli_query($server,"SELECT * from training_contents 
                                        WHERE
                                        training = '$training_id'    
                                    ");
                                    $get_passed_contents = mysqli_query($server,"SELECT * from 
                                        empl_trainings_conent_completion WHERE
                                        employee = '$acting_employee_id' 
                                        AND training = '$training_id'
                                        AND status = 'Completed'
                                    ");
                                    if (mysqli_num_rows($get_total_contents) < 1) {
                                        ?>
                                        <p class="alert alert-danger">
                                            No contents to complete
                                        </p>
                                        <?php
                                    }
                                    else {
                                        $num_contents = mysqli_num_rows($get_total_contents);
                                        // $num_contents = 1
                                        $num_completed = mysqli_num_rows($get_passed_contents);
                                        // Calculate percentage
                                        $completetion_percenage = ($num_completed/$num_contents) * 100;
                                        ?>
                                        <div class="progress" title="You have completed <?php echo $completetion_percenage."%"; ?> of the training contents.">
                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $completetion_percenage; ?>%;" aria-valuenow="<?php echo $completionPercentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                                <?php echo $completetion_percenage; ?>%
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</section>
    
    <!-- Footer -->
    <?php
        include("php/footer.php");
    ?>
    
    <!-- Link Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Custom CSS for hero section */
        #hero {
            position: relative;
            overflow: hidden;
        }
    </style>
</body>
</html>
