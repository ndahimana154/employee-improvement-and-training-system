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
                        <p class="alert alert-danger">
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
                                       <div class="row">
                                            <p class="font-weight-bold text-success" style="margin-left: 10px;">
                                                Testname: <?php echo $data_test_exists['test_name'] ?>
                                            </p>
                                            <p> ||</p>
                                            <p class="font-weight-bold text-success" style="margin-left: 10px;">
                                                Scheduled date: <?php echo $data_test_exists['test_schedule'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Now we are going to find the test questions -->
                                    <div class="">
                                        <?php
                                            $get_questions = mysqli_query($server,"SELECT * from tests_questions
                                                WHERE test_id = '$test'
                                                AND training = '$training'
                                            ");
                                            $get_marks_sum = mysqli_fetch_array(mysqli_query($server,"SELECT sum(marks) from tests_questions
                                                WHERE test_id = '$test'
                                                AND training = '$training'
                                            ")); 
                                        ?>
                                        <h6 class="text-primary">
                                            Test questions <b>(<?php echo mysqli_num_rows($get_questions) ?>)</b> -
                                            Marks <b>(<?php echo $get_marks_sum[0]; ?>)</b>
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
                                                if (isset($_POST['save_answers'])) {
                                                    // Initialize error messages array
                                                    $errors = array();
                                                    $success = true;
                                                    
                                                    // Validate and sanitize form data
                                                    $answers = $_POST['answer'];
                                                    $questions = $_POST['questions'];
                                                
                                                    // Iterate through each answer
                                                    foreach ($answers as $a => $answer_text) {
                                                        // Sanitize the data
                                                        $question_id = mysqli_real_escape_string($server, $questions[$a]);
                                                        $answer_text = mysqli_real_escape_string($server, $answer_text);
                                                        
                                                        // Check if answer is empty
                                                        if (empty($answer_text)) {
                                                            $errors[] = "Answer for Question $question_id is required.";
                                                            $success = false;
                                                            continue; // Skip to the next iteration
                                                        }
                                                        
                                                        $marking = 0; // You may need to adjust this based on your requirements
                                                        $status = 'Pending'; // You may need to adjust this based on your requirements
                                                        
                                                        // Check if the answer already exists for this question
                                                        $check_answer_query = "SELECT * FROM employees_test_answers WHERE employee = $acting_employee_id AND training = $training AND test = $test AND question = $question_id";
                                                        $existing_answer = mysqli_query($server, $check_answer_query);
                                                
                                                        if (mysqli_num_rows($existing_answer) > 0) {
                                                            $errors[] = "An answer already exists for Question $question_id.";
                                                            $success = false;
                                                        } else {
                                                            // Insert the answer into the table
                                                            $insert_answer_query = "INSERT INTO employees_test_answers (employee, training, test, question, answer_text, marking, status) 
                                                                VALUES ($acting_employee_id, $training, $test, $question_id, '$answer_text', $marking, '$status')";
                                                            
                                                            $insert_answer_query = mysqli_query($server, $insert_answer_query);
                                                            
                                                            if (!$insert_answer_query) {
                                                                // Insertion failed for this answer
                                                                $errors[] = "Failed to save answer for Question $question_id.";
                                                                $success = false;
                                                            }
                                                        }
                                                    }
                                                    
                                                    if ($success) {
                                                        ?>
                                                        <p class="alert alert-success">
                                                            Answers are saved successfully.
                                                        </p>
                                                        <?php
                                                    } else {
                                                        foreach ($errors as $error) {
                                                            ?>
                                                            <p class="alert alert-danger">
                                                                <?php echo $error; ?>
                                                            </p>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                
                                                ?>                                                
                                                <form action="" method="post">
                                                    <?php
                                                        $que_counter = 1;
                                                        while ($data_questions = mysqli_fetch_array($get_questions)) {
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-5 m-1">
                                                                    <label for="" class="font-weight-bold">
                                                                        Question <?php echo $que_counter++ ?> / <?php echo $data_questions['marks'] ?> Marks
                                                                    </label>
                                                                    <textarea name="questions[]" class="form-control" hidden><?php echo $data_questions['question_id'] ?></textarea>
                                                                    <p>
                                                                        <?php echo $data_questions['question_text'] ?>
                                                                    </p>
                                                                </div>
                                                                <?php
                                                                    $current_question = $data_questions['question_id'];
                                                                    // Check if the question exists
                                                                    $check_answer_exists = mysqli_query($server,"SELECT * from employees_test_answers 
                                                                        WHERE test = '$test' 
                                                                        AND question = '$current_question'
                                                                    ");
                                                                ?>
                                                                <div class="col-md-6 m-1">
                                                                    <label for="" class="font-weight-bold">
                                                                        Answer:
                                                                    </label>
                                                                    <?php
                                                                        if (mysqli_num_rows($check_answer_exists) > 0) {
                                                                            $data_check_answer_exists = mysqli_fetch_array($check_answer_exists);
                                                                            ?>
                                                                            <textarea name="answer[]" class="form-control" placeholder="Type.. answer" readonly><?php echo $data_check_answer_exists['answer_text']; ?></textarea>
                                                                            <?php
                                                                        }
                                                                        else {
                                                                            ?>
                                                                            <textarea name="answer[]" class="form-control" placeholder="Type.. answer"></textarea>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    ?>
                                                    <button name="save_answers" class="btn btn-success">
                                                        Submit
                                                    </button>
                                                </form>

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
