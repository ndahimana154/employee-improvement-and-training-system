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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="js\employee-print-certificate.js"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            text-align: center;
            background-color: #f0f0f0;
        }
        .certificate {
            border: 2px solid #3498db;
            border-radius: 10px;
            margin: auto;
            margin-top: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* background-image: url('images/Certificate-bg.jpg');  */
            /* Add your background image path */
            /* background-size: cover; */
            width: 297mm;
            /* height:  */
        }
        .bg {
            background: rgba(0, 0, 0, 0.3);
            padding-bottom: 20px;
            border-radius: 10px;
        }
        
        .logo img {
            max-width: 150px;
            height: auto;
        }
        /* h1, h2, h3 {
            color: #3498db;
        } */
        p.text-white {
            color: #fff;
        }
        h2.text-primary {
            color: #3498db;
        }
        h3.text-success {
            color: #27ae60;
        }
        p.text-success {
            color: #27ae60;
        }
        .checkmark {
            font-size: 40px;
            color: #e74c3c;
            border: 2px solid #e74c3c;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin: auto;
            background: #fff;
            line-height: 1.5;
        }
        @media print {
            .certificate {
                border: 2px solid #3498db;
                border-radius: 10px;
                margin: auto;
                margin-top: 40px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-image: url('images/Certificate-bg.jpg'); 
                /* Add your background image path */
                background-size: cover;
                width: 297mm;
                /* height:  */
            }
            .bg {
                background: rgba(0, 0, 0, 0.6);
                padding-bottom: 20px;
                border-radius: 10px;
            }
        }
    </style>
</head>
<body>
     <!-- Header -->
     <?php
        include("php/employee-header.php");
    ?>
    <h2 class="head">
        <?php
            if (isset($_GET['training'])) {
                ?>
                <a href="employee-trainings-content.php?training=<?php echo $_GET['training']; ?>" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <?php
            }
        ?>
        EMPLOYEE CERTIFICATE
    </h2>
    <?php
        if (isset($_GET['training'])) {
            $certi_training = $_GET['training'];
            // CHeck if the training have Certficate
            $check_tr_certificate = mysqli_query($server,"SELECT * from
                employees_certificate
                WHERE training = '$certi_training'
                AND employee = '$acting_employee_id'
            ");
            if (mysqli_num_rows($check_tr_certificate) < 1) {
                ?>
                <p class="m-3 p-3">
                    Training certificate is not found.
                </p>
                <?php
            }
            else {
                $data_tr_certificate = mysqli_fetch_array($check_tr_certificate);
                $get_training_inf = mysqli_fetch_array(mysqli_query($server,"SELECT * from 
                    trainings WHERE 
                    training_id ='$certi_training'
                "));
                // Get the training professional 
                $get_tra_professional = mysqli_fetch_array(mysqli_query($server,"SELECT * from
                    training_professionals
                    WHERE training = '$certi_training'
                "));
                $professional = $get_tra_professional['professional'];
                $get_profesional_info = mysqli_fetch_array(mysqli_query($server,"SELECT * from
                    professionals 
                    WHERE professional_id = '$professional'
                "));
                ?>
                <div class="ctrls">
                    <button class="btn btn-primary" id="printButton">
                        <i class="fa fa-print"></i>
                        Print
                    </button>
                </div>
                <div class="certificate mb-5" >
                    <div class="logo">
                        <h1 class="text-success font-weight-bold">
                            ETIS
                        </h1>
                    </div>
                    <h1 class="font-weight-bold">Certificate of Completion</h1>
                    <p>Date: <?php echo date('Y-m-d') ?></p>
                    <br>
                    <p>This is to certify that <span class="employee-name font-weight-bold"><?php echo $acting_employee_fn." ".$acting_employee_ln; ?></span> has successfully completed the training course titled:</p>
                    <h2><?php echo $get_training_inf['training_topic']; ?></h2>
                    <p>From <?php echo $get_training_inf['training_start']; ?> 
                        
                        until 
                        <?php
                            // Assuming $data_tr_certificate['approve_date'] contains a date in the format 'YYYY-MM-DD'
                            $approveDate = $data_tr_certificate['approve_date'];

                            // Convert the date to a DateTime object
                            $dateObj = new DateTime($approveDate);

                            // Format the date as desired (Y for year, m for month, d for day)
                            $formattedDate = $dateObj->format('Y-m-d'); // Adjust the format as needed

                            // Display the formatted date
                            echo $formattedDate;
                        ?>.
                    </p>
                    <br>
                    <p class="p-5">
                        This training was led by <span class="employee-name font-weight-bold">
                            <?php echo $get_profesional_info['professional_fn']." ".$get_profesional_info['professional_ln']; ?></span>, 
                        and we can confidently confirm <b><?php echo $acting_employee_fn." ".$acting_employee_ln; ?></b>'s strong 
                        dedication and commitment to learning. For any professional inquiries, 
                        you can contact <b><?php echo $get_profesional_info['professional_email']; ?></b>.
                    </p>
                    <br>
                    <p>Given this <?php echo date("jS"); ?> day of <?php echo date("F, Y"); ?></p>
                    <br>
                    <p>Sincerely,</p>
                    <h3>
                        <?php 
                            $approved_by = $data_tr_certificate['approved_by'];
                            $get_apporval = mysqli_fetch_array(mysqli_query($server,"SELECT * 
                                FROM 
                                users,departments
                                WHERE user_id = '$approved_by'
                                AND departments.depart_id = users.department
                            "));
                            echo $get_apporval['user_fn']." ".$get_apporval['user_ln'];
                        ?>
                    </h3>
                    <p>
                        <?php echo $get_apporval['depart_name'] ?>
                    </p>
                    <p>EMPLOYEE TRAININGS AND IMPROVEMENT SYSTEM</p>
                    <p>Email: 
                        <?php echo $get_apporval['user_email']; ?>
                    </p>
                    <p>Phone: 
                        <?php echo $get_apporval['user_phone']; ?>
                    </p>
                </div>
                <?php
            }
        }else {
            ?>
            <p class="m-3 p-3">
                No training sent to the server!
            </p>
            <?php
        }
    ?>
    
</body>
</html>
