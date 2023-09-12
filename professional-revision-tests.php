<?php   
    session_start();
    include("php/connection.php");
    include("php/professional-sessions.php");
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
        include("php/professional-header.php");
    ?>
    <div class="container">
        <h2>
            REVISION TESTS
        </h2>
        <div class="ctrls p-3">
            <a href="professional-new-test.php" class="btn btn-success">
                <i class="fa fa-plus"></i>
                new test
            </a>
        </div>
        <div class="">
            <?php
                if (isset($_GET['set-upcoming'])) {
                    $upcoming_id = $_GET['set-upcoming'];
                    // Check if the upcoming exists
                    $check_upcoming_exists = mysqli_query($server,"SELECT * from tests
                        WHERE test_id = '$upcoming_id'
                        AND test_status = 'Approved'
                        AND training = '$acting_professional_training'
                    ");
                    if (mysqli_num_rows($check_upcoming_exists) != 1) {
                        ?>
                        <p class="alert alert-danger">
                            The test doesn't exist on the Approved list.
                        </p>
                        <?php
                    }
                    else {
                        $make_upcoming = mysqli_query($server,"UPDATE tests
                            set test_status = 'Upcoming'
                            WHERE test_id = '$upcoming_id'
                            AND training = '$acting_professional_training'
                        ");
                    }
                }
                elseif (isset($_GET['complete-test'])) {
                    $complete_test = $_GET['complete-test'];
                    // Check if the test exists and is progressing
                    $check_complete_test = mysqli_query($server,"SELECT * from 
                        tests WHERE test_id = '$complete_test'
                        AND test_status = 'Progressing'
                        AND training = '$acting_professional_training'
                    ");
                    if (mysqli_num_rows($check_complete_test) != 1) {
                        ?>
                        <p class="alert alert-danger">
                            The test is not found on progressing list.
                        </p>
                        <?php
                    }
                    else {
                        $set_complete = mysqli_query($server,"UPDATE tests
                            SET test_status = 'Completed'
                            WHERE test_id = '$complete_test'
                        ");
                        if (!$set_complete) {
                            ?>
                            <p class="alert alert-danger">
                                Completing the test failed.
                            </p>
                            <?php
                        }
                        else {
                            // Get all the employees with the current department
                            $get_employees_in_complete_test = mysqli_query($server,"SELECT * from users
                                WHERE department = '$training_depart'
                                OR user_type = 'Administration'
                            ");
                            // Save the record in the database
                            $save_test_completion_time = mysqli_query($server,"INSERT into test_completion_time 
                                (`completion_id`, `training`, `test`, `action_by`)
                                VALUES(null,$acting_professional_training,$complete_test,$acting_professional_id)   
                            ");
                            ?>
                            <p class="alert alert-success">
                                The test is set complete.
                                <a href="mailto: <?php while ($data_employees_in_complete = mysqli_fetch_array($get_employees_in_complete_test)) {
                                    echo $data_employees_in_complete['user_email'].",";
                                } ?>">
                                    Notify the Employees and Administration
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
                    Test name
                </th>
                <th>
                    Test start
                </th>
                
                <th>
                    Questions number
                </th>
                <th>
                    Test status
                </th>
                <th>
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $count =1;
                $get_tests = mysqli_query($server,"SELECT * from tests
                    WHERE training = '$acting_professional_training'
                    ORDER BY test_schedule ASC
                ");
                if (mysqli_num_rows($get_tests) < 1) {
                    ?>
                    <tr>
                        <td colspan="10">no values</td>
                    </tr>
                    <?php
                }
                while ($data_tests = mysqli_fetch_array($get_tests)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $count++ ?>
                        </td>
                        <td>
                            <?php echo $data_tests['test_name']; ?>
                        </td>
                        <td>
                            <?php echo $data_tests['test_schedule']; ?>
                        </td>
                        <td>
                            <?php
                                $test_id = $data_tests['test_id'];
                                $get_testquestinfo = mysqli_query($server,"SELECT * from tests_questions
                                    WHERE test_id = '$test_id'
                                "); 
                                echo mysqli_num_rows($get_testquestinfo)."/".$data_tests['test_questions_num']; ?>
                        </td>
                        <td>
                            <?php echo $data_tests['test_status']; ?>
                        </td>
                        <td>
                            <?php
                                if (mysqli_num_rows($get_testquestinfo) < $data_tests['test_questions_num'] && $data_tests['test_status'] != 'Rejected') {
                                    ?>
                                    <a href="professional-test-add-question.php?test=<?php echo $data_tests['test_id']; ?>">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                    <?php
                                }
                                else {
                                    ?>
                                    <a href="professional-test-view-questions.php?test=<?php echo $data_tests['test_id']; ?>">
                                        <i class="fas fa-list text-dark"></i>
                                    </a>
                                    <?php
                                }
                                if ($data_tests['test_status'] == 'Approved') {
                                    ?>
                                    <a href="?set-upcoming=<?php echo $data_tests['test_id']; ?>">
                                        <i class="fa fa-check text-success"></i>
                                    </a>
                                    <?php
                                }
                                if ($data_tests['test_status'] == 'Progressing') {
                                    ?>
                                    <a href="?complete-test=<?php echo $data_tests['test_id']; ?>">
                                        <i class="fa fa-clock"></i>
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
        /* .chat-container {
            display: flex;
            height: 100vh;
        } */
        .chat-list {
            flex: 1;
            background-color: #f8f9fa;
            overflow-y: auto;
        }
        .chat-conversation {
            flex: 3;
            background-color: #ffffff;
            border-left: 1px solid #e9ecef;
            overflow-y: auto;
        }
        .message {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }
    </style>
</body>
</html>
