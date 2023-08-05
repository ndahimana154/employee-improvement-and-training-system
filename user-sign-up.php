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
        <form action="" method="post">
            <h1 class="mb-4 text-center">Create your account</h1>
            <?php
                if (isset($_POST['check_em_nid'])) {
                    $email = $_POST['em'];
                    $nid = $_POST['nid'];
                    $check_exist = mysqli_query($server,"SELECT * from users WHERE user_email = '$email' AND user_nid='$nid'");
                    if (mysqli_num_rows($check_exist) !=1) {
                        ?>
                        <p class="alert alert-danger">
                            User doesn't exists
                        </p>
                        <?php
                    }
                    else {
                        ?>
                        
                        <?php
                    }
                }            
            ?>
            <div class="form-group">
                <label for="usern">User email</label>
                <input type="email" class="form-control" id="em" name="usern" placeholder="Type...">
            </div>
            <div class="form-group">
                <label for="passw">User national id</label>
                <input type="number" class="form-control" id="nid" name="passw" placeholder="Type...">
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
