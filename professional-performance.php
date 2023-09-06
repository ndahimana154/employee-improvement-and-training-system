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
            TRAINING PERFORMANCE
        </h2>
    <table class="table table-hover table-responsive">
        <thead>
            <tr>
                <th>
                    Topic:
                </th>
                <th colspan="3">
                    <?php echo $acting_training_topic ?>
                </th>
            </tr>
            <tr>
                <th>
                    Total contents:
                </th>
                <th colspan="10">
                    <?php echo mysqli_num_rows($actingtraining_contents); ?>
                </th>
            </tr>
            <tr>
                <th>
                    Total employees:
                </th>
                <th colspan="10">
                    <?php echo mysqli_num_rows($acting_employees_num); ?>
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
                $count =1;
                if (mysqli_num_rows($acting_employees_num) < 1) {
                    ?>
                    <tr>
                        <td colspan="100">
                            No values found!
                        </td>
                    </tr>
                    <?php
                }
                while ($data_training_employees = mysqli_fetch_array($acting_employees_num)) {
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
                                $employeee_id = $data_training_employees['user_id'];
                                $total_contents = mysqli_num_rows($actingtraining_contents);
                                // $employeee_id = $data_training_employees['user_id'];
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
                                if (mysqli_num_rows($actingtraining_contents) == 0) {
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
