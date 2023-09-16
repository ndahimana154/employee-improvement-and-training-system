<div class="p-3">
    <h4>
        Tests progresion
    </h4>
    <div class="row">
        <div class="col-md-4 m-1">
            <div class="dashboard-box bg-success text-light p-2 row rounded">
                <div class="mr-3">
                    <i class="fas fa-flask  fa-2x mb-3 flex-1"></i>
                    <h6>TOTAL TESTS</h6>
                </div>
                <p class="mb-0 fa-3x">
                    <?php 
                        $get_all_tests = mysqli_query($server,"SELECT *
                            FROM tests
                            WHERE training = '$training'
                            AND test_status != 'Rejected'
                        ");
                        echo mysqli_num_rows($get_all_tests);
                    ?>
                </p>
            </div>
        </div>
        <div class="col-md-4 m-1">
            <div class="dashboard-box bg-success text-light p-2 row rounded">
                <div class="mr-3">
                    <i class="fas fa-clock  fa-2x mb-3 flex-1"></i>
                    <h6>UPCOMING TESTS</h6>
                </div>
                <p class="mb-0 fa-3x">
                    <?php 
                        $get_all_tests = mysqli_query($server,"SELECT *
                            FROM tests
                            WHERE training = '$training'
                            AND test_status = 'Upcoming'
                        ");
                        echo mysqli_num_rows($get_all_tests);
                    ?>
                </p>
            </div>
        </div>
        <div class="col-md-4 m-1">
            <div class="dashboard-box bg-success text-light p-2 row rounded">
                <div class="mr-3">
                    <i class="fas fa-check  fa-2x mb-3 flex-1"></i>
                    <h6>COMPLETED TESTS</h6>
                </div>
                <p class="mb-0 fa-3x">
                    <?php 
                        $get_all_tests = mysqli_query($server,"SELECT *
                            FROM test_completion_time
                            WHERE training = '$training'
                            -- AND (test_status = 'Completed' OR test_status = 'Marked')
                        ");
                        echo mysqli_num_rows($get_all_tests);
                    ?>
                </p>
            </div>
        </div>
        <?php
            $training_completion_level = $completetion_percenage;
            // Get the all marks status
            $get_all_marks_rsults = mysqli_query($server,"SELECT * from 
                employees_test_marks
                WHERE employee = '$acting_employee_id'
            ");
            if (mysqli_num_rows($get_all_marks_rsults) < 1) {
                ?>
                <p class="alert alert-danger">
                    No test marked
                </p>
                <?php
            }
            $one_mark =(int) 0;
            $expected =(int) 0;
            while ($data_all_marks_results = mysqli_fetch_array($get_all_marks_rsults)) {
                $one_mark += $data_all_marks_results['average_marks'];
                $expected += $data_all_marks_results['total_test_marks'];    
            }
        ?>
        <div class="col-md-4 m-1">
            <div class="dashboard-box bg-success text-light p-2 row rounded">
                <div class="mr-3">
                    <!-- <i class="fas fa-certificate"></i> -->
                    <i class="fas fa-chart-line  fa-2x mb-3 flex-1"></i>
                    <h6>Average marks</h6>
                </div>
                <p class="mb-0 fa-2x">
                    <?php 
                        $average_marks = round($one_mark/$expected,1)*100;
                        echo $average_marks."%";
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>