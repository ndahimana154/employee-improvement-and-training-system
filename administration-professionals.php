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
            <div class="col-md-10">
                <div class="d-flex">
                    <!-- <a href="" class="btn btn-success">
                        <i class="fa fa-arrow-left"></i>
                    </a> -->
                    <h2>
                        Professionals list
                    </h2>
                </div>
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <td>
                                #
                            </th>
                            <th>
                                Firstname
                            </th>
                            <th>
                                Lastname
                            </th>
                            <th>
                                Email
                            </th>
                            
                            <th>
                                Phone
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
                            $get_pro = mysqli_query($server,"SELECT * from 
                                professionals 
                                ORDER BY 
                                professional_fn ASC,
                                professional_ln ASC,
                                professional_email ASC  
                            ");
                            $count=1;
                            if (mysqli_num_rows($get_pro) < 1) {
                                ?>
                                <tr>
                                    <td colpan="100">
                                        No values found!
                                    </td>
                                </tr>
                                <?php
                            }
                            while ($data_pro = mysqli_fetch_array($get_pro)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $count++; ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_pro['professional_fn'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_pro['professional_ln'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_pro['professional_email'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_pro['professional_phone'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_pro['professional_status'];
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-success">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
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

