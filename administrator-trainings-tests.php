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
                <h3>
                    <a href="administration-trainings.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                    TRAINING TESTS
                </h3>
                <div class="">
                    <?php
                        if (isset($_GET['approve-test'])) {
                            $approvetest = $_GET['approve-test'];
                            // CHeck iff the test exists
                            $check_approve_exists = mysqli_query($server,"SELECT * from tests
                                WHERE test_id = '$approvetest'
                                AND test_status = 'Pending'
                            ");
                            if (mysqli_num_rows($check_approve_exists) != 1) {
                                ?>
                                <p class="alert alert-danger">
                                    The test to approve doesn't exists on the pending list
                                </p>
                                <?php
                            }
                            else {
                                // Update the test status
                                $update_approve = mysqli_query($server,"UPDATE tests SET test_status = 'Approved'
                                    WHERE test_id = '$approvetest'
                                ");
                                if (!$update_approve) {
                                    ?>
                                    <p class="alert alert-danger">
                                        Approving the test failed to complete.
                                    </p>
                                    <?php
                                }
                                else {
                                    ?>
                                    <p class="alert alert-success">
                                        Approving the test have been completed succesfully.
                                    </p>
                                    <?php
                                }
                            }
                        }
                        elseif (isset($_GET['reject-test'])) {
                            $reject_test = $_GET['reject-test'];
                            // CHeck iff the test exists
                            $check_reject_exists = mysqli_query($server,"SELECT * from tests
                                WHERE test_id = '$reject_test'
                                AND test_status = 'Pending'
                            ");
                            if (mysqli_num_rows($check_reject_exists) != 1) {
                                ?>
                                <p class="alert alert-danger">
                                    The test to reject doesn't exists on the pending list
                                </p>
                                <?php
                            }
                            else {
                                // Update the test status
                                $update_reject = mysqli_query($server,"UPDATE tests 
                                    SET test_status = 'Rejected'
                                    WHERE test_id = '$reject_test'
                                ");
                                if (!$update_reject) {
                                    ?>
                                    <p class="alert alert-danger">
                                        Rejecting the test failed to complete.
                                        
                                    </p>
                                    <?php
                                }
                                else {
                                    // FIrst get the test infos
                                    $data_reject_infos = mysqli_fetch_array($check_reject_exists);
                                    $reject_training = $data_reject_infos['training'];
                                    // Get the professional id
                                    $get_reject_infos = mysqli_query($server,"SELECT * from training_professionals
                                        WHERE training = '$reject_training'
                                    ");
                                    if (mysqli_num_rows($get_reject_infos) < 1) {
                                        $reject_professional_email = 'no_email@gmail.com';
                                    }
                                    else {
                                        $data_reject_prof_inf = mysqli_fetch_array($get_reject_infos);
                                        $reject_prof_id = $data_reject_prof_inf['professional'];
                                        // Get the real professional
                                        $get_real_reject_prof = mysqli_fetch_array(mysqli_query($server,"SELECT * from professionals
                                            WHERE professional_id = '$reject_prof_id'
                                        "));
                                        $reject_professional_email = $get_real_reject_prof['professional_email'];
                                    }
                                    ?>
                                    <p class="alert alert-success">
                                        Rejecting the test have been completed succesfully.
                                        <a href="mailto: <?php echo $reject_professional_email; ?>" target="_blank">
                                            Notify the reason
                                        </a>
                                    </p>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Scheduled date
                            </th>
                            <th>
                                Training
                            </th>
                            <th>
                                Testname
                            </th>
                            <th>
                                Questions number
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
                            $get_tests = mysqli_query($server,"SELECT * from tests,trainings
                                WHERE tests.training = trainings.training_id
                                ORDER BY 
                                -- test_status ASC,
                                test_schedule DESC
                            ");
                            if (mysqli_num_rows($get_tests) < 1) {
                                ?>
                                <tr>
                                    <td colspan="100">
                                        No values found!
                                    </td>
                                </tr>
                                <?php
                            }
                            $count = 1;
                            while ($data_training_tests= mysqli_fetch_array($get_tests)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                            echo $count++;
                                        ?>    
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_training_tests['test_schedule'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_training_tests['training_topic'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_training_tests['test_name'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_training_tests['test_questions_num'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_training_tests['test_status'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if ($data_training_tests['test_status'] == 'Pending') {
                                                ?>
                                                <a href="?approve-test=<?php echo $data_training_tests['test_id']; ?>">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                <a href="?reject-test=<?php echo $data_training_tests['test_id']; ?>">
                                                    <i class="fa fa-window-close text-danger"></i>
                                                </a>
                                                <?php
                                            }
                                            if ($data_training_tests['test_status'] != 'Upcoming' && $data_training_tests['test_status'] != 'Progressing' && $data_training_tests['test_status'] != 'Rejected') {
                                                ?>
                                                <a href="">
                                                    <i class="fa fa-edit text-success"></i>
                                                </a>
                                                <?php
                                            }
                                        ?>
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
