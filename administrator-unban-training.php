<?php
    session_start();
    include('php/connection.php');

    // Check if the user is logged in and the user type is correct
    if (!isset($_SESSION['user_name'])) {
        header("location: user-login.php");
    } elseif ($_SESSION['user_type'] != 'Administration') {
        header("location: user-login.php");
    } else {
        include("php\administration-sessions.php");
    }
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
    <style>
        .fixed-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #f8f9fa;
            border-right: 1px solid #e9ecef;
            padding: 20px;
        }
        .dashboard-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include("php/administration-header.php"); ?>

    <div class="">
        <div class="row p-2">
            <!-- Left navigation links -->
            <?php
                include("php/administration-left-links.php");
            ?>
            <!-- Dashboard Content -->
            <div class="col-md-8">
                <div class="row p-2">
                    <a href="administration-trainings.php" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h3 class="ml-2">
                        Training disabling
                    </h3>
                </div>
                <?php
                    if (!$_GET['training_id']) {
                        ?>
                        <p class="alert alert-danger">
                            No training sent to server.
                        </p>
                        <?php
                    }
                    else {
                        $training = $_GET['training_id'];
                        $checktraing_exists = mysqli_query($server,"SELECT * from trainings WHERE training_id ='$training'");
                        if (mysqli_num_rows($checktraing_exists) != 1) {
                            ?>
                            <p class="alert alert-danger">
                                Training doesn't exist.
                            </p>
                            <?php
                        }
                        else {
                            $unban = mysqli_query($server,"UPDATE
                                trainings SET 
                                training_status = 'Progress'
                                WHERE
                                training_id = '$training'
                            ");
                            if (!$unban) {
                                ?>
                                <p class="alert alert-danger">
                                    Training is not enabled
                                </p>
                                <?php
                            }
                            else {
                                ?>
                                <p class="alert alert-success">
                                    Training is enabled successfully.
                                </p>
                                <?php
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and your scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <style>
        .fixed-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #f8f9fa;
            border-right: 1px solid #e9ecef;
            padding: 20px;
        }
        .dashboard-content {
            margin-left: 250px;
            padding: 20px;
        }
        /* Adjust the min-height based on your design needs */
        .full-height {
            min-height: calc(100vh - 80px);
        }
    </style>
</body>
</html>
