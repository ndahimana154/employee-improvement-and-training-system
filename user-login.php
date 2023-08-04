<?php
    include("php/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web\css\all.css">
    <title>User Login</title>
</head>
<body>
    <form action="" method="post">
        <h1>
            Sign into your account
        </h1>
        <?php
            if (isset($_POST['logBTN'])) {
                $username = $_POST['usern'];
                $password = $_POST['passw'];
                $checkusername = mysqli_query($server,"SELECT * from users 
                    WHERE user_name='$username'
                ");
                if (mysqli_num_rows($checkusername) != 1) {
                    ?>
                    <p>
                        Username doesn't exists
                    </p>
                    <?php
                }
                else {
                    $checkUsnnpass = mysqli_query($server,"SELECT * from users 
                        WHERE user_name = '$username' AND user_pass = '$password'
                    ");
                    if (mysqli_num_rows($checkUsnnpass) != 1) {
                        ?>
                        <p>
                            Username and password doesn't match
                        </p>
                        <?php
                    }
                    else {
                        // Get he user Type
                        $getusertype = mysqli_fetch_array($checkUsnnpass);
                        $user_type = $getusertype['user_type'];
                        if ($user_type== 'Adminstration') {
                            header("location: adminstration-welcome.php");
                        }
                    }
                }
            }
        ?>
        
        <p>
            Username
        </p>
        <p>
            <input type="text" name="usern" placeholder="Type..." name="">
        </p>
        <p>
            Password
        </p>
        <p>
            <input type="text" name="passw" placeholder="Type..." name="">
        </p>
        <p>
            <button type="submit" name="logBTN">
                <i class="fa fa-sign-in-alt"></i>
                Login
            </button>
        </p>
    </form>
</body>
</html>