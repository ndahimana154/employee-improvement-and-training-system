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
            <div class="col-md-9">
                <h2>
                    Employee trainings
                </h2>
                <div class="r">
                    <table class="table table-hover table-responsive">
                        <thead>
                            <tr>
                                <td>
                                    #
                                </th>
                                <th>
                                    Training topic
                                </th>
                               
                                <th>
                                    Start date
                                </th>
                                <th>
                                    End time
                                </th>
                                <th>
                                    Department
                                </th>
                                <th>
                                    Professional's email
                                </th>
                                <th>
                                    Status
                                </th>
                                
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $get_trainings = mysqli_query($server,"SELECT * from 
                                    trainings,departments
                                    WHERE 
                                    trainings.training_depart = departments.depart_id
                                    ORDER BY training_status DESC,
                                    training_start DESC,training_end DESC
                                ");
                                $count=1;
                                while ($data_trainings = mysqli_fetch_array($get_trainings)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $count++; ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $data_trainings['training_topic'];
                                            ?>
                                        </td>
                                       
                                        <td>
                                            <?php
                                                echo $data_trainings['training_start'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $data_trainings['training_end'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $data_trainings['depart_name'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                
                                                $training_id = $data_trainings['training_id'];
                                                $get_professional_tr = mysqli_query($server,"SELECT * from training_professionals
                                                    WHERE training='$training_id'
                                                    
                                                ");
                                                if (mysqli_num_rows($get_professional_tr) < 1) {
                                                    ?>
                                                    No professional
                                                    <?php
                                                }
                                                while ($data_profe_tr = mysqli_fetch_array($get_professional_tr)) {
                                                    $profes = $data_profe_tr['professional'];
                                                    $get_profe_info = mysqli_fetch_array(mysqli_query($server,"SELECT * from
                                                        professionals WHERE professional_id = '$profes'
                                                    "));
                                                    echo $get_profe_info['professional_email']." ";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $data_trainings['training_status'];
                                            ?>
                                        </td>
                                        <td>
                                            <a href="administration-trainings-add-content.php?training_id=<?php echo $data_trainings['training_id'] ?>" title="View training contents" class="btn btn-success">
                                                <i class="fas fa-file-alt"></i>
                                            </a>
                                            <a href="administrator-edit-training.php?training_id=<?php echo $data_trainings['training_id'] ?>" class="btn btn-primary" title="Edit training">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <?php
                                                if ($data_trainings['training_status'] == 'Progress') {
                                                    ?>
                                                    <a href="administrator-ban-training.php?training_id=<?php echo $data_trainings['training_id'] ?>" class="btn btn-danger" title="Disable training">
                                                        <i class="fas fa-toggle-off"></i>
                                                    </a>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <a href="administrator-unban-training.php?training_id=<?php echo $data_trainings['training_id'] ?>" class="btn btn-success" title="Enable training">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </a>
                                                    <?php
                                                }
                                            ?>
                                            <a href="administrator-training-overview.php?training_id=<?php echo $data_trainings['training_id'] ?>" title="Training overview" class="btn btn-primary">
                                                <i class="fas fa-clipboard-list"></i> 
                                            </a>
                                            <a href="trainings/covers/<?php echo $data_trainings['training_cover']; ?>" title="View training image." target="_blank" class="btn btn-warning">
                                                <i class="fa fa-external-link"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                   
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

