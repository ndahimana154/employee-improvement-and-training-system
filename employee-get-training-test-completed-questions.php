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
    <script src="js/employee-get-trainings-content.js"></script>
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
                if (!isset($_GET['test'])) {
                    ?>
                    <p class="alert alert-danger " style="">
                        No test sent to the server.
                    </p>
                    <?php
                }
                elseif (!isset($_GET['training'])) {
                    ?>
                    <p class="alert alert-danger " style="">
                        No training sent to the server.
                    </p>
                    <?php
                }
                else {
                    $training = $_GET['training'];
                    $test = $_GET['test'];
                    // CHeck if the test exists
                    $check_test_exists = mysqli_query($server,"SELECT * from tests
                        WHERE test_id = '$test'
                    ");
                    // Check if the training exists
                    $check_exists = mysqli_query($server,"SELECT * from trainings WHERE
                        training_id='$training'
                    ");
                    if (mysqli_num_rows($check_exists) != 1) {
                        ?>
                        <p class="alert alert-danger">
                            The training is not found.
                        </p>
                        <?php
                    }
                    elseif (mysqli_num_rows($check_test_exists) != 1) {
                        ?>
                        <p class="alert alert-danger m-2">
                            The test is not found.
                        </p>
                        <?php
                    }
                    else {
                        // $data_check_exits = mysqli_fetch_array($check_exists);
                        $data_test_exists = mysqli_fetch_array($check_test_exists);
                        ?>
                        <div class="contents m-3 p-2">
                            <a href="employee-trainings.php" class="text-dark font-weight-bold">Trainings</a> / <a href=" "  class="text-dark font-weight-bold">Tests</a> / <a href="" class="text-dark font-weight-bold"><?php echo $data_test_exists['test_name']; ?></a>
                        </div>
                        <div class="row bg-light">
                            <!-- Training Contents Column -->
                            <div class="col-md-3 text-light p-4" id="contents_list">
                                <?php include("php/employee-trainings-test-list.php"); ?>
                            </div>
                            <!-- Training Description Column -->
                            <div class="col-md-5 bg-light p-4">
                                <div id="trai_description">
                                    <div class="" style="font-size: 20px;">
                                       <div class="">
                                            <p class="font-weight-bold text-success" style="margin-left: 10px;">
                                                TESTNAME: <?php echo $data_test_exists['test_name'] ?>
                                            </p>
                                            <!-- <p> ||</p> -->
                                            <p class="font-weight-bold text-dark" style="margin-left: 10px;">
                                                <?php
                                                    $get_questions = mysqli_query($server,"SELECT * from tests_questions
                                                        WHERE test_id = '$test'
                                                        AND training = '$training'
                                                    ");
                                                    $get_marks_sum = mysqli_fetch_array(mysqli_query($server,"SELECT sum(marks) from tests_questions
                                                        WHERE test_id = '$test'
                                                        AND training = '$training'
                                                    ")); 
                                                    // Set the test to progressing if it is upcoming
                                                    $update_to_progress = mysqli_query($server,"UPDATE tests
                                                        set test_status = 'Progressing'
                                                        WHERE test_id = '$test'
                                                        AND test_status = 'Upcoming'
                                                    ");
                                                    $get_complete_time = mysqli_fetch_array(mysqli_query($server,"SELECT * from test_completion_time
                                                        WHERE training = '$training'
                                                        AND test = '$test'
                                                    "));
                                                ?>
                                                TIME SCHEDULE <?php echo $data_test_exists['test_schedule']." - ".$get_complete_time['date_time']; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Now we are going to find the test questions -->
                                    <div class="">
                                        
                                        <h6 class=" ml-2">
                                            Test questions <b>(<?php echo mysqli_num_rows($get_questions) ?>)</b> <br>
                                            Marks <b>(<?php echo $get_marks_sum[0]; ?>)</b> <br>
                                            Marking status: <?php 
                                                $check_mark_status = mysqli_query($server,"SELECT * from employees_test_marks
                                                    WHERE test = '$test'
                                                    AND employee = '$acting_employee_id'
                                                ");
                                                if (mysqli_num_rows($check_mark_status) < 1) {
                                                    echo "<b>Not marked. </b>";
                                                }
                                                else {
                                                    echo"Marked"; 
                                                }
                                                ?>
                                        </h6>
                                        <?php
                                            if (mysqli_num_rows($get_questions) < 1) {
                                                ?>
                                                <p class="alert alert-danger">
                                                    No questions found
                                                </p>
                                                <?php
                                            }
                                            else {
                                                $que_counter = 1;
                                                while ($data_questions = mysqli_fetch_array($get_questions)) {
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-5 m-1">
                                                            <label for="" class="font-weight-bold">
                                                                Question <?php echo $que_counter++ ?> - 
                                                                <?php
                                                                    $current_question = $data_questions['question_id'];
                                                                    // Check if the question exists
                                                                    $check_answer_exists = mysqli_query($server,"SELECT * from employees_test_answers 
                                                                        WHERE test = '$test' 
                                                                        AND question = '$current_question'
                                                                    ");
                                                                    if (mysqli_num_rows($check_answer_exists) > 0) {
                                                                        $data_check_answer_exists = mysqli_fetch_array($check_answer_exists);
                                                                        echo "<b class='text-danger'>".$data_check_answer_exists['marking']."/"; 
                                                                    }
                                                                    echo $data_questions['marks'] ?> Marks</b>
                                                            </label>
                                                            <p>
                                                                <?php echo $data_questions['question_text'] ?>
                                                            </p>
                                                        </div>
                                                        <?php
                                                            
                                                        ?>
                                                        <div class="col-md-6 m-1">
                                                            <label for="" class="font-weight-bold">
                                                                Answer:
                                                            </label>
                                                            <?php
                                                                $check_answer_exists = mysqli_query($server,"SELECT * from employees_test_answers 
                                                                    WHERE test = '$test' 
                                                                    AND question = '$current_question'
                                                                ");
                                                                if (mysqli_num_rows($check_answer_exists) > 0) {
                                                                    $data_check_answer_exists = mysqli_fetch_array($check_answer_exists);
                                                                    ?>
                                                                    <p>
                                                                        <?php echo $data_check_answer_exists['answer_text']; ?>
                                                                    </p>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                // CHeck if the marks are there and display total
                                                $check_marks_total = mysqli_query($server,"SELECT * from employees_test_marks
                                                    WHERE test = '$test'
                                                    AND employee = '$acting_employee_id'
                                                ");
                                                if (mysqli_num_rows($check_marks_total) == 1) {
                                                    // gET THE TEST QUESTIONS
                                                    $get_test_questions_marks = mysqli_query($server,"SELECT * from
                                                        tests_questions WHERE test_id = '$test' AND training = '$training'
                                                    ");
                                                    $total_test_marks = 0;
                                                    while ($data_test_questions_marks = mysqli_fetch_array($get_test_questions_marks)) {
                                                        $total_test_marks += $data_test_questions_marks['marks'];
                                                    }
                                                    ?>
                                                    <div class="font-weight-bold m-3">
                                                        <?php
                                                            $data_check_total = mysqli_fetch_array($check_marks_total);
                                                            echo "TOTAL MARKS: ".$data_check_total['average_marks']."/".$total_test_marks;
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <button type="button" class="btn btn-success">
                                                    <i class="fa fa-print"></i>
                                                    Print
                                                </button>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
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
