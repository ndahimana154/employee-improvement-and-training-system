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
<body>
    <!-- Header -->
    <?php
        include("php/out-header.php");
    ?>
    <div class="container login-container">
        <form action="" method="post">
            <h1 class="mb-4 text-center">Create your account</h1>
            <?php
                if (isset($_POST['check_em_nid'])) {
                    $userEmail = $_POST['em'];
                    $userNID = $_POST['passw'];
                    
                    $check_userAcc = mysqli_query($server,"SELECT * from users WHERE user_nid='$userNID' AND user_email='$userEmail'
                    ");
                    
                    if (mysqli_num_rows($check_userAcc) !=1) {
                        ?>
                        <p class="alert alert-danger">
                            No user with these credentials.
                        </p>
                        <?php
                    }
                    else {
                        $check_userAccState = mysqli_query($server,"SELECT * from users WHERE user_nid='$userNID' AND user_email='$userEmail'
                            AND user_state='No account yet'
                        ");
                        if (mysqli_num_rows($check_userAccState) !=1) {
                            ?>
                            <p class="alert alert alert-danger">
                                Account already exists.
                            </p>
                            <?php
                        }
                        else {
                            $data_useAccstate = mysqli_fetch_array($check_userAccState);
                            $user_id = $data_useAccstate['user_id'];
                            $user_email= $data_useAccstate['user_email'];
                            ?>
                            <p class="alert alert-success">
                                The account is matching now.
                                Click <a href="user-sign-up-proceed.php?user_id=<?php echo $user_id; ?>&email=<?php echo $user_email; ?>">proceed</a> to setup your account.
                            </p>
                            <?php
                        }
                    }
                }
            ?>

            <div class="form-group">
                <label for="usern">User email</label>
                <input type="email" class="form-control" name="em" placeholder="Type..." required>
            </div>
            <div class="form-group">
                <label for="passw">User national id</label>
                <input type="text" class="form-control" id="nid" name="passw" placeholder="Type..." required>
            </div>
            <button type="submit" class="btn btn-primary" name="check_em_nid">
                <i class="fa fa-check"></i> Proceed
            </button>
        </form>
    </div>

    <!-- JavaScript libraries and scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
