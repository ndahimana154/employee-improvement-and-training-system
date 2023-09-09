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
</head>
<body>
    <!-- Header -->
    <?php
        include("php/employee-header.php");
    ?>

    <!-- Display trainings -->
    <section class="">
        <div class="" style="">
            <?php
                if (!isset($_GET['training']) || !isset($_GET['content'])) {
                    ?>
                    <p class="alert alert-danger">
                        No training sent to the server.
                    </p>
                    <?php
                }
                else {
                    $training = $_GET['training'];
                    $content_id = $_GET['content'];
                    // Check if the training exists
                    $check_exists = mysqli_query($server,"SELECT * from trainings WHERE
                        training_id='$training'
                    ");

                    // Check if content exists
                    $check_content_exiss = mysqli_query($server,"SELECT * from training_contents
                        WHERE 
                        training_content_id = '$content_id'
                        AND training = '$training'
                    ");
                    if (mysqli_num_rows($check_exists) != 1 || mysqli_num_rows($check_content_exiss) !=1) {
                        ?>
                        <p class="alert alert-danger">
                            The contents are not found.
                        </p>
                        <?php
                    }
                    else {
                        $data_check_exits = mysqli_fetch_array($check_exists);
                        $data_cehc_content_exists = mysqli_fetch_array($check_content_exiss);
                        ?>
                        <div class="contents m-3 p-2">
                            <a href="employee-trainings.php" class="text-dark font-weight-bold">Trainings</a> 
                            / 
                            <a href="employee-trainings-content.php?training=<?php echo $training; ?>" class="text-dark font-weight-bold"><?php echo $data_check_exits['training_topic']; ?></a>
                            /
                            <a href="" class="text-dark font-weight-bold"><?php echo $data_cehc_content_exists['content_name']; ?></a>

                        </div>
                        <div class="row bg-light" style="height: 700px;">
                            <!-- Training Contents Column -->
                            <?php include("php/employee-training-content-list.php"); ?>

                            <!-- Training Description Column -->
                            <div class="col-md-5 bg-light p-4">
                                <?php include("php/employee-get-training-content.php"); ?>
                            </div>

                            <!-- Chat with Professionals Column -->
                            <div class="col-md-4 p-4">
                                <?php
                                    include("php/emplyees-contents-chat.php");
                                ?>
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
