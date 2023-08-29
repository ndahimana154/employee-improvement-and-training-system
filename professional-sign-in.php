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
            <h1 class="mb-4 text-center">
                Sign in as Professional
            </h1>
            <?php
                if (isset($_POST['logBTN'])) {
                    $email = $_POST['email'];
                    $uniqueid = $_POST['uniqueid'];
                    // CHeck if the email exists
                    $check_email_exists = mysqli_query($server,"SELECT * from professionals
                        WHERE professional_email = '$email'
                    ");
                    if (mysqli_num_rows($check_email_exists) !=1) {
                        ?>
                        <p class="alert alert-danger">
                            Email is not found!
                        </p>
                        <?php
                    }
                    else {
                        $data_email_exists = mysqli_fetch_array($check_email_exists);
                        $professional_id = $data_email_exists['professional_id'];
                        // Check if the unique id exists
                        $check_unique_id = mysqli_query($server,"SELECT * from training_professionals
                            WHERE
                            professional = '$professional_id'
                            AND unique_id = '$uniqueid'
                        ");
                        if (mysqli_num_rows($check_unique_id) != 1) {
                            ?>
                            <p class="alert alert-danger">
                                Unique ID doesn't match with any training.
                            </p>
                            <?php
                        }
                        else {
                            $data_unique_id = mysqli_fetch_array($check_unique_id);
                            $_SESSION['unique_id'] = $uniqueid;
                            $_SESSION['profe_id'] = $professional_id;
                            header("location: professional-home.php?welcome");
                        }
                    }
                    
                }            
            ?>
            <div class="form-group">
                <label for="usern">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Type...">
            </div>
            <div class="form-group">
                <label for="passw">Unique ID</label>
                <input type="password" class="form-control" name="uniqueid" placeholder="Type...">
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
