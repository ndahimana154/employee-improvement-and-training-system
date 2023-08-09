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
    <!-- Link Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Js Files -->
    <script src="js/employee-get-trainings-content.js"></script>
</head>
<body>
    <!-- Header -->
    <?php
        include("php/employee-header.php");
    ?>
    <div class="container">
        <div class="row align-items-center">
            <!-- <div class="col-md-4">
                <img src="company_logo.png" alt="Company Logo" class="img-fluid">
            </div> -->
            <div class="col-md-8">
                <?php
                    if (isset($_GET['welcome'])) {
                        ?>
                        <h2>
                            Welcome <?php echo $acting_employee_usern; ?>
                        </h2>
                        <?php
                    }
                    else {
                        ?>
                        <h2>
                            <?php echo $acting_employee_usern; ?>
                        </h2>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    

    <!-- Display trainings -->
    <section class="">
        <div class="" style="width: 80%;margin:auto;">
            <?php
                if (!isset($_GET['training'])) {
                    ?>
                    <p class="alert alert-danger">
                        No training sent to the server.
                    </p>
                    <?php
                }
                else {
                    $training = $_GET['training'];
                    // Check if the training exists
                    $check_exists = mysqli_query($server,"SELECT * from trainings WHERE
                        training_id='$training'
                    ");
                    if (mysqli_num_rows($check_exists) != 1) {
                        ?>
                        <p class="alert alert-danger">
                            The training is not found.
                        </p>
                        <?php
                    }
                    else {
                        $data_check_exits = mysqli_fetch_array($check_exists);
                        ?>
                        <div class="contents m-3">
                            <a href="employee-trainings.php" class="text-dark font-weight-bold">Trainings</a> / <a href="" class="text-dark font-weight-bold"><?php echo $data_check_exits['training_topic']; ?></a>
                        </div>
                        <div class="row bg-light" style="height: 700px;">
                            <!-- Training Contents Column -->
                            <div class="col-md-3 text-light p-4" id="contents_list">
                                <h4 class="text-dark m-3">
                                    Contents
                                </h4>
                                <?php
                                    // Get the training contents
                                    $get_trainings_content = mysqli_query($server,"SELECT * from training_contents
                                        WHERE training='$training'
                                    ");
                                    if (mysqli_num_rows($get_trainings_content) < 1) {
                                        ?>
                                        <p class="alert alert-danger">
                                            No contents for this training
                                        </p>
                                        <?php
                                    }
                                    while ($data_contents = mysqli_fetch_array($get_trainings_content)) {
                                        ?>
                                        <div class="row m-2" >
                                            <button class="btn btn-outline-primary get_trai_contents" value="<?php echo $data_contents['training_content_id']; ?>">
                                                <?php 
                                                    $current_content = $data_contents['training_content_id'];
                                                    echo $data_contents['content_name']; 
                                                    $check_content_info = mysqli_query($server,"SELECT * from empl_trainings_conent_completion
                                                        WHERE employee='$acting_employee_id'
                                                        AND training = '$training'
                                                        AND content = '$current_content'
                                                        AND status = 'Completed'
                                                        ");
                                                        if (mysqli_num_rows($check_content_info) > 0) {
                                                            ?>
                                                                <i class="fa fa-check-circle"></i>
                                                            <?php
                                                        }
                                                ?>
                                            </button>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>

                            <!-- Training Description Column -->
                            <div class="col-md-5 bg-light p-4">
                                <div id="trai_description">
                                    <div class="" style="font-size: 20px;">
                                        <h4 class="text-decoration-underline">
                                            About:
                                        </h4>
                                        <p class="" style="margin-left: 10px;">
                                            <?php echo $data_check_exits['training_description']; ?>
                                        </p>
                                        <div class="achievements">
                                            <h5 class="font-weight-bold">
                                                Achievements
                                            </h5>
                                            <?php
                                                $get_total_contents = mysqli_query($server,"SELECT * from training_contents 
                                                    WHERE
                                                    training = '$training'    
                                                ");
                                                $get_passed_contents = mysqli_query($server,"SELECT * from 
                                                    empl_trainings_conent_completion WHERE
                                                    employee = '$acting_employee_id' 
                                                    AND training = '$training'
                                                    AND status = 'Completed'
                                                ");
                                                $num_contents = mysqli_num_rows($get_total_contents);
                                                $num_completed = mysqli_num_rows($get_passed_contents);
                                                // Calculate percentage
                                                $completetion_percenage = ($num_completed/$num_contents) * 100;
                                                // echo $completetion_percenage;
                                            ?>
                                            <h4 style="text-transform: uppercase;">
                                                Content completion
                                            </h4>
                                            <div class="progress" title="You have completed <?php echo $completetion_percenage."%"; ?> of the training contents.">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo $completetion_percenage; ?>%;" aria-valuenow="<?php echo $completionPercentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                                    <?php echo $completetion_percenage; ?>%
                                                </div>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>
                            </div>

                            <!-- Chat with Professionals Column -->
                            <div class="col-md-4 p-4">
                            <div class="container mt-5">
                                <div class="card" style="height: 600px;">
                                    <div class="card-header bg-primary text-white">
                                        <h4 class="mb-0">Professional Chat</h4>
                                        <p class="mb-0">Chatting with: John Doe</p>
                                    </div>
                                    <div class="card-body chat-messages">
                                        <div class="message sender">
                                            <p>Hello, how can I help you?</p>
                                            <div class="time">
                                                10:30 AM
                                                <i class="fas fa-check delivered"></i>
                                            </div>
                                        </div>
                                        <div class="message receiver">
                                            <p>Hi, I have a question about the training content.</p>
                                            <div class="time">
                                                10:35 AM
                                            </div>
                                        </div>
                                        <!-- Add more messages here -->
                                    </div>
                                    <div class="card-footer bg-light">
                                        <form class="d-flex">
                                            <input type="text" class="form-control" placeholder="Type your message...">
                                            <button type="submit" class="btn btn-primary ml-2"><i class="fas fa-paper-plane"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>

                        <style>
                            .bg-primary {
                                background-color: #007bff;
                            }
                            .bg-orange {
                                background-color: #ff9800;
                            }
                            .btn-light {
                                background-color: #fff;
                                color: #007bff;
                                border-color: #007bff;
                            }
                        </style>

                        <?php
                    }
                }
            ?>
        </div>
</section>
    
    <!-- Footer -->
    <?php
        // include("php/footer.php");
    ?>
    
    <!-- Link Bootstrap JS -->
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