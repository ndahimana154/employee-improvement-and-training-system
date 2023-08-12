<div class="container mt-5">
    <?php
        // Check if the content have professional
        $check_professss = mysqli_query($server,"SELECT * from training_professionals
            WHERE  training = '$training'
        ");
        if (mysqli_num_rows($check_professss) < 1) {
            ?>
            <h4 class="mb-0">Chat with professionals</h4>
            <p class="alert alert-danger">
                No professional for this training
            </p>
            <?php
        }
        else {
            $data_professs = mysqli_fetch_array($check_professss);
            $professional_id = $data_professs['professional'];
            $get_professional_info = mysqli_fetch_array(mysqli_query($server,"SELECT * from professionals 
                WHERE professional_id = '$professional_id' 
            "));
            ?>
            <div class="card" style="height: 600px;">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Chat with professionals</h4>
                    <p class="mb-0">Chatting with: <?php echo $get_professional_info['professional_fn']." ".$get_professional_info['professional_ln']; ?></p>
                </div>
                <div class="card-footer bg-light">
                    <?php
                        if (isset($_POST['send_msg_btn'])) {
                            $message = $_POST['msg_field'];
                            if (empty($message)) {
                                ?>
                                <p class="alert-danger">
                                    Can't send empty message
                                </p>
                                <?php
                            }
                            else {
                                $send = mysqli_query($server,"INSERT into msgs_professional_employee
                                    VALUES(null,'$acting_employee_id','$professional_id','$message',now(),'Not read.')
                                ");
                                if (!$send) {
                                    ?>
                                    <p class="alert-danger">
                                        Message not sent.
                                    </p>
                                    <?php
                                }
                                else {
                                    ?>
                                    <p class="alert-success">
                                        Message is sent succesfully.
                                    </p>
                                    <?php
                                }
                            }
                            
                        }
                    ?>
                    <form action="" method="POST" autocomplete="off" class="d-flex">
                        <input type="text" name="msg_field" class="form-control" placeholder="Type your message...">
                        <button type="submit" name="send_msg_btn" class="btn btn-primary ml-2"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
                <div class="card-body chat-messages " style="overflow-y: auto;">
                    <?php
                        $get_msgs = mysqli_query($server,"SELECT * from msgs_professional_employee
                            WHERE (msg_sender = '$professional_id' AND msg_receiver = '$acting_employee_id') OR (msg_sender = '$acting_employee_id' AND msg_receiver = '$professional_id')
                            ORDER BY msg_sendtime DESC;
                        ");
                        if (mysqli_num_rows($get_msgs) < 1) {
                            ?>
                            <p class="alert alert-danger">
                                No messages in conversation.
                            </p>
                            <?php
                        }
                        while($data_msgs = mysqli_fetch_array($get_msgs)) {
                            $sender = $data_msgs['msg_sender'];
                            if ($sender == $acting_employee_id) {
                                ?>
                                <div class="message received-message">
                                    <div class="message-content">
                                        <p>
                                            <?php echo $data_msgs['msg_content']; ?>
                                        </p>
                                        <div class="message-meta" style="display: flex;">
                                            <div class="sender-name font-weight-bold text-primary" style="flex: 1;">
                                                <?php echo $acting_employee_email; ?>
                                            </div>
                                            <div class="message-date">
                                                <?php echo $data_msgs['msg_sendtime']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            else {
                                ?>
                                <div class="message sent-message">
                                    <div class="message-content">
                                        <p>
                                            <?php echo $data_msgs['msg_content']; ?>
                                        </p>
                                        <div class="message-meta" style="display: flex;">
                                            <div class="receiver-name font-weight-bold text-primary" style="flex: 1;">
                                                <?php
                                                    // Get professional info
                                                    $get_professsio_msg = mysqli_fetch_array(mysqli_query($server,"SELECT * from professionals
                                                        WHERE professional_id = '$sender'
                                                    ")); 
                                                    echo $get_professsio_msg['professional_email']; ?>
                                            </div>
                                            <div class="message-date">
                                                <?php 
                                                    echo $data_msgs['msg_sendtime']; 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    ?>
                    
                    <!-- Add more messages here -->
                </div>
               
            </div>
            <style>
                .sent-message {
                    background-color: #cce5ff; /* Light blue for sent messages */
                    margin-left: auto;
                    margin-right: 10px;
                    margin-top: 10px;
                    padding: 10px;
                    border-radius: 10px;
                }

                .received-message {
                    background-color: #f0f0f0; /* Light gray for received messages */
                    margin-right: auto;
                    margin-left: 10px;
                    margin-top: 10px;
                    padding: 10px;
                    border-radius: 10px;
                }

            </style>



            <?php
        }
    ?>
</div>
