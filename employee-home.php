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
    <section class="bg-light" style="height: 100vh">
        <div class="container">
            <div class="currents alert alert-success m-3">
                <h4>
                    Username: <?php echo $acting_employee_usern;  ?>
                </h4>
                <h4>
                    Department : <?php echo $acting_employee_depart_name;  ?>
                </h4>
            </div>
            <div class="dash-board">
                <h3>
                    Dashboard
                </h3>
                <div class="row m-2">
                    <div class="col-md-4 m-2">
                        <div class="dashboard-box bg-primary text-light p-2 row rounded">
                            <div class="mr-3">
                                    <i class="fas fa-check-circle fa-3x mb-3 flex-1"></i>
                                <h6>COMPLETED TRAININGS</h6>
                            </div>
                            
                            <p class="mb-0 fa-3x">
                                <?php 
                                    $get_all_contents = mysqli_fetch_array(mysqli_query($server,"SELECT users.user_id, COUNT(DISTINCT empl_trainings_conent_completion.training) AS completed_trainings
                                        FROM users
                                        LEFT JOIN empl_trainings_conent_completion ON users.user_id = empl_trainings_conent_completion.employee
                                        GROUP BY users.user_id
                                        HAVING users.user_id = $acting_employee_id;
                                    "));
                                    echo $get_all_contents['completed_trainings']; 
                                    // $get_total_employees = mysqli_query($server,"SELECT * from users WHERE user_id != '$acting_admin_id'");
                                    // echo mysqli_num_rows($get_total_employees);
                                    // $get_total_completed = mysqli_query($server,"SELECT * from")
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 m-2">
                        <div class="dashboard-box bg-primary text-light p-2 row rounded" style="display: flex;flex-direction: row;">
                            <div class="mr-3">
                                    <!-- <i class="fas fa-check-circle fa-3x mb-3 flex-1"></i> -->
                                    <i class="far fa-clock fa-3x mb-3 flex-1"></i>
                                <h6>PENDING TRAININGS</h6>
                            </div>
                            
                            <p class="mb-0 fa-3x">
                                <?php 
                                    $get_all_pending = mysqli_query($server,"SELECT * from trainings 
                                        WHERE training_status = 'Waiting'
                                        AND training_depart = '$employee_acting_depart_id'
                                    ");
                                    echo mysqli_num_rows($get_all_pending);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
    
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
    </style>
</body>
</html>
