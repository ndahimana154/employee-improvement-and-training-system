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
    <!-- Link Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Js Files -->
    <script src="js/employee-get-trainings-content.js"></script>
</head>
<body>
    <!-- Header -->
    <?php
        include("php/employee-header.php");
    ?>
    

    <!-- Display trainings -->
    <section class="">
        <div class="p-3" style="">
        <h2>
            <a href="employee-trainings-content.php?training=<?php echo $_GET['request']; ?>" class="btn btn-primary">
                <i class="fa fa-arrow-left"></i>
            </a>
            Request certificate
        </h2>
        <?php
            if (isset($_GET['request']) && isset($_GET['training'])) {
                $request_certificate = $_GET['request'];
                $check_request_certif = mysqli_query($server,"SELECT * from 
                    employees_request_certificates
                    WHERE 
                    employee='$acting_employee_id'
                    AND training = '$request_certificate'
                ");
                if (mysqli_num_rows($check_request_certif) > 0) {
                    ?>
                    <p class="alert alert-danger">
                        Certificate arleady requested!!
                    </p>
                    <?php
                }
                else {
                    $save_request = mysqli_query($server,"INSERT into 
                        employees_request_certificates 
                        VALUES(null,$acting_employee_id,$request_certificate,current_timestamp(),'Pending')
                    ");
                    if (!$save_request) {
                        ?>
                        <p class="alert alert-danger">
                            Saving the request failed!!
                        </p>
                        <?php
                    }
                    else {
                        ?>
                        <p class="alert alert-success">
                            Congratulations. the request is sent successfully.
                        </p>
                        <?php
                    }
                }
            }
            else {
                ?>
                <p class="alert alert-danger">
                    Nsdivi n
                </p>
                <?php
            }
        ?>
        </div>
</section>
    
    <!-- Footer -->
    <?php
        // include("php/footer.php");
    ?>
    
    <!-- Link Bootstrap JS -->
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
