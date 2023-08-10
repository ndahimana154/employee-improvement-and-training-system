<?php
    if (isset($_GET['content'])) {
        $content_id = $_GET['content'];
        $get_content_info = mysqli_query($server,"SELECT * from training_contents
            WHERE training_content_id = '$content_id'
        ");
        if (mysqli_num_rows($get_content_info) != 1) {
            ?>
            <p class="alert alert-danger">
                No data sent to server
            </p>
            <?php
        }
        else {
            $data_contents = mysqli_fetch_array($get_content_info);
            $training = $data_contents['training'];
            ?>
            <div>
                <h3 class="m-3">
                    <?php echo $data_contents['content_name']; ?>
                </h3>
                <?php
                    if (isset($_GET['training']) && isset($_GET['content']) && isset($_GET['content_mark'])) {
                        // ... (code for marking content as completed)
                    }
                ?>
                <div class="content_file">
                    <video controls autoplay="false" width="100%">
                        <source src="<?php echo $data_contents['content_file']; ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="controls" style="text-align: center;">
                    <?php
                        $check_if_completed = mysqli_query($server,"SELECT * from empl_trainings_conent_completion
                            WHERE employee='$acting_employee_id'
                            AND training = '$training'
                            AND content = '$content_id'
                            AND status = 'Completed'
                        ");
                        if (mysqli_num_rows($check_if_completed) != 1) {
                            ?>
                            <a href="?training=<?php echo $training ?>&content=<?php echo $content_id; ?>&content_mark=<?php echo $content_id; ?>" class="btn btn-success">
                                <i class="fa fa-check-circle"></i>
                                Mark as complete
                            </a>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <?php
        }
    } 
    else {
        ?>
        <p class="alert alert-danger">
            No contents sent to server.
        </p>
        <?php
    }
?>
