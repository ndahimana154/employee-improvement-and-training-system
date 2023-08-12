<?php
    session_start();
    if (isset($_GET['administration'])) {
        session_destroy();
        header("location: user-login.php");
    }
    elseif (isset($_GET['employee'])) {
        session_destroy();
        header("location: user-login.php");
    }
    elseif (isset($_GET['professional'])) {
        session_destroy();
        header("location: professional-sign-in.php");
    }
?>