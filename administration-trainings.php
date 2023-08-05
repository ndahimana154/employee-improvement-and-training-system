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
                <h2>
                    Employee trainings
                </h2>
                <div class="row">
                    <?php
                        $get_trainings = mysqli_query($server,"SELECT * from 
                        trainings,departments
                        WHERE 
                        trainings.training_depart = departments.depart_id
                        ORDER BY training_status DESC,
                        training_start DESC,training_end DESC");
                        if (mysqli_num_rows($get_trainings) < 1) {
                            ?>
                            <p class="alert alert-danger">
                                No trainings available
                            </p>
                            <?php
                        }
                        while ($data_trainings = mysqli_fetch_array($get_trainings)) {
                            ?>
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <img src="trainings/covers/<?php echo $data_trainings['training_cover'] ?>" class="card-img-top" alt="Training 1">
                                    <div class="card-body">
                                        <h2 class="h4 text-primary"><?php echo $data_trainings['training_topic'] ?></h2>
                                        <p class="card-text">
                                            From <?php echo $data_trainings['training_start']; ?> to <?php echo $data_trainings['training_end']; ?>
                                        </p>
                                        <p class="card-text">Department: <?php echo $data_trainings['depart_name'];  ?></p>
                                        <p>
                                            <?php
                                                $training = $data_trainings['training_id'];
                                                $get_contentnum = mysqli_query($server,"SELECT * from training_contents WHERE training='$training'");
                                            ?>
                                            No contents: <?php echo mysqli_num_rows($get_contentnum); ?>
                                        </p>
                                        <a href="administration-trainings-add-content.php?training_id=<?php echo $data_trainings['training_id']; ?>" class="btn btn-success">
                                            <i class="fa fa-plus-circle"></i> content
                                        </a>
                                        <button class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                            view contents
                                        </button>
                                        <button class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                            Terminate
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
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

