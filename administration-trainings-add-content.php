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
                            <h2>Upload training content</h2>
                            <form action="" method="post" enctype="multipart/form-data">
                                <?php
                                    if(isset($_POST["submit"])) {
                                        $training = $_POST['training'];
                                        $content = mysqli_real_escape_string($server,$_POST['content']);
                                        $content_type = $_POST['c_type'];
                                        $pdfFileType = strtolower(pathinfo($_FILES["pdfFile"]["name"], PATHINFO_EXTENSION));
                                        $targetDir = "trainings/contents/";
                                        $targetFile = $targetDir .  $content ." - " .  $training_topic . '.' . $pdfFileType;

                                        // Check if the uploaded file is a video
                                        $allowedExtensions = array("mp4", "avi", "mkv","pdf");
                                        if ($content_type == 'Select type..') {
                                            ?>
                                            <p class="alert alert-danger">
                                                Please select content type.
                                            </p>
                                            <?php
                                        }
                                        elseif (!in_array($pdfFileType, $allowedExtensions)) {
                                            ?>
                                            <p class="alert alert-danger">
                                                Only video files are allowed and PDF file allowed.
                                            </p>
                                            <?php
                                        } else {
                                            if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {
                                                $new= mysqli_query($server,"INSERT into training_contents VALUES(null,'$training','$content','$content_type','$targetFile')");
                                                ?>
                                                <p class="alert alert-success">
                                                    Training content is added successfully.
                                                </p>
                                                <?php
                                            } else {
                                                ?>
                                                <p class="alert alert-danger">
                                                    Adding content failed.
                                                </p>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                                <div class="form-group">
                                    <label for="content">Training topic:</label>
                                    <input type="text" value="<?php echo $training; ?>" class="form-control" id="content" name="training" hidden>
                                    <input type="text" class="form-control" value="<?php echo $training_topic; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content Name:</label>
                                    <input type="text" class="form-control" id="content" name="content" placeholder="Type..." required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content Type:</label>
                                    <select name="c_type" id="" class="form-control">
                                        <option value="Select type..">
                                            Select type..
                                        </option>
                                        <option value="Video">
                                            Video
                                        </option>
                                        <option value="Document summary">
                                            Document summary
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pdfFile">Content file (Only video files):</label>
                                    <input type="file" class="form-control-file" id="pdfFile" name="pdfFile" accept=".mp4,.avi,.mkv" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Upload</button>
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
