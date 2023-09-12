<!-- The section for tests -->
<h4 class="text-dark m-3">
    Revision tests
</h4>
<?php
    // Get the training contents
    $get_trainings_test = mysqli_query($server,"SELECT * from tests
        WHERE training='$training'
        AND test_schedule <= '$current_timestamp'
        AND (test_status = 'Upcoming' OR test_status = 'Progressing')
        ORDER BY test_schedule ASC,
        test_name ASC,
        test_questions_num DESC
    ");
    if (mysqli_num_rows($get_trainings_test) < 1) {
        ?>
        <p class="alert alert-danger">
            No tests for this training
        </p>
        <?php
    }
    while ($data_tests = mysqli_fetch_array($get_trainings_test)) {
        ?>
        <div class="row m-2" >
            <div class="chapter-row bg-white btn btn-outline-primary" style="width:100%;">
            <a href="employee-get-training-test_questions.php?training=<?php echo $training ?>&test=<?php echo $data_tests['test_id']; ?>" 
                class="" style="display:block;text-align: left;">
                    <i class="fa fa-bookmark"></i>
                <?php 
                    echo $data_tests['test_schedule']." - ".$data_tests['test_name'];
                ?>
            </a>
            </div>
        </div>
        <?php
    }
?>