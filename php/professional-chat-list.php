<div class="chat-list col-md-3 " >
    <h4 class="p-3">Chat List</h4>
    <ul class="list-group" style="margin-bottom: 30px;">
        <?php
            // Get the list of all chats according to training
            $get_chats = mysqli_query($server,"SELECT * from users
                WHERE department = '$training_depart'
            ");
            if (mysqli_num_rows($get_chats) < 1) {
                ?>
                <p class="alert alert-danger">
                    No chats
                </p>
                <?php
            }
            while ($data_chats = mysqli_fetch_array($get_chats)) {
                ?>
                <li class="list-group-item">
                    <a href="professional-chat-in-deep.php?employee=<?php echo $data_chats['user_id']; ?>">
                        <?php
                            echo $data_chats['user_email'];
                        ?>
                    </a>
                </li>
                <?php
            }
        ?>
        
        <!-- Add more users here -->
    </ul>
</div>