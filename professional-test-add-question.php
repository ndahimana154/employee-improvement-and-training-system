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
        <div class=" mt-4">
            <div class="d-flex">
                <!-- <a href="" class="btn btn-success">
                    <i class="fa fa-arrow-left"></i>
                </a> -->
                <h3>
                    <a href="professional-revision-tests.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                    Add Questions
                </h3>
            </div>
            <?php                
              
                if (!isset($_GET['test'])) {
                    ?>
                    <p class="alert alert-danger">
                        No test sent to server.
                    </p>
                    <?php
                }
                else {
                    $test_id = $_GET['test'];
                    $get_inf = mysqli_query($server,"SELECT * from tests WHERE test_id = '$test_id' 
                        AND training = '$acting_professional_training'
                    ");
                    if (mysqli_num_rows($get_inf) != 1) {
                        ?>
                        <p class="alert alert-danger">
                            Training not found.
                        </p>
                        <?php
                    }
                    else {
                        $data_test_info = mysqli_fetch_array($get_inf);
                        $questions_num = $data_test_info['test_questions_num'];
                        $testname = $data_test_info['test_name'];
                        ?>
                        <h4>
                            <b>Testname : <?php echo $testname; ?></b>
                        </h4>
                        <?php
                            if (isset($_POST["save_test_questions"])) {
                                $allInsertedSuccessfully = true; // Flag variable

                                // Check if there are existing questions for the current test
                                $existingQuestionsQuery = "SELECT question_text FROM tests_questions WHERE test_id = ? AND training = ?";
                                $stmtExisting = mysqli_prepare($server, $existingQuestionsQuery);
                                mysqli_stmt_bind_param($stmtExisting, "ii", $test_id, $acting_professional_training);
                                mysqli_stmt_execute($stmtExisting);
                                mysqli_stmt_store_result($stmtExisting);

                                // If there are existing questions, display an error
                                if (mysqli_stmt_num_rows($stmtExisting) > 0) {
                                    ?>
                                    <p class="alert alert-danger">
                                        Questions for this test already exist. You cannot insert duplicate questions.
                                    </p>
                                    <?php
                                } else {
                                    // Iterate through each question
                                    foreach ($_POST["question"] as $a => $question_text) {
                                        // Sanitizing the variable
                                        $question_text = mysqli_real_escape_string($server, $question_text);
                                        $answer_text = $_POST["answer"][$a]; // Get the corresponding answer
                                        // Sanitizing this
                                        $answer_text = mysqli_real_escape_string($server, $answer_text);
                                        $marks = $_POST['marks'][$a];
                                        // Sanitizing
                                        $marks = mysqli_real_escape_string($server, $marks);

                                        // Insert the question and answer into the test_questions table
                                        $insert_question_query = "INSERT INTO tests_questions (question_text, question_answer, marks, test_id, training) 
                                            VALUES (?, ?, ?, ?, ?)";
                                        $stmt = mysqli_prepare($server, $insert_question_query);
                                        mysqli_stmt_bind_param($stmt, "ssiii", $question_text, $answer_text, $marks, $test_id, $acting_professional_training);

                                        if (mysqli_stmt_execute($stmt)) {
                                            // Insertion succeeded for this question
                                            // You can add any additional logic here if needed
                                        } else {
                                            // Insertion failed for this question
                                            $allInsertedSuccessfully = false; // Set the flag to false
                                            break; // Exit the loop since one insertion failed
                                        }

                                        mysqli_stmt_close($stmt);
                                    }

                                    if ($allInsertedSuccessfully) {
                                        ?>
                                        <p class="alert alert-success">
                                            All test questions are saved successfully
                                        </p>
                                        <?php
                                    } else {
                                        ?>
                                        <p class="alert alert-danger">
                                            Saving questions failed. Please review and try again.
                                        </p>
                                        <?php
                                    }
                                }

                                mysqli_stmt_close($stmtExisting);
                            }
                        ?>



                        <form action="" method="post" class="mb-4">
                            <?php
                                for ($i = 1; $i <= $questions_num; $i++) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">
                                                <?php echo "<h6> Question.$i </h6>"; ?>
                                            </label>
                                            <textarea name="question[]" rows="8" class="form-control" placeholder="Type Question <?php echo $i ?>"  required></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">
                                                <h6>
                                                    Answer
                                                </h6>
                                            </label>
                                            <textarea name="answer[]" rows="5" class="form-control" placeholder="Type..." required></textarea>
                                            <div>
                                                <label for="">
                                                    Marks
                                                </label>
                                                <input type="text" placeholder="Type..." name="marks[]" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                            <button type="submit" name="save_test_questions" class="btn btn-success m-3">
                                <i class="fa fa-save"></i>
                                Save
                            </button>
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
