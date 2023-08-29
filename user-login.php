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
    <link rel="stylesheet" href="bootstrap-5.0.2-dist\css\bootstrap.css">
    <!-- Link Font-awesome icons -->
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web\css\all.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
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
    <!-- Header -->
    <?php
        include("php/out-header.php");
    ?>
    <div class="container login-container">
        <form action="" method="post">
            <h1 class="mb-4 text-center">Sign into your account</h1>
            <?php
                if (isset($_POST['logBTN'])) {
                    $username = $_POST['usern'];
                    $password = $_POST['passw'];
                    $password = md5($password);
                    $checkusername = mysqli_query($server, "SELECT * from users 
                        WHERE user_name='$username'
                    ");
                    if (mysqli_num_rows($checkusername) != 1) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Username doesn't exists
                        </div>
                        <?php
                    } else {
                        $checkUsnnpass = mysqli_query($server, "SELECT * from users 
                            WHERE user_name = '$username' AND user_pass = '$password'
                        ");
                        if (mysqli_num_rows($checkUsnnpass) != 1) {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                Username and password doesn't match
                            </div>
                            <?php
                        } else {
                            // Get the user Type
                            $getusertype = mysqli_fetch_array($checkUsnnpass);
                            $user_type = $getusertype['user_type'];
                            $user_id = $getusertype['user_id'];
                            if ($user_type == 'Administration') {
                                $_SESSION['user_name'] = $username;
                                $_SESSION['user_type'] = $user_type;
                                $_SESSION['user_id'] = $user_id;
                                header("location: adminstration-home.php?welcome");
                            }
                            elseif ($user_type == 'Employee') {
                                $_SESSION['employee_username'] = $username;
                                $_SESSION['employee_type'] = $user_type;
                                $_SESSION['employee_id'] = $user_id;
                                header("location: employee-home.php?welcome");
                            }
                        }
                    }
                }            
            ?>
            <div class="form-group">
                <label for="usern">Username</label>
                <input type="text" class="form-control" id="usern" name="usern" placeholder="Type...">
            </div>
            <div class="form-group">
                <label for="passw">Password</label>
                <input type="password" class="form-control" id="passw" name="passw" placeholder="Type...">
            </div>
            <button type="submit" class="btn btn-primary" name="logBTN">
                <i class="fa fa-sign-in-alt"></i> Login
            </button>
        </form>
    </div>

    <!-- JavaScript libraries and scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
