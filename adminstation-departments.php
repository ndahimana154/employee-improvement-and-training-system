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
            <div class="col-md-10">
                <div class="d-flex">
                    <!-- <a href="" class="btn btn-success">
                        <i class="fa fa-arrow-left"></i>
                    </a> -->
                    <h2>
                        <a href="administration-employees.php" class="btn btn-primary">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        Departments List
                    </h2>
                </div>
                <div class="p-3">
                    <a href="administrator-new-department.php" class="btn btn-success">
                        <i class="fa fa-plus"></i>
                        new department
                    </a>
                </div>
                <?php
                    if (isset($_GET['delete_depart'])) {
                        $delete_depart = $_GET['delete_depart'];
                        // Check if exists
                        $check = mysqli_query($server,"SELECT * from departments
                            WHERE depart_id = '$delete_depart'
                            AND depart_status = 'Active'
                        ");
                        if (mysqli_num_rows($check) !=1) {
                            ?>
                            <p class="m-3 alert alert-danger">
                                Department doesn't appear on the active list
                            </p>
                            <?php
                        }
                        else {
                            // Update
                            $update_delete = mysqli_query($server,"UPDATE departments 
                                SET depart_status = 'Inactive'
                                WHERE depart_id = '$delete_depart'
                            ");
                            if (!$update_delete) {
                                ?>
                                <p class="m-3 alert alert-danger">
                                    Department failed to be deleted
                                </p>
                                <?php
                            }
                            else {
                                ?>
                                <p class="m-3 alert alert-success">
                                    Deleting the department succed!
                                </p>
                                <?php
                            }
                        }
                    }

                ?>
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <td>
                                #
                            </th>
                            <th>
                                Department name
                            </th>
                            <th>
                                Employees number
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $get_emp = mysqli_query($server,"SELECT * from departments
                                WHERE depart_status = 'Active'
                                ORDER BY depart_name ASC    
                            ");
                            if (mysqli_num_rows($get_emp) < 1) {
                                ?>
                                <tr>
                                    <td colspan="100">
                                        no values found!
                                    </td>
                                </tr>
                                <?php
                            }
                            $count=1;
                            while ($data_emp = mysqli_fetch_array($get_emp)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $count++; ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $data_emp['depart_name'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $depart_id = $data_emp['depart_id'];
                                            // Get the employees num
                                            $get_emp_num = mysqli_query($server,"SELECT * from
                                                users WHERE
                                                department = '$depart_id'
                                            ");
                                            echo mysqli_num_rows($get_emp_num);
                                        ?>
                                    </td>
                                    <td>
                                        <a href="administrator-edit-department.php?edit-department=<?php echo $data_emp['depart_id'] ?>">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="?delete_depart=<?php echo $data_emp['depart_id'] ?>">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
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

