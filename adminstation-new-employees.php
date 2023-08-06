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
        <div class="row p-2">
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
                        New employees
                    </h2>
                </div>
                <form action="" method="post">
                    <?php
                        if (isset($_POST['save_emp'])) {
                            $firstname = $_POST['fn'];
                            $lastname = $_POST['ln'];
                            $email = $_POST['em'];
                            $nid = $_POST['nid'];
                            $phone = $_POST['ph'];
                            $depart = $_POST['depart'];
                            $nid = $_POST['nid'];

                            // Generate a random initialization vector (IV)
                            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

                            // Encrypt the data using AES-256-CBC encryption
                            $encryptedNID = openssl_encrypt($nid, 'aes-256-cbc', 'your_encryption_key', 0, $iv);

                            // Store the encrypted data and IV securely, such as in a database
                            // Make sure to keep the IV secret and associated with the encrypted data


                            $check_em_exist = mysqli_query($server,"SELECT * from users WHERE user_email = '$email'");
                            if ($depart=='Select department') {
                                ?>
                                <p class="alert alert-danger">
                                    Please select department
                                </p>
                                <?php
                            }
                            elseif (mysqli_num_rows($check_em_exist) > 0) {
                                ?>
                                <p class="alert alert-danger">
                                    User email already exists.
                                </p>
                                <?php
                            }
                            else {
                                $check_nid_exists = mysqli_query($server,"SELECT * from users WHERE user_nid='$encryptedNID'");
                                if (mysqli_num_rows($check_nid_exists) >0) {
                                    ?>
                                    <p class="alert alert-danger">
                                        User national id already exists.
                                    </p>
                                    <?php
                                }
                                else {
                                    $new = mysqli_query($server,"INSERT into users VALUES(null,'$encryptedNID','Not set Yet','$firstname','$lastname','$email','$phone','Not set Yet','Employee','$depart','No account yet')");
                                    if (!$new) {
                                        ?>
                                        <p class="alert alert-danger">
                                            Employee is not created.
                                        </p>
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <p class="alert alert-success">
                                            Employee is created successfully.
                                        </p>
                                        <?php
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
                        National Id
                    </p>
                    <p>
                        <input type="number" name="nid" placeholder="Type..." class="form-control">
                    </p>
                    <p>
                        Department
                    </p>
                    <p>
                        <select name="depart" id="" class="form-control">
                            <option value="Select department">
                                Select department
                            </option>
                            <?php
                                $get_departs = mysqli_query($server,"SELECT * from departments ORDER BY depart_name ASC");
                                if (mysqli_num_rows($get_departs) < 1) {
                                    ?>
                                    <option value="Select department">
                                        No values found.
                                    </option>
                                    <?php
                                }
                                while($data_departs = mysqli_fetch_array($get_departs)) {
                                    ?>
                                    <option value="<?php echo $data_departs['depart_id']; ?>">
                                        <?php echo $data_departs['depart_name'] ?>
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

