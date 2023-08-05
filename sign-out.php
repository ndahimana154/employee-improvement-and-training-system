<?php
    session_start();
    if (isset($_GET['administration'])) {
        session_destroy();
        header("location: user-login.php");
    }
?>