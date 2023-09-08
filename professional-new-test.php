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
        <div class="col-md-8">
            <div class="d-flex">
                <!-- <a href="" class="btn btn-success">
                    <i class="fa fa-arrow-left"></i>
                </a> -->
                <h2>
                    New test
                </h2>
            </div>
            <form action="" method="post">
                <?php
                    if (isset($_POST['save_test'])) {
                        $testname = $_POST['tn'];
                        $scheduledate = $_POST['td'];
                        $scheduletime = $_POST['tt'];
                        $question_num = $_POST['tqn'];
                        $fulltime = $scheduledate." ".$scheduletime;
                        $check_testname = mysqli_query($server,"SELECT * from tests
                            WHERE test_name = '$testname'
                            AND training = '$acting_professional_training'
                        "); 
                        if (mysqli_num_rows($check_testname) > 0) {
                            ?>
                            <p class="alert alert-danger">
                                Test name already exists!
                            </p>
                            <?php
                        }
                        else {
                            // Check if no schedule test the same day
                            $check_same_day = mysqli_query($server,"SELECT * from tests WHERE
                                test_start LIKE '$scheduledate%'
                                AND training = '$acting_professional_training'
                            ");
                            if (mysqli_num_rows($check_same_day) > 0) {
                                ?>
                                <p class="alert alert-danger">
                                    There is another <b>TEST</b> scheduled the same day!
                                </p>
                                <?php
                            }
                            // Continue by here
                            $new = mysqli_query($server,"INSERT INTO `tests` 
                                (`test_id`, `training`, `test_name`, `question_numbers`, `test_start`, `test_status`) 
                                VALUES (NULL, '$acting_professional_training', '$testname', '$question_num', '$fulltime', 'Pending')
                            ");
                            if (!$new) {
                                ?>
                                <p class="alert alert-danger">
                                    Saving the test failed!
                                </p>
                                <?php
                            }
                            else {
                                ?>
                                <p class="alert alert-success">
                                    The test have been save successfully. Let's wait for Admin's Approval.
                                </p>
                                <?php
                            }
                        }
                    }
                ?>
                <p>
                    Test name
                </p>
                <p>
                    <input type="text" name="tn" placeholder="Type..." class="form-control" required>
                </p>
                <p>
                    Test schedule date
                </p>
                <p>
                    <input type="date" name="td" placeholder="Type..." class="form-control" required>
                </p>
                <p>
                    Test schedule time
                </p>
                <p>
                    <input type="time" name="tt" placeholder="Type..." class="form-control" required>
                </p>
                <p>
                    Test questions number
                </p>
                <p>
                    <input type="number" name="tqn" placeholder="Type..." class="form-control" required>
                </p>
                <p>
                    <button type="submit" name="save_test" class="btn btn-success">
                        <i class="fa fa-save"></i>
                        Save
                    </button>
                </p>
            </form>
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
