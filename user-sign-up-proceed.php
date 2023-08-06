<?php
    session_start();
    include("php/connection.php");
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
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
            margin-top: 100px;
            background-color: white;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php
        include("php/out-header.php");
    ?>
    <div class="container login-container">
            <h1 class="mb-4 text-center">Setup your account</h1>
            <?php
                if (!isset($_GET['user_id']) || !isset($_GET['email'])) {
                    ?>
                    <p class="alert alert-danger">
                        Invalid data.
                    </p>
                    <?php
                }
                else {
                    $user_id = $_GET['user_id'];
                    $user_email = $_GET['email'];
                    // CHeck if the email and user id are matching
                    $check_matching = mysqli_query($server,"SELECT * from users 
                        WHERE
                        user_id='$user_id' 
                        AND user_email='$user_email'
                    ");
                    if (mysqli_num_rows($check_matching) !=1) {
                        ?>
                        <p class="alert alert-danger">
                            Credentials not matching any account.
                        </p>
                        <?php
                    }
                    else {
                        $data_check_matching = mysqli_fetch_array($check_matching);
                        $depart= $data_check_matching['department'];
                        $get_depart = mysqli_fetch_array(mysqli_query($server,"SELECT * from departments WHERE depart_id = '$depart'"));
                        ?>
                        <form action="" method="post">
                            <?php
                                if (isset($_POST['save_account_info'])) {
                                    $saveuserid = $_POST['user_id'];
                                    $saveemail = $_POST['em'];
                                    $password = $_POST['pass'];
                                    $retype = $_POST['rtp'];
                                    $saveusername = $_POST['usern'];
                                    $checkusername = mysqli_query($server,"SELECT * from users WHERE user_name = '$saveusername'");
                                    if ($password != $retype) {
                                        ?>
                                        <p class="alert alert-danger">
                                            Passwords doesn't match
                                        </p>
                                        <?php
                                    }
                                    elseif (mysqli_num_rows($checkusername) > 0) {
                                        ?>
                                        <p class="alert alert-danger">
                                            Username already taken.
                                        </p>
                                        <?php
                                    }
                                    else {
                                        // Again check the account availability
                                        $check_ava = mysqli_query($server,"SELECT * from users WHERE user_id = '$saveuserid' AND user_email='$saveemail'");
                                        if (mysqli_num_rows($check_ava) !=1) {
                                            ?>
                                            <p class="alert alert-danger">
                                                Account doesn't exist.
                                            </p>
                                            <?php
                                        }
                                        else {
                                            // Check not set 
                                            $check_notset = mysqli_query($server,"SELECT * from users 
                                                WHERE 
                                                user_id = '$saveuserid' AND user_email='$saveemail'
                                                AND user_state='No account yet'
                                            ");
                                            if (mysqli_num_rows($check_notset) !=1) {
                                                ?>
                                                <p class="alert alert-danger">
                                                    Account already exists
                                                </p>
                                                <?php
                                            }
                                            else {
                                                $encrypted_password = md5($password);
                                                $update = mysqli_query($server,"UPDATE users SET
                                                    user_name='$saveusername',
                                                    user_type='Employee',
                                                    user_state='Working',
                                                    user_pass='$encrypted_password'
                                                    WHERE
                                                    user_id='$saveuserid'
                                                    AND user_email='$saveemail'
                                                ");
                                                if (!$update) {
                                                    ?>
                                                    <p class="alert alert-danger">
                                                        Creating account failed.
                                                    </p>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <p class="alert alert-success">
                                                        Account is created successfully. Click <a href="user-login.php">here</a> to login
                                                    </p>
                                                    <?php
                                                }
                                            }
            
                                        }
                                    }
                                }
                            ?>
                            <div class="form-group">
                                <label for="usern">Firstname</label>
                                <input type="text" class="form-control" value="<?php echo $data_check_matching['user_fn']; ?>" readonly>
                                <input type="text" class="form-control" name="user_id" value="<?php echo $data_check_matching['user_id']; ?>" hidden>
                                <input type="text" class="form-control" name="em" value="<?php echo $data_check_matching['user_email']; ?>" hidden>
                            </div>
                            <div class="form-group">
                                <label for="usern">Lastname</label>
                                <input type="text" class="form-control" name="" value="<?php echo $data_check_matching['user_ln']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="usern">Department</label>
                                <input type="text" class="form-control" name="" value="<?php echo $get_depart['depart_name']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="passw"><span class="text-danger">*</span> Username</label>
                                <input type="text" class="form-control" name="usern" placeholder="Type..." required>
                            </div>
                            <div class="form-group">
                                <label for="passw"><span class="text-danger">*</span> Password</label>
                                <input type="password" class="form-control" id="passw" name="pass" placeholder="Type..." required>
                            </div>
                            <div class="form-group">
                                <label for="passw"><span class="text-danger">*</span> Confirm password</label>
                                <input type="password" class="form-control" id="nid" name="rtp" placeholder="Type..." required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="save_account_info">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </form>
                        <?php
                    }
                }
            ?>            
    </div>

    <!-- JavaScript libraries and scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
