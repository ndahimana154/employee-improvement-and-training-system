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

    <div class="">
        <div class="row">
            <!-- Left navigation links -->
            <?php
                include("php/administration-left-links.php");
            ?>
            <!-- Dashboard Content -->
            <div class="col-md-8">
                <div class="d-flex">
                    <!-- <a href="" class="btn btn-success">
                        <i class="fa fa-arrow-left"></i>
                    </a> -->
                    <h2>
                        New Professional
                    </h2>
                </div>
                <form action="" method="post" class="p-2">
                    <?php
                        if (isset($_POST['save_emp'])) {
                            $firstname = $_POST['fn'];
                            $lastname = $_POST['ln'];
                            $email = $_POST['em'];
                            $phone = $_POST['ph'];
                            $training = $_POST['training'];

                            // Generate a unique ID
                            function generateEncryptedUniqueID() {
                                $timestamp = time(); // Get the current timestamp
                                $randomNumber = mt_rand(1000, 9999); // Generate a random number between 1000 and 9999
                                $combinedValue = $timestamp . $randomNumber; // Combine timestamp and random number
                                
                                // Encrypt the combined value using MD5
                                $encryptedValue = md5($combinedValue);
                                
                                return $encryptedValue;
                            }
                            
                            // Example usage
                            $encryptedID = generateEncryptedUniqueID();

                            // Generate a random initialization vector (IV)
                            // $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

                            // Encrypt the data using AES-256-CBC encryption
                            // $encryptedNID = openssl_encrypt($nid, 'aes-256-cbc', 'your_encryption_key', 0, $iv);

                            // Store the encrypted data and IV securely, such as in a database
                            // Make sure to keep the IV secret and associated with the encrypted data
                            $check_email = mysqli_query($server,"SELECT * from professionals
                                WHERE
                                professional_email ='$email'
                            ");
                            if ($training =='Select training') {
                                ?>
                                <p class="alert alert-danger">
                                    Please select a training
                                </p>
                                <?php
                            }
                            elseif (mysqli_num_rows($check_email) == 1) {
                                ?>
                                <p class="alert alert-danger">
                                    Email address already taken.
                                </p>
                                <?php
                            }
                            else {
                                // Also check phone
                                $check_phone = mysqli_query($server,"SELECT * from professionals
                                    WHERE
                                    professional_phone ='$phone'
                                ");
                                if (mysqli_num_rows($check_phone) ==1) {
                                    ?>
                                    <p class="alert alert-danger">
                                        Phone number already taken.
                                    </p>
                                    <?php
                                }
                                else {
                                    // Save the professional
                                    $save = mysqli_query($server,"INSERT into professionals
                                        VALUES(null,'$firstname','$lastname','$email','$phone','Offline')
                                    ");
                                    if (!$save) {
                                        ?>
                                        <p class="alert alert-danger">
                                            Saving professional has failed.
                                        </p>
                                        <?php
                                    }
                                    else {
                                        $check_training_exists =mysqli_query($server,"SELECT * from trainings
                                            WHERE 
                                            training_id = '$training'
                                        ");
                                        if (mysqli_num_rows($check_training_exists) !=1) {
                                            ?>
                                            <p class="alert alert-danger">
                                                The professional is saved! But the training is not found.
                                            </p>
                                            <?php
                                        }
                                        else {
                                            $get_professional_info = mysqli_fetch_array(mysqli_query($server,"SELECT * from
                                                professionals WHERE
                                                professional_email = '$email'
                                                AND professional_phone = '$phone'
                                            "));
                                            $professional_id = $get_professional_info['professional_id'];
                                            $save_professional_training =mysqli_query($server,"INSERT into training_professionals 
                                                VALUES(null,'$training','$professional_id','$encryptedID','Progress')
                                            ");
                                            if (!$save_professional_training) {
                                                ?>
                                                <p class="alert alert-danger">
                                                    Assigning Professional to training failed.
                                                </p>
                                                <?php
                                            }
                                            else {
                                                $data_check_trainings = mysqli_fetch_array($check_training_exists);
                                                ?>
                                                <p class="alert alert-success">
                                                    Professional is save and assigned to training <b>("<?php echo $data_check_trainings['training_topic']; ?>")</b> successfully
                                                </p>
                                                <?php
                                            }
                                        }
                                    }
                                }
                            }

                            
                        }
                    ?>
                    <p>
                        Firstname
                    </p>
                    <p>
                        <input type="text" name="fn" placeholder="Type..." class="form-control">
                    </p>
                    <p>
                        Lastname
                    </p>
                    <p>
                        <input type="text" name="ln" placeholder="Type..." class="form-control">
                    </p>
                    <p>
                        Email
                    </p>
                    <p>
                        <input type="email" name="em" placeholder="Type..." class="form-control">
                    </p>
                    <p>
                        Phone number
                    </p>
                    <p>
                        <input type="number" name="ph" placeholder="Type..." class="form-control">
                    </p>
                    <p>
                        Training
                    </p>
                    <p>
                        <select name="training" id="" class="form-control">
                            <option value="Select training">
                                Select training
                            </option>
                            <?php
                                $get_trainings= mysqli_query($server,"SELECT * from trainings 
                                    WHERE training_status='Progress'
                                    ORDER BY training_topic ASC
                                    ");
                                if (mysqli_num_rows($get_trainings) < 1) {
                                    ?>
                                    <option value="Select training">
                                        No values found.
                                    </option>
                                    <?php
                                }
                                while($data_tranings = mysqli_fetch_array($get_trainings)) {
                                    ?>
                                    <option value="<?php echo $data_tranings['training_id']; ?>">
                                        <?php echo $data_tranings['training_topic']; ?>
                                    </option>
                                    <?php
                                }
                            ?>
                        </select>
                    </p>
                    <p>
                        <button type="submit" name="save_emp" class="btn btn-success">
                            <i class="fa fa-save"></i>
                            Save
                        </button>
                    </p>
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

