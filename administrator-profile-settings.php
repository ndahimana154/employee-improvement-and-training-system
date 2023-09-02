<?php
    session_start();
    include('php/connection.php');

    // Check if the user is logged in and the user type is correct
    if (!isset($_SESSION['user_name'])) {
        header("location: user-login.php");
    } elseif ($_SESSION['user_type'] != 'Administration') {
        header("location: user-login.php");
    } else {
        include("php\administration-sessions.php");
    }
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
    <style>
        .fixed-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #f8f9fa;
            border-right: 1px solid #e9ecef;
            padding: 20px;
        }
        .dashboard-content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php include("php/administration-header.php"); ?>

        <div class="row p-2">
            <!-- Left navigation links -->
            <?php
                include("php/administration-left-links.php");
            ?>
            <!-- Dashboard Content -->
            <div class="col-md-10">
                <h2>
                    User Profile
                </h2>
                <form action="" method="post" class="p-2">
                    <?php
                        if (isset($_POST['save_profile'])) {
                            $firstname = mysqli_real_escape_string($server,$_POST['fn']);
                            $lastname = mysqli_real_escape_string($server,$_POST['ln']);
                            $username = mysqli_real_escape_string($server,$_POST['un']);
                            $email = mysqli_real_escape_string($server,$_POST['em']);
                            $phone = mysqli_real_escape_string($server,$_POST['ph']);
                            $training = $_POST['training'];

                            $check_userna = mysqli_query($server,"SELECT * from users WHERE
                                user_name = '$username'
                                AND  user_id = '$acting_admin_id'
                            ");
                            $check_email = mysqli_query($server,"SELECT * from users WHERE
                                user_email = '$email'
                            ");
                            $check_phone = mysqli_query($server,"SELECT * from users WHERE
                                user_phone = '$phone'
                            ");
                            if (mysqli_num_rows($check_userna) ) {
                                # code...
                            }

                            
                        }
                    ?>
                    <div class="d-flex">
                        <div class="form-group m-2">
                            <p>
                                Firstname
                            </p>
                            <p>
                                <input type="text" name="fn" placeholder="Type..." value="<?php echo $acting_fn ?>" class="form-control" required readonly>
                            </p>
                        </div>
                        <div class="form-group m-2">
                            <p>
                                Lastname
                            </p>
                            <p>
                                <input type="text" name="ln" placeholder="Type..." value="<?php echo $acting_ln ?>" class="form-control" required readonly>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group m-2">
                            <p>
                                Username
                            </p>
                            <p>
                                <input type="email" name="un" placeholder="Type..." value="<?php echo $acting_username ?>" class="form-control" required readonly>
                            </p>
                        </div>
                        <div class="form-group m-2">
                            <p>
                                Phone number
                            </p>
                            <p>
                                <input type="number" name="ph" placeholder="Type..." value="<?php echo $acting_userphone ?>" class="form-control" required readonly>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group m-2">
                            <p>
                                Email
                            </p>
                            <p>
                                <input type="email" name="em" placeholder="Type..." value="<?php echo $acting_email ?>" class="form-control" required readonly>
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
                                users WHERE user_id = '$acting_admin_id'
                                AND user_email = '$acting_email'
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
    </div>
    <!-- Include Bootstrap JS and your scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <style>
        .fixed-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #f8f9fa;
            border-right: 1px solid #e9ecef;
            padding: 20px;
        }
        .dashboard-content {
            margin-left: 250px;
            padding: 20px;
        }
        /* Adjust the min-height based on your design needs */
        .full-height {
            min-height: calc(100vh - 80px);
        }
    </style>
</body>
</html>

