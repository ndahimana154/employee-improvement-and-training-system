<?php
    session_start();
    include("connection.php");
    include("employee-sessions.php");
    if (isset($_POST['content'])) {
        $content_id = $_POST['content'];
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
                <div class="content_file">
                    <iframe src="<?php echo $data_contents['content_file']; ?>" frameborder="0" width="100%" height="700px" ></iframe>
                </div>
                <div id="content_mark" style="display:none;">vvgg</div>
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
                            <button class="btn btn-success" id="mark_complete" value="<?php echo $content_id; ?>">
                                <i class="fa fa-check-circle"></i>
                                Mark as complete
                            </button>
                            <?php
                        }
                    ?>
                    
                </div>
            </div>
            <?php
        }
        
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