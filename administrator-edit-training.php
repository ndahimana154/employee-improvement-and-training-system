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
                <?php
                    if (!$_GET['training_id']) {
                        ?>
                        <p class="alert alert-danger">
                            No training sent to server.
                        </p>
                        <?php
                    }
                    else {
                        $training = $_GET['training_id'];
                        $checktraing_exists = mysqli_query($server,"SELECT * from trainings WHERE training_id ='$training'");
                        if (mysqli_num_rows($checktraing_exists) != 1) {
                            ?>
                            <p class="alert alert-danger">
                                Training doesn't exist.
                            </p>
                            <?php
                        }
                        else {
                            $data_training_exists = mysqli_fetch_array($checktraing_exists);
                            $training_topic = $data_training_exists['training_topic'];
                            ?>
                            <div class="row p-2">
                                <a href="administration-trainings.php" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                                <h2 class="ml-2">Edit training</h2>
                            </div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <?php
                                    if(isset($_POST["save_trng"])) {
                                        $training_id = $_POST['training'];
                                        $topic = $_POST['topic'];
                                        $today = date("Y-m-d");
                                        $end = $_POST['end'];
                                        $depart = $_POST['depart'];
                                        $description = $_POST['descri'];
                                        $training_status = "Progress";
                                        if ( $today <= $end) {
                                            $training_status = "Progress";
                                        }
                                        elseif ($today > $end) {
                                            $training_status = "Ended";
                                        }
                                        $checktopic =mysqli_query($server,"SELECT * from trainings WHERE training_id='$training_id'");
                                        // Check the errors
                                        if ($depart=='Select department') {
                                            ?>
                                            <p class="alert alert-danger">
                                                Please select department
                                            </p>
                                            <?php
                                        }
                                        elseif (mysqli_num_rows($checktopic) != 1) {
                                            ?>
                                            <p class="alert alert-danger">
                                                The topic doesn't exist
                                            </p>
                                            <?php
                                        }
                                        elseif ($end < $today) {
                                            ?>
                                            <p class="alert alert-danger">
                                                The end date can't be past.
                                            </p>
                                            <?php
                                        }
                                        elseif ($end < $today) {
                                            ?>
                                            <p class="alert alert-danger">
                                                The end date can't be less than current date.
                                            </p>
                                            <?php
                                        }
                                       
                                        else {
                                            $update = mysqli_query($server,"UPDATE trainings
                                                SET
                                                training_topic = '$topic'
                                                ,training_description = '$description'
                                                , training_end = '$end'
                                                , training_depart = '$depart'
                                                , training_status = '$training_status'
                                                WHERE training_id = '$training_id'
                                            ");
                                            if (!$update) {
                                                ?>
                                                <p class="alert alert-danger">
                                                    Updating training failed.
                                                </p>
                                                <?php
                                            }
                                            else {
                                                ?>
                                                <p class="alert alert-success">
                                                    Training is updated successfully.
                                                </p>
                                                <?php
                                            }

                                        }
                                    }
                                ?>
                                <div class="form-group">
                                    <label for="content">Training topic:</label>
                                    <input type="text" value="<?php echo $training; ?>" class="form-control" name="training" hidden>
                                    <input type="text" name="topic" class="form-control" value="<?php echo $training_topic; ?>">
                                </div>
                                <p>
                                    Training description
                                </p>
                                <p>
                                    <textarea name="descri" placeholder="Type..." rows="6" class="form-control"><?php echo $data_training_exists['training_description']; ?></textarea>
                                </p>
                                <p>
                                    Training enddate
                                </p>
                                <p>
                                    <input type="date" name="end" placeholder="Type..." value="<?php echo $data_training_exists['training_end']; ?>" class="form-control">
                                </p>
                                <p>
                                    Training department
                                </p>
                                <p>
                                    <select name="depart" id="" class="form-control">
                                        <?php 
                                            $depart_ment= $data_training_exists['training_depart']; 
                                            $get_depart_inf = mysqli_fetch_array(mysqli_query($server,"SELECT * from
                                                departments WHERE
                                                depart_id = '$depart_ment'
                                            "));
                                        ?>
                                        <option value="<?php echo $depart_ment ?>">
                                            <?php echo $get_depart_inf['depart_name']; ?>
                                        </option>
                                        <?php
                                            $get_departs = mysqli_query($server,"SELECT * from 
                                                departments WHERE depart_id != '$depart_ment'
                                                ORDER BY depart_name ASC");
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
                                    <button type="submit" name="save_trng" class="btn btn-success">
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
