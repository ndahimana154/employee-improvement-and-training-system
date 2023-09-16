<div class="p-3">
    <h4>
        Certificate eligibility
    </h4>
    <?php
        if ($training_completion_level == 100)  {
            if ($average_marks < 70) {
                ?>
                <p class="alert alert-danger">
                    Average marks less than 70%
                </p>
                <?php
            }
            else {
                // Check if the resquest already sent
                $check_request_sent= mysqli_query($server,"SELECT* from 
                    employees_request_certificates
                    WHERE 
                    employee='$acting_employee_id'
                ");
                if (mysqli_num_rows($check_request_sent) != 0) {
                    $data_request_sent = mysqli_fetch_array($check_request_sent);
                    $status_request = $data_request_sent['request_status'];
                    if ($status_request == 'Pending') {
                        ?>
                        <p class="alert alert-danger">
                            The request is still pending
                        </p>
                        <?php
                    }
                    elseif () {
                        # code...
                    }
                    ?>
                    <?php
                }
                else {
                    ?>
                    <a href="employee-request-certficate.php?request=<?php echo $_GET['training']; ?>&training=<?php echo $_GET['training'] ?>" class="btn btn-primary">
                        <i class="fa fa-trophy"></i>
                        Request certificate 
                    </a>
                    <?php
                }
            }
        }
        else {
            ?>
            <p class="alert alert-danger">
                Contents are not completed
            </p>
            <?php
        }
    ?>
    <div class="row">
        
       
     
    </div>
</div>