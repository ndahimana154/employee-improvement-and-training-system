<?php   
    session_start();
    include("php/connection.php");
    include("php/professional-sessions.php");
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
<body>
    <!-- Header -->
    <?php
        include("php/professional-header.php");
    ?>
    <div class="container">
        <div class="alert alert-success mt-3">
            <?php
                if (isset($_GET['welcome'])) {
                    ?>
                    <h3 class="">
                        You're welcome
                    </h3>
                    <?php
                }
            ?>
            <div class="row">
                <h4>
                    Email : <b><?php echo $acting_professional_email;  ?></b>
                </h4>
                <p>&nbsp;&nbsp; || &nbsp;&nbsp;</p>
                <h4>
                    Training: <b><?php echo $acting_training_topic; ?></b>
                </h4>
            </div>
            
        </div>
    </div>
    <div class="dash-board p-3">
        <h3>
            Dashboard
        </h3>
        <div class="row m-2">
            <div class="col-md-3 m-2">
                <div class="dashboard-box bg-primary text-light p-2 row rounded">
                    <div class="mr-3">
                            <i class="fas fa-user-circle fa-3x mb-3 flex-1"></i>
                        <h6>TOTAL EMPLOYEES</h6>
                    </div>
                    
                    <p class="mb-0 fa-3x">
                        <?php
                            $get_all_employees = mysqli_query($server,"SELECT * from users
                                WHERE department = '$training_depart'
                                AND user_state !='Not Working'
                            ");
                            echo mysqli_num_rows($get_all_employees);
                        ?>
                    </p>
                </div>
            </div>
            <div class="col-md-3 m-2">
                <div class="dashboard-box bg-primary text-light p-2 row rounded">
                    <div class="mr-3">
                        <i class="fas fa-list-ol fa-3x mb-3 flex-1"></i>
                        <h6>CONTENTS NUMBER</h6>
                    </div>
                    
                    <p class="mb-0 fa-3x">
                        <?php
                            echo mysqli_num_rows($actingtraining_contents);
                        ?>
                    </p>
                </div>
            </div>
            <div class="col-md-3 m-2">
                <div class="dashboard-box bg-primary text-light p-2 row rounded">
                    <div class="mr-3">
                            <i class="fas fa-percent fa-3x mb-3 flex-1"></i>
                        <h6>COMPLETION PERCENTAGE</h6>
                    </div>
                    
                    <p class="mb-0 fa-3x">
                        <?php
                            // Get all training contents
                            $get_training_contents_num = mysqli_query($server,"SELECT * from
                                training_contents WHERE
                                training = '$training'
                            ");
                            $contents_num = mysqli_num_rows($get_training_contents_num);
                            $employees_num = mysqli_num_rows($get_all_employees);
                            $expected_completion_num = $contents_num * $employees_num;
                            // Get the completion number
                            $get_completion_num = mysqli_query($server,"SELECT * from empl_trainings_conent_completion
                                WHERE training = '$training'
                            ");
                            $completed_num = mysqli_num_rows($get_completion_num);
                            $completion_percentage = $completed_num/$expected_completion_num*100;
                            echo round($completion_percentage,2)."%";
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    

    
    <!-- Footer -->
    <?php
        // include("php/footer.php");
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
        /* .chat-container {
            display: flex;
            height: 100vh;
        } */
        .chat-list {
            flex: 1;
            background-color: #f8f9fa;
            overflow-y: auto;
        }
        .chat-conversation {
            flex: 3;
            background-color: #ffffff;
            border-left: 1px solid #e9ecef;
            overflow-y: auto;
        }
        .message {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }
    </style>
</body>
</html>
