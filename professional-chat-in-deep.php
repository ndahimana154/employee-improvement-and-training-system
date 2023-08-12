<?php   
    session_start();
    include("php/connection.php");
    include("php/professional-sessions.php");
    if (!isset($_GET['employee'])) {
        header("location: professional-home.php");
    }
    else {
        $employee = $_GET['employee'];
    }
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
</head>
<body>
    <!-- Header -->
    <?php
        include("php/professional-header.php");
    ?>
    <!--  -->
    <div class="col-md-8">
            <?php
                if (isset($_GET['welcome'])) {
                    ?>
                    <h4>
                        Welcome <?php echo $acting_professional_email; ?>
                    </h4>
                    <?php
                }
                else {
                    ?>
                    <h4>
                        <?php echo $acting_professional_email; ?>
                    </h4>
                    <?php
                }
            ?>
        </div>
    <div class="container-fluid chat-container row">
        
        <!-- Chat List Section -->
        <?php include("php/professional-chat-list.php") ?>

        <!-- Chat Conversation Section -->
        <?php include("php/professional-chats.php") ?>
    </div>

    

    
    <!-- Footer -->
    <?php
        include("php/footer.php");
    ?>
    
    <!-- Link Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <style>
        /* Custom CSS for hero section */
        #hero {
            position: relative;
            overflow: hidden;
        }
        /* .chat-container {
            display: flex;
            height: 100vh;
        } */
        .chat-list {
            flex: 1;
            background-color: #f8f9fa;
            overflow-y: auto;
        }
        .chat-conversation {
            flex: 3;
            background-color: #ffffff;
            border-left: 1px solid #e9ecef;
            overflow-y: auto;
        }
        .message {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
        }
    </style>
</body>
</html>
