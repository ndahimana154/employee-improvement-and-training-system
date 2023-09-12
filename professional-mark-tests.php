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
            <a href="professional-revision-tests.php" class="btn btn-primary">
                <i class="fa fa-arrow-left"></i>
            </a>
            EMPLOYEES TEST MARKING
        </h2>
        <!-- <div class="ctrls p-3">
            <a href="professional-new-test.php" class="btn btn-success">
                <i class="fa fa-plus"></i>
                new test
            </a>
        </div> -->
        <div class="">
            <?php
                if (!isset($_GET['test-mark'])) {
                    ?>
                    <p class="alert alert-danger">
                        no test sent to the server!
                    </p>
                    <?php
                }
                else {
                    $mark_test = $_GET['test-mark'];
                    // Check if the test exists and is complete
                    $check_exists_complete = mysqli_query($server,"SELECT * from tests
                        WHERE training = '$acting_professional_training'
                        AND test_id = '$mark_test'
                        AND test_status = 'Completed'
                    ");
                    $get_test_questionsnum = mysqli_query($server,"SELECT * from tests_questions
                        WHERE test_id = '$mark_test'
                    ");
                    if (mysqli_num_rows($check_exists_complete) != 1) {
                        ?>
                        <p class="alert alert-danger">
                            The test is not found on the Completed list!
                        </p>
                        <?php
                    }
                    else {
                        $data_check_exists_complete = mysqli_fetch_array($check_exists_complete);
                        $training_check_id = $data_check_exists_complete['training'];
                        // Get the training department through the trainings table
                        $get_training_info = mysqli_fetch_array(mysqli_query($server,"SELECT * from trainings
                            WHERE training_id = '$training_check_id'
                        "));
                        $department_check_id = $get_training_info['training_depart'];
                        ?>
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr  class="text-success">
                                    <th>
                                        Test name:
                                    </th>
                                    <th colspan="3">
                                        <?php echo $data_check_exists_complete['test_name'] ?>
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
                                        Questions answered
                                    </th>
                                    <th>
                                        Marks
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <?php
                            // Get all users of the employees
                            $get_all_employees = mysqli_query($server,"SELECT * from users WHERE department = '$department_check_id'
                                AND user_state = 'Working'
                            ");
                            if (mysqli_num_rows($get_all_employees) < 1) {
                                ?>
                                <p class="alert alert-danger m-2">
                                    No employees found!
                                </p>
                                <?php
                            }
                            $count = 1;
                            while ($data_check_al_empl = mysqli_fetch_array($get_all_employees)) {
                                ?>
                                <tr>
                                    <td>

                                        <?php echo $count++; ?>
                                    </td>
                                    <td>
                                        <?php 
                                            echo $data_check_al_empl['user_fn']." ".$data_check_al_empl['user_ln'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $ai_empl_id = $data_check_al_empl['user_id'];
                                            $get_answer_nums = mysqli_query($server,"SELECT * from employees_test_answers
                                                WHERE employee = '$ai_empl_id'
                                                AND test = '$mark_test'
                                            ");
                                            echo mysqli_num_rows($get_answer_nums);
                                            $data_answer_nums = mysqli_fetch_array($get_answer_nums);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            // Check if the it is marked
                                            $check_if_test_marks_exists = mysqli_query($server,"SELECT * from employees_test_marks
                                                WHERE employee = '$ai_empl_id'
                                                AND test = '$mark_test'
                                            ");
                                            if (mysqli_num_rows($check_if_test_marks_exists) != 1) {
                                                ?>
                                                Not marked
                                                <?php
                                            }
                                            else {
                                                $data_if_test_marks_exists = mysqli_fetch_array($check_if_test_marks_exists);
                                                echo $data_if_test_marks_exists['average_marks'];
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if (mysqli_num_rows($get_answer_nums) < 1) {
                                                ?>
                                                <a href="" class="">
                                                    Mark 0
                                                </a>
                                                <?php
                                            }
                                            elseif (mysqli_num_rows($check_if_test_marks_exists) != 1) {
                                                ?>
                                                <a href="professional-test-view-employee-answer.php?test-mark=<?php echo $mark_test ?>&employee-mark=<?php echo $data_check_al_empl['user_id']; ?>">
                                                    View answers
                                                </a>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            
                        </table>
                        <?php
                    }
                }
            ?>
        </div>
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
