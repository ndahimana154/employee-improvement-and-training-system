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
</head>
<body style="">
    <!-- Header -->
    <?php
        include("php/employee-header.php");
    ?>
    <!-- Display trainings -->
    <section class="bg-light">
    <div class="container">
        <div class="col-md-8">
            <h2>
                User Profile
            </h2>
            </div>
            <form action="" method="post" class="p-2">
                <div class="d-flex">
                    <div class="form-group m-2">
                        <p>
                            Firstname
                        </p>
                        <p>
                            <input type="text" name="fn" placeholder="Type..." value="<?php echo $acting_employee_fn; ?>" class="form-control" required readonly>
                        </p>
                    </div>
                    <div class="form-group m-2">
                        <p>
                            Lastname
                        </p>
                        <p>
                            <input type="text" name="ln" placeholder="Type..." value="<?php echo $acting_employee_ln; ?>" class="form-control" required readonly>
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group m-2">
                        <p>
                            Username
                        </p>
                        <p>
                            <input type="email" name="un" placeholder="Type..." value="<?php echo $acting_employee_usern; ?>" class="form-control" required readonly>
                        </p>
                    </div>
                    <div class="form-group m-2">
                        <p>
                            Phone number
                        </p>
                        <p>
                            <input type="number" name="ph" placeholder="Type..." value="<?php echo $acting_employee_phone; ?>" class="form-control" required readonly>
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group m-2">
                        <p>
                            Email
                        </p>
                        <p>
                            <input type="email" name="em" placeholder="Type..." value="<?php echo $acting_employee_email; ?>" class="form-control" required readonly>
                        </p>
                    </div>
                </div>
                
            </form>
            <h4>
                Change password
            </h4>
            <form action="" method="post">
                <?php
                    if (isset($_POST['edit_profile'])) {
                        $oldpassword = $_POST['oldpas'];
                        $oldpassword = md5($oldpassword);
                        $newpassword = $_POST['newpa'];
                        $newpassword = md5($newpassword);
                        $retypepassw = $_POST['retype'];
                        $retypepassw = md5($retypepassw);
                        // Check if old pass
                        $check_oldpass = mysqli_query($server,"SELECT * from
                            users WHERE user_id = '$acting_employee_id'
                            AND user_email = '$acting_employee_email'
                            AND user_pass = '$oldpassword'
                        ");
                        if (mysqli_num_rows($check_oldpass) != 1) {
                            ?>
                            <p class="alert alert-danger">
                                Old password is incorrect.
                            </p>
                            <?php
                        }
                        elseif ($newpassword != $retypepassw) {
                            ?>
                            <p class="alert alert-danger">
                                New password is not matching.
                            </p>
                            <?php
                        }
                        else {
                            // Update the password
                            $update_password = mysqli_query($server,"UPDATE users
                                set user_pass = '$newpassword'
                                WHERE user_id = '$acting_employee_id'
                                AND user_email = '$acting_employee_email'
                                AND user_pass = '$oldpassword'
                            ");
                            if (!$update_password) {
                                ?>
                                <p class="alert alert-danger">
                                    Password is not updated
                                </p>
                                <?php
                            }
                            else {
                                session_destroy();
                                ?>
                                <p class="alert alert-success">
                                    Password is changed succesfully.
                                </p>
                                <?php
                            }
                        }
                        
                    }
                ?>
                <div class="d-flex">
                    <div class="form-group m-2">
                        <p>
                            Old password
                        </p>
                        <p>
                            <input type="password" name="oldpas" placeholder="Type..." class="form-control" required>
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group m-2">
                        <p>
                            New password
                        </p>
                        <p>
                            <input type="password" name="newpa" placeholder="Type..." class="form-control" required>
                        </p>
                    </div>
                    <div class="form-group m-2">
                        <p>
                            Repeat password
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
</section>
    
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
    </style>
</body>
</html>
