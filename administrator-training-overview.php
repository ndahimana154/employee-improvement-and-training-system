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
                            $data_training_exists = mysqli_fetch_array($checktraing_exists);
                            $training_topic = $data_training_exists['training_topic'];
                        
                            $get_training_contents = mysqli_query($server,"SELECT * from training_contents
                                WHERE training = '$training'
                            ");
                            $training_depart = $data_training_exists['training_depart'];
                            // Get the employees of the department
                            $get_training_employees = mysqli_query($server,"SELECT * from users
                                WHERE
                                department = '$training_depart'
                                ORDER BY user_fn ASC,
                                user_ln ASC
                            ");
                            $count = 1;
                            ?>
                            <div class="row p-2">
                                <a href="administration-trainings.php" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                                <h4 class="ml-2">TRAININGS OVERVIEW</h4>
                            </div>
                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>
                                            Topic:
                                        </th>
                                        <th colspan="3">
                                            <?php echo $data_training_exists['training_topic']; ?>
                                        </th>
                                        
                                    </tr>
                                    <tr>
                                        <th>
                                            Total contents:
                                        </th>
                                        <th colspan="10">
                                            <?php echo mysqli_num_rows($get_training_contents); ?>
                                        </th>
                                        <th>
                                            Revision tests:
                                        </th>
                                        <th colspan="10">
                                            <?php
                                                $get_training_tests_num = mysqli_query($server,"SELECT * from tests
                                                    WHERE   training='$training'
                                                ");
                                                echo mysqli_num_rows($get_training_tests_num);
                                            ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Total employees:
                                        </th>
                                        <th colspan="10">
                                            <?php echo mysqli_num_rows($get_training_employees); ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Employee names
                                        </th>
                                        <th>
                                            Completed contents
                                        </th>
                                        <th>
                                            Percentage
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (mysqli_num_rows($get_training_employees) < 1) {
                                            ?>
                                            <tr>
                                                <td colspan="100">
                                                    No values found!
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        while ($data_training_employees = mysqli_fetch_array($get_training_employees)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                        echo $count++;
                                                    ?>    
                                                </td>
                                                <td>
                                                    <?php
                                                        echo $data_training_employees['user_fn']." ".$data_training_employees['user_ln'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $total_contents = mysqli_num_rows($get_training_contents);
                                                        $employeee_id = $data_training_employees['user_id'];
                                                        $get_completion_num = mysqli_query($server,"SELECT * from empl_trainings_conent_completion
                                                            WHERE employee = $employeee_id AND training = '$training'
                                                        ");
                                                        $total_completed = mysqli_num_rows($get_completion_num);
                                                        echo $total_completed."/".$total_contents;
                                                        // echo mysqli_num_rows($get_completion_num)."/".mysqli_num_rows($get_training_contents);
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if (mysqli_num_rows($get_training_contents) == 0) {
                                                            ?>
                                                            <p class="text-danger">
                                                                No contents
                                                            </p>
                                                            <?php
                                                        }
                                                        else {
                                                            echo $percentage = round(($total_completed/$total_contents)*100,2);
                                                            echo "%";
                                                        }
                                                        
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th colspan="10">TRAINING CONTENTS</th>
                                    </tr>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Content name
                                        </th>
                                        <th>
                                            Completion rate
                                        </th>
                                        <th>
                                            Content file
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            $get_training_contents = mysqli_query($server,"SELECT * from training_contents
                                                WHERE training = '$training'
                                            ");
                                            if (mysqli_num_rows($get_training_contents) <1) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        no values!
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            $count2 =1;
                                            while ($data_contents = mysqli_fetch_array($get_training_contents)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                            echo $count2++;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $data_contents['content_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $content_id = $data_contents['training_content_id'];
                                                            $selectcontentcompletion = mysqli_query($server,"SELECT * from empl_trainings_conent_completion
                                                                WHERE content = '$content_id' AND training = '$training'
                                                            ");
                                                            $completion_num = mysqli_num_rows($selectcontentcompletion);
                                                            echo $completion_num."/".$total_contents;
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo $data_contents['content_file']; ?>" target="_blank" title="View file" class="btn btn-primary">
                                                            <i class="fas fa-folder-open"></i>
                                                        </a>
                                                        
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                            </table>
                            <?php
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
