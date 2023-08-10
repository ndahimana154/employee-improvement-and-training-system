<?php
    if (isset($_GET['content'])) {
        $content_id = $_GET['content'];
        $get_content_info = mysqli_query($server,"SELECT * from training_contents
            WHERE training_content_id = '$content_id'
        ");
        if (mysqli_num_rows($get_content_info) !=1) {
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
                        $content_mark = $_GET['content_mark'];
                        $check_content_to_mark_exists = mysqli_query($server,"SELECT * from
                            training_contents WHERE
                            training_content_id = '$content_mark'
                        ");
                        if (mysqli_num_rows($check_content_to_mark_exists) != 1) {
                            ?>
                            <p class="alert alert-danger">
                                Content failed.
                            </p>
                            <?php
                        }
                        else {
                            $get_content_info = mysqli_fetch_array(mysqli_query($server,"SELECT * from training_contents
                                WHERE training_content_id = '$content_mark'
                            "));
                            $training = $get_content_info['training'];
                            $check_content_info = mysqli_query($server,"SELECT * from empl_trainings_conent_completion
                            WHERE employee='$acting_employee_id'
                            AND training = '$training'
                            AND content = '$content_mark'
                            AND status = 'Completed'
                            ");
                            if (mysqli_num_rows($check_content_info) > 0) {
                                ?>
                                <p class="alert alert-danger">
                                    You have already completed this course.
                                </p>
                                <?php
                            }
                            else {
                                $mark =mysqli_query($server,"INSERT into empl_trainings_conent_completion 
                                values(null,'$acting_employee_id','$training','$content_mark','Completed',now())
                                ");
                                if (!$mark) {
                                    ?>
                                    <p class="alert alert-danger">
                                        The content is not marked.
                                    </p>
                                    <?php
                                }
                                else {
                                    ?>
                                    <p class="alert alert-success">
                                        The content is marked completely.
                                    </p>
                                    <?php
                                    // header("Refresh: 0");
                                    // header("location: home.php");
                                }
                            }
                        }
                    }
                ?>
                <div class="content_file">
                    <iframe src="<?php echo $data_contents['content_file']; ?>" frameborder="0" width="100%" height="700px" ></iframe>
                </div>
                <div id="content_mark" style="display:none;"></div>
                <div class="controls" style="text-align: center;">
                    <?php
                        $check_if_completed = mysqli_query($server,"SELECT * from empl_trainings_conent_completion
                            WHERE employee='$acting_employee_id'
                            AND training = '$training'
                            AND content = '$content_id'
                            AND status = 'Completed'
                        ");
                        if (mysqli_num_rows($check_if_completed) !=1) {
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

<!-- Link Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- JQuery code to run -->
<script>
    $(document).ready(function() {
        $("#mark_complete").click(function() {
            var content = $(this).val()
            $("#content_mark").css({
                "display" : "block"
            })
            
            $("#content_mark").load("php/employee_content_mark.php",{
                "contents": content
            });
            
            
        })
    })
</script>