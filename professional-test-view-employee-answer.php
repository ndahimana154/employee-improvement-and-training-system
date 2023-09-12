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
                elseif (!isset($_GET['employee-mark'])) {
                    ?>
                    <p class="alert alert-danger">
                        No employee sent to server!
                    </p>
                    <?php
                }
                else {
                    $mark_test = $_GET['test-mark'];
                    $employee_mark = $_GET['employee-mark'];
                    // Check if the test exists and is complete
                    $check_exists_complete = mysqli_query($server,"SELECT * from tests
                        WHERE training = '$acting_professional_training'
                        AND test_id = '$mark_test'
                        AND test_status = 'Completed'
                    ");
                    if (mysqli_num_rows($check_exists_complete) != 1) {
                        ?>
                        <p class="alert alert-danger">
                            The test is not found on the Completed list!
                        </p>
                        <?php
                    }
                    else {
                        $check_exists_complete = mysqli_fetch_array($check_exists_complete);
                        // Get the employees
                        $get_user = mysqli_fetch_array(mysqli_query($server,"SELECT * from
                            users WHERE user_id = '$employee_mark'
                        "));
                        ?>
                        <h2 class="text-primary">
                            Employee names: <?php echo $get_user['user_fn']." ".$get_user['user_ln']; ?>
                        </h2>
                        <h3>
                            Testname: <?php echo $check_exists_complete['test_name']; ?>
                        </h3>
                        <form action="" method="post">
                            <?php
                                if (isset($_POST['save_emp_marks'])) {
                                    // Initialize error messages array
                                    $errors = array();
                                    $success = true;

                                    // Loop through IDs
                                    $arraycounter = 0;
                                    $total_marks = 0;
                                    // $array
                                    foreach ($_POST['eta_ids'] as $answer_id) {
                                        $answer_id;
                                        $marks =(int) $_POST['marks'][$arraycounter];
                                        $question = $_POST['question_ids'][$arraycounter++];
                                        $total_marks += $marks;
                                        // Check if the marks don't exists
                                        $check_marks_exis = mysqli_query($server,"SELECT * from employees_test_marks
                                            WHERE employee = '$employee_mark'
                                            AND test = '$mark_test'
                                        ");
                                        if (mysqli_num_rows($check_marks_exis) > 0) {
                                            $errors[] = "The marks arleady exists";
                                            $success = false;
                                            break;
                                        }
                                        else {
                                            // Save in employee test marks
                                            $save_etm = mysqli_query($server,"INSERT into
                                                employees_test_marks
                                                VALUES(null,$employee_mark,$mark_test,$total_marks,current_timestamp(),'Marked');
                                            ");
                                            // Update the marks
                                            $update_marks = mysqli_query($server,"UPDATE employees_test_answers
                                                SET marking = '$marks',
                                                status = 'Markked'
                                                WHERE eta_id = '$answer_id'
                                                AND employee = '$employee_mark'
                                                AND question = '$question'
                                            ");
                                            $success = true;
                                        }
                                    }
                                    if ($success) {
                                        ?>
                                        <p class="alert alert-success">
                                            MArks are saved successfully.
                                        </p>
                                        <?php
                                    }
                                    else {
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
                            <table class="table table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Submission time
                                        </th>
                                        <th>
                                            QUestion text
                                        </th>
                                        <th>
                                            Answer text
                                        </th>
                                        <th>
                                            QUestion marks
                                        </th>
                                        <th>
                                            Marking
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $gettheemp_answers = mysqli_query($server,"SELECT * from employees_test_answers,
                                        tests_questions    
                                        WHERE 
                                        tests_questions.question_id = employees_test_answers.question
                                        AND employee = '$employee_mark'
                                        AND test = '$mark_test'
                                    ");
                                if (mysqli_num_rows($gettheemp_answers) < 1) {
                                    ?>
                                    <tr>
                                        <td colspan="100">
                                            No values found
                                        </td>
                                    </tr>
                                    <?php
                                }
                                $counter = 1;
                                while($data_getemp_answers = mysqli_fetch_array($gettheemp_answers)) {
                                    ?>
                                    <tr>
                                        <td>
                                        <input type="number" name="eta_ids[]" value="<?php echo $data_getemp_answers['eta_id']; ?>" class="form-control" hidden>
                                            <?php echo $counter++; ?>
                                        </td>
                                        <td>
                                            <?php echo $data_getemp_answers['submission_time']; ?>
                                        </td>
                                        <td>
                                            <input type="number" name="question_ids[]" value="<?php echo $data_getemp_answers['question_id']; ?>" class="form-control"  hidden>
                                            <?php echo $data_getemp_answers['question_text']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data_getemp_answers['answer_text']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data_getemp_answers['marks']; ?>
                                        </td>
                                        <td>
                                            <select name="marks[]" class="form-control">
                                                <?php 
                                                    $question_marks=$data_getemp_answers['marks']; 
                                                    for ($a=0; $a <= $question_marks; $a++) { 
                                                        ?>
                                                        <option value="<?php echo $a; ?>">
                                                            <?php echo $a ?>
                                                        </option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="100">
                                        <button type="submit" name="save_emp_marks" class="btn btn-success">
                                            <i class="fa fa-save"></i>
                                            Save marks
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
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
