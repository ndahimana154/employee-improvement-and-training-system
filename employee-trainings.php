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
    <section class="py-5">
    <div class="container">
        <div class="row">
            <?php
                $today = date("Y-m-d");
                // echo $today;
                $get_trainings = mysqli_query($server,"SELECT * from trainings WHERE
                    training_depart='$employee_acting_depart_id'
                    AND training_start <= '$today'
                    AND training_end > '$HTTP_RAW_POST_DATA
                    
                    
                    
                    
                    
                    '

                    -- AND training_status
                    ORDER BY training_start DESC,
                    training_end DESC
                ");
                while ($data_trainings = mysqli_fetch_array($get_trainings)) {
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="trainings/covers/<?php echo $data_trainings['training_cover']; ?>" class="card-img-top" alt="Image 1">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold"><?php echo $data_trainings['training_topic']; ?></h5>
                                <p class="card-text font-weight-bold"> 
                                    <i class="fas fa-clock"></i>
                                    <?php echo $data_trainings['training_start'] ?> until <?php echo $data_trainings['training_end']; ?>
                                </p>
                                <p>
                                    <a href="employee-trainings-content.php?training=<?php echo $data_trainings['training_id']; ?>" class="btn btn-primary w-100">
                                        <i class="fas fa-newspaper"></i> 
                                        Contents
                                    </a>
                                </p>
                                <!-- <a href="#" class="btn btn-primary">Learn More</a> -->
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
