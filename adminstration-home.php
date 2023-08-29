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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Training System</title>
    <!-- Link Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.css">
    <!-- Link Font-awesome icons -->
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web\css\all.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
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

    <div class="row">
        <!-- Left navigation links -->
        <?php
            include("php/administration-left-links.php");
        ?>
        <!-- Dashboard Content -->
        <div class="col-md-8">
            <!-- Right div with dashboard content -->
            <h2>Dashboard</h2>
            <div class="row p-3">
                <div class="col-md-4 m-2">
                    <div class="dashboard-box bg-primary text-light p-2 row">
                        <div class="mr-3">
                            <i class="fas fa-user-friends fa-3x mb-3 flex-1"></i>
                            <h4>Employees</h4>
                        </div>
                        
                        <p class="mb-0 fa-3x">
                            <?php 
                                $get_total_employees = mysqli_query($server,"SELECT * from users WHERE user_id != '$acting_admin_id'");
                                echo mysqli_num_rows($get_total_employees);
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 m-2">
                    <div class="dashboard-box bg-primary text-light p-2 row">
                        <div class="mr-3">
                            <i class="fas fa-graduation-cap fa-3x mb-3 flex-1"></i>
                            <h4>Trainings</h4>
                        </div>
                        
                        <p class="mb-0 fa-3x">
                            <?php
                                $get_total_trainngs = mysqli_query($server,"SELECT * from trainings");
                                echo mysqli_num_rows($get_total_trainngs);
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 m-2">
                    <div class="dashboard-box bg-primary text-light p-2 row">
                        <div class="mr-3">
                            <i class="fas fa-user-tie fa-3x mb-3 flex-1"></i>
                            <h4>Professionals</h4>
                        </div>
                        
                        <p class="mb-0 fa-3x">
                            <?php
                                $get_total_professionals = mysqli_query($server,"SELECT * from professionals

                                ");
                                echo mysqli_num_rows($get_total_professionals);
                            ?>
                        </p>
                    </div>
                </div>
                
                <!-- Add more dashboard cards here -->
            </div>
            <!-- Add your dashboard components here -->
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
