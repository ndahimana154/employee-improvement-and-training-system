<div class="col-md-3 text-light p-4" id="contents_list">
    <h4 class="text-dark m-3">
        Contents
    </h4>
    <?php
        // Get the training contents
        $get_trainings_content = mysqli_query($server,"SELECT * from training_contents
            WHERE training='$training'
        ");
        if (mysqli_num_rows($get_trainings_content) < 1) {
            ?>
            <p class="alert alert-danger">
                No contents for this training
            </p>
            <?php
        }
        while ($data_contents = mysqli_fetch_array($get_trainings_content)) {
            ?>
            <div class="row m-2" >
                <a href="employee-get-training-contnet.php?training=<?php echo $training; ?>&content=<?php echo $data_contents['training_content_id']; ?>" class="btn btn-outline-primary">
                    <?php 
                        $current_content = $data_contents['training_content_id'];
                        echo $data_contents['content_name']; 
                        $check_content_info = mysqli_query($server,"SELECT * from empl_trainings_conent_completion
                            WHERE employee='$acting_employee_id'
                            AND training = '$training'
                            AND content = '$current_content'
                            AND status = 'Completed'
                            ");
                            if (mysqli_num_rows($check_content_info) > 0) {
                                ?>
                                    <i class="fa fa-check-circle"></i>
                                <?php
                            }
                    ?>
                </a>
            </div>
            <?php
        }
    ?>
</div>