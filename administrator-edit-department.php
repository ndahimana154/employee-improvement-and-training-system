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
                        <a href="adminstation-departments.php" class="btn btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        New Department
                    </h2>
                </div>
                <?php
                    if (!isset($_GET['edit-department'])) {
                        ?>
                        <p class="m-2 alert alert-danger">
                            No department sent to server!
                        </p>
                        <?php
                    }
                    else {
                        $edit_departt = $_GET['edit-department'];
                        // Check if department exists
                        $check_depart_exists = mysqli_query($server,"SELECT * from departments WHERE
                            depart_id = '$edit_departt'
                            AND depart_status = 'Active'
                        ");
                        if (mysqli_num_rows($check_depart_exists) < 1) {
                            ?>
                            <p class="m-2 alert alert-danger">
                                Department doesn't eixsts on the list.
                            </p>
                            <?php
                        }
                        else {
                            $data_check_departs = mysqli_fetch_array($check_depart_exists);
                            ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <?php
                                    if (isset($_POST['save_dep'])) {
                                        $deprt_name = $_POST['dep_name'];
                                        // Check if the departname already exists 
                                        $check_deprt_exists = mysqli_query($server,"SELECT * from departments
                                            WHERE depart_name = '$deprt_name'
                                        ");
                                        if (mysqli_num_rows($check_deprt_exists) > 0) {
                                            ?>
                                            <p class="m-3 p-3 alert alert-danger">
                                                Department already exists
                                            </p>
                                            <?php
                                        }
                                        else {
                                            // Save department
                                            $save_depart = mysqli_query($server,"UPDATE
                                                departments SET
                                                depart_name = '$deprt_name'
                                                -- AND depart_status = ''
                                                WHERE depart_id = '$edit_departt'
                                            ");
                                            if(!$save_depart) {
                                                ?>
                                                <p class="m-3 alert alert-danger">
                                                    Saving department failed!
                                                </p>
                                                <?php
                                            }
                                            else {
                                                ?>
                                                <p class="m-3 alert alert-success">
                                                    Department is saved successfully.
                                                </p>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                                <p>
                                    Department name
                                </p>
                                <p>
                                    <input type="text" name="dep_name" value="<?php echo $data_check_departs['depart_name']; ?>" placeholder="Type..." class="form-control"  required>
                                </p>
                                <p>
                                    <button type="submit" name="save_dep" class="btn btn-success">
                                        <i class="fa fa-save"></i>
                                        Save
                                    </button>
                                </p>
                            </form>
                            <?php
                        }
                    }
                ?>
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

