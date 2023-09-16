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
                <h3>
                    <a href="administration-trainings.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                    CERTIFICAES REQUESTS
                </h3>
                <div class="">
                    <?php
                        if (isset($_GET['confirm-request'])) {
                            $request_id = $_GET['confirm-request'];
                            // Check if the erequest if on the pending list
                            $check_request_exists = mysqli_query($server,"SELECT * from
                                employees_request_certificates
                                WHERE request_id = '$request_id'
                                AND request_status = 'Pending'
                            ");
                            if (mysqli_num_rows($check_request_exists) < 1) {
                                ?>
                                <p class="alert alert-danger">
                                    THe certificate is not on request list.
                                </p>
                                <?php
                            }
                            else {
                                $data_request_exists = mysqli_fetch_array($check_request_exists);
                                $employee_request = $data_request_exists['employee'];
                                $insert_the_certificate = mysqli_query($server,"INSERT into employees_certificate
                                    VALUES(null,$request_id,$employee_request,$acting_admin_id,current_timestamp())
                                ");
                                if (!$insert_the_certificate) {
                                    ?>
                                    <p class="alert alert-danger">
                                        Saving the certificate failed.
                                    </p>
                                    <?php
                                }
                                else {
                                    $update_status = mysqli_query($server,"UPDATE
                                        employees_request_certificates
                                        SET request_status = 'Approved'
                                        WHERE request_id = '$request_id'
                                    ");
                                    ?>
                                    <p class="alert alert-success">
                                        The certificate is saved successfully.
                                    </p>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>
                                #
                            </th>
                            <th>
                                Request date
                            </th>
                            <th>
                                Training topic
                            </th>
                            <th>
                                Employee names
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Actions
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $get_cerff = mysqli_query($server,"SELECT * from 
                                employees_request_certificates, trainings, users
                                WHERE
                                employees_request_certificates.employee = users.user_id
                                AND employees_request_certificates.training = trainings.training_id
                                ORDER BY request_date ASC
                            ");
                            if (mysqli_num_rows($get_cerff) < 1) {
                                ?>
                                <tr>
                                    <td colspan="100">
                                        No values found!
                                    </td>
                                </tr>
                                <?php
                            }
                            $count = 1;
                            while ($data_certics= mysqli_fetch_array($get_cerff)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                            echo $count++;
                                        ?>    
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_certics['request_date'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_certics['training_topic'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_certics['user_fn']." ".$data_certics['user_ln'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_certics['request_status'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if ($data_certics['request_status'] == 'Pending') {
                                                ?>
                                                <a href="?confirm-request=<?php echo $data_certics['request_id'] ?>" title="Confirm the training" class="btn btn-success">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
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
