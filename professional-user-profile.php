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
            <h2>
                Professional Profile
            </h2>
            </div>
            <form action="" method="post" class="p-2">
                <div class="d-flex">
                    <div class="form-group m-2">
                        <p>
                            Firstname
                        </p>
                        <p>
                            <input type="text" name="fn" placeholder="Type..." value="<?php echo $acting_professional_fn; ?>" class="form-control" required readonly>
                        </p>
                    </div>
                    <div class="form-group m-2">
                        <p>
                            Lastname
                        </p>
                        <p>
                            <input type="text" name="ln" placeholder="Type..." value="<?php echo $acting_professional_ln; ?>" class="form-control" required readonly>
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group m-2">
                        <p>
                            Phone number
                        </p>
                        <p>
                            <input type="number" name="ph" placeholder="Type..." value="<?php echo $acting_professional_phone; ?>" class="form-control" required readonly>
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group m-2">
                        <p>
                            Email
                        </p>
                        <p>
                            <input type="email" name="em" placeholder="Type..." value="<?php echo $acting_professional_email; ?>" class="form-control" required readonly>
                        </p>
                    </div>
                </div>
                
            </form>
            <h4>
                Change unique ID
            </h4>
            <form action="" method="post">
                <?php
                    if (isset($_POST['edit_profile'])) {
                        $oldpassword = $_POST['oldpas'];
                        $newpassword = $_POST['newpa'];
                        $retypepassw = $_POST['retype'];
                        // Check if old pass
                       $check_old_key = mysqli_query($server,"SELECT * from training_professionals
                            WHERE unique_id = '$oldpassword'
                            AND professional = '$acting_professional_id'
                       ");
                       if (mysqli_num_rows($check_old_key) !=1) {
                            ?>
                            <p class="alert alert-danger">
                                Old key is not matching.
                            </p>
                            <?php
                       }
                       elseif ($retypepassw != $newpassword) {
                            ?>
                            <p class="alert alert-danger">
                                The new keys are not matching.
                            </p>
                            <?php
                       }
                       else {
                            $update_password = mysqli_query($server,"UPDATE training_professionals
                                SET unique_id = '$newpassword'
                                WHERE professional = '$acting_professional_id'
                                AND training = '$acting_professional_training'
                            ");
                            if (!$update_password) {
                                ?>
                                <p class="alert alert-danger">
                                    Changing unique Key failed.
                                </p>
                                <?php
                            }
                            else {
                                session_destroy();
                                ?>
                                <p class="alert alert-success">
                                    Unique ID is changed successfully.
                                </p>
                                <?php
                            }
                       }
                    }
                ?>
                <div class="d-flex">
                    <div class="form-group m-2">
                        <p>
                            Old Unique ID
                        </p>
                        <p>
                            <input type="password" name="oldpas" placeholder="Type..." class="form-control" required>
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group m-2">
                        <p>
                            New Unique ID
                        </p>
                        <p>
                            <input type="password" name="newpa" placeholder="Type..." class="form-control" required>
                        </p>
                    </div>
                    <div class="form-group m-2">
                        <p>
                            Repeat Unique ID
                        </p>
                        <p>
                            <input type="password" name="retype" placeholder="Type..." class="form-control" required>
                        </p>
                    </div>
                </div>
                <div class="m-2">
                    <button type="submit" name="edit_profile" class="btn btn-success">
                        <i class="fa fa-save"></i>
                        Save
                    </button>
                </div> 
            </form>
        </div>
    </div>
    <!-- Footer -->
    <?php
        include("php/footer.php");
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
