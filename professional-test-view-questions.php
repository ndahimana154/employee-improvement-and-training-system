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
                <h5 class="font-weight-bold">
                    <a href="professional-revision-tests.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                    View questions
                </h5>
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
                        <h4 class="text-success">
                            <b>Testname : <?php echo $testname; ?></b>
                        </h4>
                        <?php
                            $get_test_questions = mysqli_query($server,"SELECT * from tests_questions
                                WHERE test_id = '$test_id'
                            ");
                            $count=1;
                            if (mysqli_num_rows($get_test_questions) < 1) {
                                ?>
                                <p class="alert alert-danger">
                                    No questions for this test
                                </p>
                                <?php
                            }
                            while($data_test_questions = mysqli_fetch_array($get_test_questions)) {
                                ?>
                                <div class="bg-light shadow rounded m-2 row">
                                    <div class=" col-md-8">
                                        <div class="col-md-6 ">
                                            <label class="font-weight-bold">
                                                <?php echo "<h6 class='font-weight-bold'> Question. ".$count++."</h6>"; ?>
                                            </label>
                                            <p class=""><?php echo $data_test_questions['question_text'] ?></p>
                                        </div>
                                        <div class="col-md-6 m-3">
                                            <label for="">
                                                <h6 class="text-primary">
                                                    Answer
                                                </h6>
                                            </label>
                                            <p class="text-dark"><?php echo $data_test_questions['question_answer'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
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