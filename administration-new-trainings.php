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
                        New training
                    </h2>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <?php
                        if(isset($_POST["save_trng"])) {
                            $topic = $_POST['topic'];
                            $today = date("Y-m-d");
                            $strt = $_POST['start'];
                            $end = $_POST['end'];
                            $cover = $_FILES['coverimage']['name'];
                            $depart = $_POST['depart'];
                            $description = $_POST['descri'];
                            $checktopic =mysqli_query($server,"SELECT * from trainings WHERE training_topic='$topic'");

                            $targetDir = "trainings/covers/"; // Create a directory named "uploads" to store uploaded files
                            $targetFile = $targetDir . basename($_FILES["coverimage"]["name"]);
                            $uploadOk = 1;
                            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                            
                            if(isset($_POST["submit"])) {
                                $check = getimagesize($_FILES["coverimage"]["tmp_name"]);
                                if($check !== false) {
                                    $uploadOk = 1;
                                } else {
                                    $uploadOk = 0;
                                }
                            }

                            // Allow only certain file formats
                            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                                $uploadOk = 0;
                            }

                            // Check the errors
                            if ($depart=='Select department') {
                                ?>
                                <p class="alert alert-danger">
                                    Please select department
                                </p>
                                <?php
                            }
                            elseif (mysqli_num_rows($checktopic) >= 1) {
                                $uploadOk = 0;
                                ?>
                                <p class="alert alert-danger">
                                    The topic already exists
                                </p>
                                <?php
                            }
                            elseif ($strt < $today) {
                                $uploadOk = 0;
                                ?>
                                <p class="alert alert-danger">
                                    The start date can't be past.
                                </p>
                                <?php
                            }
                            elseif ($end < $today) {
                                $uploadOk = 0;
                                ?>
                                <p class="alert alert-danger">
                                    The end date can't be past.
                                </p>
                                <?php
                            }
                            elseif ($end < $strt) {
                                $uploadOk = 0;
                                ?>
                                <p class="alert alert-danger">
                                    The end date can't be less than start date.
                                </p>
                                <?php
                            }
                            elseif ($uploadOk == 0) {
                                ?>
                                <p class="alert alert-danger">
                                    Sorry, the topic is not created, due to unexpected error.
                                </p>
                                <?php
                            } 
                            else {
                                if (move_uploaded_file($_FILES["coverimage"]["tmp_name"], $targetFile)) {
                                    $new = mysqli_query($server,"INSERT into trainings VALUES(null,'$topic','$description','$strt','$end','$cover','$depart','Progress')");
                                    ?>
                                    <p class="alert alert-success">
                                        Training is created successfully.
                                    </p>
                                    <?php
                                } else {
                                    ?>
                                    <p class="alert alert-danger">
                                        Creating the training has failed.
                                    </p>
                                    <?php
                                }
                            }
                        }
                   ?>
                    <p>
                        Training topic
                    </p>
                    <p>
                        <input type="text" name="topic" placeholder="Type..." class="form-control">
                    </p>
                    <p>
                        Training description
                    </p>
                    <p>
                        <textarea name="descri" class="form-control"></textarea>
                    </p>
                    <p>
                        Training startdate
                    </p>
                    <p>
                        <input type="date" name="start" placeholder="Type..." class="form-control">
                    </p>
                    <p>
                        Training enddate
                    </p>
                    <p>
                        <input type="date" name="end" placeholder="Type..." class="form-control">
                    </p>
                    <p>
                        Training cover image
                    </p>
                    <p>
                        <input type="file" name="coverimage" placeholder="Type..." class="form-control">
                    </p>
                    <p>
                        Training department
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
                        <button type="submit" name="save_trng" class="btn btn-success">
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

